<?php

/**
 *
 * @see XenForo_Model_Node
 */
class ThemeHouse_NewPostParent_Extend_XenForo_Model_Node extends XFCP_ThemeHouse_NewPostParent_Extend_XenForo_Model_Node
{
    /**
     * Get an array of node_names from the specified array of node_ids
     *
     * @param array Node ids
     */
    public function getNodeInfoByNodeIds(array $nodeIds)
    {
        return $this->fetchAllKeyed('
			SELECT node_id, title, node_type_id
			FROM xf_node
			WHERE node_id IN (' . $this->_getDb()->quote($nodeIds) . ')
		', 'node_id');
    }

    /**
     * Get an array of parent_node_ids from the specified array of node_ids
     *
     * @param array Node ids
     *
     * @return array $parentNodeIds
     */
    public function getParentNodeIdsFromNodeIds(array $nodeIds)
    {
        return $this->_getDb()->fetchPairs('
			SELECT node_id, parent_node_id
			FROM xf_node
			WHERE node_id IN (' . $this->_getDb()->quote($nodeIds) . ')
		');
    }
}