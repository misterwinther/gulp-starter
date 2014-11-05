<?php
/**
 *
 * $HeadURL: http://plugins.svn.wordpress.org/types/tags/1.6.3/embedded/common/toolset-forms/classes/class.radios.php $
 * $LastChangedDate: 2014-10-23 10:56:37 +0000 (Thu, 23 Oct 2014) $
 * $LastChangedRevision: 1012704 $
 * $LastChangedBy: iworks $
 *
 */
require_once 'class.field_factory.php';

/**
 * Description of class
 *
 * @author Srdjan
 */
class WPToolset_Field_Radios extends FieldFactory
{

    public function metaform()
    {
        $value = $this->getValue();
        $data = $this->getData();
        $name = $this->getName();
        $form = array();
        $options = array();
        foreach ( $data['options'] as $option ) {
            $one_option_data = array(
                '#value' => $option['value'],
                '#title' => $option['title'],
                '#validate' => $this->getValidationData()
            );
			if ( !is_admin() ) {// TODO maybe add a doing_ajax() check too, what if we want to load a form using AJAX?
				$one_option_data['#before'] = '<li class="wpt-form-item wpt-form-item-radio">';
				$one_option_data['#after'] = '</li>';
				$one_option_data['#pattern'] = '<BEFORE><PREFIX><ELEMENT><LABEL><ERROR><SUFFIX><DESCRIPTION><AFTER>';
			}
            /**
             * add default value if needed
             * issue: frontend, multiforms CRED
             */
            if ( array_key_exists( 'types-value', $option ) ) {
                $one_option_data['#types-value'] = $option['types-value'];
            }
            /**
             * add to options array
             */
            $options[] = $one_option_data;
        }
        $options = apply_filters( 'wpt_field_options', $options, $this->getTitle(), 'select' );
        /**
         * default_value
         */
        if ( !empty( $value ) || $value == '0' ) {
            $data['default_value'] = $value;
        }
        /**
         * metaform
         */
        $form_attr = array(
            '#type' => 'radios',
            '#title' => $this->getTitle(),
            '#description' => $this->getDescription(),
            '#name' => $name,
            '#options' => $options,
            '#default_value' => isset( $data['default_value'] ) ? $data['default_value'] : false,
            '#repetitive' => $this->isRepetitive(),
            '#validate' => $this->getValidationData(),
        );
		
        if ( !is_admin() ) {// TODO maybe add a doing_ajax() check too, what if we want to load a form using AJAX?
                $form_attr['#before'] = '<ul class="wpt-form-set wpt-form-set-radios wpt-form-set-radios-' . $name . '">';
                $form_attr['#after'] = '</ul>';
        }
		
        $form[] = $form_attr;

        return $form;
    }

}
