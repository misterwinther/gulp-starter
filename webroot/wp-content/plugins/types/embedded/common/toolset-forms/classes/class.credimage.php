<?php
require_once 'class.credfile.php';
require_once 'class.image.php';

/**
 * Description of class
 *
 * @author Srdjan
 *
 * $HeadURL: http://plugins.svn.wordpress.org/types/tags/1.6.3/embedded/common/toolset-forms/classes/class.credimage.php $
 * $LastChangedDate: 2014-10-23 10:56:37 +0000 (Thu, 23 Oct 2014) $
 * $LastChangedRevision: 1012704 $
 * $LastChangedBy: iworks $
 *
 */
class WPToolset_Field_Credimage extends WPToolset_Field_Credfile
{
    public function metaform()
    {
        //TODO: check if this getValidationData does not break PHP Validation _cakePHP required file.
        $validation = $this->getValidationData();
        $validation = WPToolset_Field_Image::addTypeValidation($validation);
        $this->setValidationData($validation);
        return parent::metaform();        
    }
}
