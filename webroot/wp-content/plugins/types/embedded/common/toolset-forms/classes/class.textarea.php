<?php
/**
 *
 * $HeadURL: http://plugins.svn.wordpress.org/types/tags/1.6.3/embedded/common/toolset-forms/classes/class.textarea.php $
 * $LastChangedDate: 2014-10-23 10:56:37 +0000 (Thu, 23 Oct 2014) $
 * $LastChangedRevision: 1012704 $
 * $LastChangedBy: iworks $
 *
 */
require_once 'class.field_factory.php';

/**
 * Description of class
 *
 * @author Franko
 */
class WPToolset_Field_Textarea extends FieldFactory
{

    public function metaform() {
        $attributes = $this->getAttr();
        
        $metaform = array();
        $metaform[] = array(
            '#type' => 'textarea',
            '#title' => $this->getTitle(),
            '#description' => $this->getDescription(),
            '#name' => $this->getName(),
            '#value' => $this->getValue(),
            '#validate' => $this->getValidationData(),
            '#repetitive' => $this->isRepetitive(),
            '#attributes' => $attributes
        );
        return $metaform;
    }

}
