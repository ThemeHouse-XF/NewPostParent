<?php

class ThemeHouse_NewPostParent_Listener_LoadClass extends ThemeHouse_Listener_LoadClass
{

    protected function _getExtendedClasses()
    {
        return array(
            'ThemeHouse_NewPostParent' => array(
                'model' => array(
                    'XenForo_Model_Node'
                ), 
                'controller' => array(
                    'XenForo_ControllerPublic_FindNew'
                ), 
            ), 
        );
    }

    public static function loadClassModel($class, array &$extend)
    {
        $loadClassModel = new ThemeHouse_NewPostParent_Listener_LoadClass($class, $extend, 'model');
        $extend = $loadClassModel->run();
    }

    public static function loadClassController($class, array &$extend)
    {
        $loadClassController = new ThemeHouse_NewPostParent_Listener_LoadClass($class, $extend, 'controller');
        $extend = $loadClassController->run();
    }
}