<?php
/**
 * SpeedRFP
 * 
 * View Helper to create the html of a dojo select input.
 * 
 * 
 * @uses       Zend_View_Helper_Abstract
 * @package    Custom
 * @version    $Id$
 */
class Zend_View_Helper_RenderDojoSelect extends Zend_Dojo_View_Helper_Dijit
{

    /**
     * Returns the html needed to take create a usable combobox.  Namely, the value attribute 
     * needs to be set.
     * 
     * @param Zend_Dojo_Form_Element_ComboBox $element 
     * @param string $validator 
     * @return string
     */
    public function renderDojoSelect($element, $validator='')
    {
        $this->view->dojo()->requireModule('dijit.form.Select');

        $dijitParams = $element->getDijitParams();

        // overwrite the validator if passed
        if ( $validator ) $dijitParams['validator'] = array($validator);

        $id        = $element->getId();
        $name      = $element->getFullyQualifiedName();
        $dojo_type = ( $this->_useDeclarative() ) ? ' dojoType="dijit.form.Select"' : '';


        // if validators exist, just take the first one (i'm not sure yet the syntax for an array.  the programmatic way is:
        //   "validator":["db.address.States.validateState"]
        if ( isset($dijitParams['validator']) && count($dijitParams['validator']) ) {
            $validator = ( $this->_useDeclarative() ) ? ' validator="' . $dijitParams['validator'][0] . '"' : '';
        }
        
        $selected_value = $element->getValue();
        
        $xhtml = '<select '
            . ' id="' . $this->view->escape($id) . '"'
            . ' name="' . $this->view->escape($name) . '"'
            . $dojo_type
            . $validator
            . ' style="' . $element->getAttrib('style') . '">';
            
        foreach ( $element->getMultiOptions() as $value => $label )
        {
            if ( $label === '' ) $label = '&nbsp;';
            
            $selected = ( $element->getValue() == "$value" ) ? 'selected="selected"' : '';
            $option = '<option value="' . htmlspecialchars($value) . '" ' . $selected . '>' . $label . '</option>';
            $xhtml .= $option;
        }
        $xhtml .= '</select>';
        
        if ( $this->_useProgrammatic() ) {

            // ensure the correct dojoType is set
            if (!isset($dijitParams['dojoType'])) $dijitParams['dojoType'] = 'dijit.form.Select';

            // add the dijit paramaters to the dijit builder
            $this->view->dojo()->addDijit($id, $dijitParams);
        }

        return $xhtml;
    }
}

