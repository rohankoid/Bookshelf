<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $form = new ZendX_JQuery_Form();
		$date1 = new ZendX_JQuery_Form_Element_DatePicker(
		                        'date1',
		                        array('label' => 'Date:')
		        );
		$form->addElement($date1);
		$elem = new ZendX_JQuery_Form_Element_Spinner(
		                    'spinner1', 
		                    array('label' => 'Spinner:')
		        );
		$elem->setJQueryParams(array(
		                'min' => 0,
		                'max' => 1000,
		                'start' => 100)
		        );
		$form->addElement($elem);		
		$this->view->form = $form;
    }


}

