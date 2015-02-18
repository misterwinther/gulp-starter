<?php
require_once 'class.file.php';

/**
 * Description of class
 *
 * @author Srdjan
 *
 * $HeadURL: http://plugins.svn.wordpress.org/types/tags/1.6.3/embedded/common/toolset-forms/classes/class.image.php $
 * $LastChangedDate: 2014-10-23 10:56:37 +0000 (Thu, 23 Oct 2014) $
 * $LastChangedRevision: 1012704 $
 * $LastChangedBy: iworks $
 *
 */
class WPToolset_Field_Image extends WPToolset_Field_File
{
    public function metaform()
    {
        $validation = $this->getValidationData();
        $validation = self::addTypeValidation($validation);
        $this->setValidationData($validation);
        return parent::metaform();        
    }

    public static function addTypeValidation($validation) {
        $validation['extension'] = array(
            'args' => array(
                'extension',
                'jpg|jpeg|gif|png|bmp|webp',
            ),
            'message' => __( 'You can add only images.', 'wpv-views' ),
        );
        return $validation;
    }    
}
