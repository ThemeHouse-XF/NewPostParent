<?php

/**
 *
 * @see XenForo_ControllerPublic_FindNew
 */
class ThemeHouse_NewPostParent_Extend_XenForo_ControllerPublic_FindNew extends XFCP_ThemeHouse_NewPostParent_Extend_XenForo_ControllerPublic_FindNew
{

    /**
     *
     * @see XenForo_ControllerPublic_FindNew::actionPosts()
     */
    public function actionPosts()
    {
        $response = parent::actionPosts();

        if ($response instanceof XenForo_ControllerResponse_View && isset($response->subView->params['threads'])) {
            $threads = $response->subView->params['threads'];
            $nodeIds = array();
            foreach ($threads as $key => $thread) {
                if (!in_array($thread['node_id'],$nodeIds))
                $nodeIds[] = $thread['node_id'];
            }
            $nodeModel = $this->_getNodeModel();
            $parentNodeIds = $nodeModel->getParentNodeIdsFromNodeIds($nodeIds);
            $parentNodeInfo = $nodeModel->getNodeInfoByNodeIds($parentNodeIds);
            if (!empty($parentNodeInfo)) {
                foreach ($threads as $key => $thread) {
                    if (in_array($thread['node_id'], $nodeIds) && !empty($parentNodeInfo[$parentNodeIds[$thread['node_id']]]['title'])) {
                        $response->subView->params['threads'][$key]['parent_node'] = array(
                            'node_id' => $parentNodeIds[$thread['node_id']],
                            'title' => $parentNodeInfo[$parentNodeIds[$thread['node_id']]]['title'],
                            'node_type_id' => $parentNodeInfo[$parentNodeIds[$thread['node_id']]]['node_type_id']
                        );
                    }
                }
            }
        }

        return $response;
    }

    /**
     *
     * @return XenForo_Model_Node
     */
    protected function _getNodeModel()
    {
        return $this->getModelFromCache('XenForo_Model_Node');
    }
}