<?php
/**
 *
 * $HeadURL: http://plugins.svn.wordpress.org/types/tags/1.6.3/embedded/common/toolset-forms/classes/class.textfield.php $
 * $LastChangedDate: 2014-10-23 10:56:37 +0000 (Thu, 23 Oct 2014) $
 * $LastChangedRevision: 1012704 $
 * $LastChangedBy: iworks $
 *
 */
require_once "class.field_factory.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class
 *
 * @author Franko
 */
class WPToolset_Field_Textfield extends FieldFactory
{
    public function metaform()
    {
        $attributes =  $this->getAttr();

        $metaform = array();
        $metaform[] = array(
            '#type' => 'textfield',
            '#title' => $this->getTitle(),
            '#description' => $this->getDescription(),
            '#name' => $this->getName(),
            '#value' => $this->getValue(),
            '#validate' => $this->getValidationData(),
            '#repetitive' => $this->isRepetitive(),
            '#attributes' => $attributes,
        );
        return $metaform;
    }

}
