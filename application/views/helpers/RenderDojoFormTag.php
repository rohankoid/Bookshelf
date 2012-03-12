<?php
/**
 * SpeedRFP
 * 
 * View Helper to create the html of a djit form tag.  Sets up needed resources.  No ending tag is supplied.
 * 
 * 
 * @uses       Zend_View_Helper_Abstract
 * @package    Custom
 * @version    $Id$
 */
class Zend_View_Helper_RenderDojoFormTag extends Zend_Dojo_View_Helper_Dijit
{

    /**
     * Returns the html needed to createa a dijit form.  Also adds needed digit module and creates
     * the appropriate dijit javascript initialization
     * 
     * @param Zend_Dojo_Form $form - dojo form
     * @param bool $use_dojo - optional flag of whether to declare dijit.form.form (FF4 iframe has issues)
     * @return string
     */
    public function renderDojoFormTag($form, $use_dojo=true)
    {
        $this->view->dojo()->requireModule('dijit.form.Form');

        $id        = $form->getId();
        $name      = $form->getFullyQualifiedName();
        $style     = $form->getAttrib('style');
        $method    = $form->getMethod();
        $enctype   = $form->getEnctype();
        $action    = $form->getAction();
        $dojo_type = ( $use_dojo && $this->_useDeclarative() ) ? ' dojoType="dijit.form.Form"' : '';

        if (!$method) $method = 'post';

        $xhtml  = '<form '
            . ' id="' . $this->view->escape($id) . '"'
            . ' name="' . $this->view->escape($name) . '"'
            . ' action="' . $this->view->escape($action) . '"'
            . ' method="' . $method . '"'
            . ' enctype="' . $enctype . '"'
            . $dojo_type
            . ' style="' . $style . '">';

        if ( $this->_useProgrammatic() ) {
            //$dijitParams = $form->getDijitParams();
            $dijitParams['dojoType'] = 'dijit.form.Form';
            $this->view->dojo()->addDijit($id, $dijitParams);
        }

        return $xhtml;
    }
}
