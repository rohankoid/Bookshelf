<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Register Namespace
     */
    protected function _initRegisterNamespace()
    {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        /**
         * Register ZendX libaray namespace
         */
        $autoloader->registerNamespace('ZendX_');
    }

    /**
     * Add view Helpers
     */
    protected function _initViewHelpers()
    {
        $view = new Zend_View();   
        /**
         * set helper Path
         */
        $view->setHelperPath(APPLICATION_PATH.'/helpers','');                     
        /**
         * add jQuery helper path
         */
        $view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");

        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        /**
         * add $view to the view renderer
         */
        $viewRenderer->setView($view);
        /**
         * add viewRenderer to ActionHelper
         */
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);                

        return $view;

    }

}

