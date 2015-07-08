<?php

/**
 * 
 * ClientEngage: ClientEngage Project Platform (http://www.clientengage.com)
 * Copyright 2012, ClientEngage (http://www.clientengage.com)
 *
 * You must have purchased a valid license from CodeCanyon in order to have 
 * the permission to use this file.
 * 
 * You may only use this file according to the respective licensing terms 
 * you agreed to when purchasing this item on CodeCanyon.
 * 
 * 
 * 
 *
 * @author          ClientEngage <contact@clientengage.com>
 * @copyright       Copyright 2012, ClientEngage (http://www.clientengage.com)
 * @link            http://www.clientengage.com ClientEngage
 * @since           ClientEngage - Project Platform v 1.0
 * 
 */
App::uses('FormHelper', 'View/Helper');

/**
 * Application-wide form output manipulation
 */
class AppFormHelper extends FormHelper
{
    /*
     * Overrides Form->create() to apply custom formatting for template
     */

    public $helpers = array('Time', 'Html', 'TinyMce');

    public function create($model = null, $options = array())
    {

        // input defaults
        $default = array(
            'class' => 'form-horizontal',
            'novalidate' => true,
            'inputDefaults' => array(
                'between' => '<div class="controls">',
                'after' => '</div>',
                'div' => 'control-group',
                'error' => array(
                    'attributes' => array(
                        'wrap' => 'span',
                        'class' => 'help-inline')
                ),
                'format' => array('before', 'label', 'between', 'input', 'error', 'after')
            )
        );

        $options = Set::merge($default, $options);
        return parent::create($model, $options);
    }

    /*
     * Overrides Form->input() to apply custom styles for field-types
     */

    public function input($model = null, $options = array())
    {
        $defaults = $this->_inputDefaults;
        $options = Set::merge($defaults, $options);

        if (isset($options['inputOnly']))
        {
            $options['label'] = false;
            $options['after'] = false;
            $options['before'] = false;
            $options['between'] = false;
            $options['div'] = false;
            unset($options['inputOnly']);
        }


        if (isset($options['prepend']))
        {
            $options['between'] .= '<div class="input-prepend"><span class="add-on">' . $options['prepend'] . '</span>';
            $options['after'] .= '</div>';
        }

        if (isset($options['append']))
        {
            $options['format'] = array('before', 'label', 'between', 'input', 'error', 'after');
            $options['between'] .= '<div class="input-append">';
            $options['after'] = '<span class="add-on">' . $options['append'] . '</span></div></div>';
        }

        if (isset($options['prepend']) || isset($options['append']))
        {
            if (isset($options['class']))
                $options['class'] .= ' span2';
            else
                $options['class'] = 'span2';

            unset($options['prepend'], $options['append']);
        }


        //  if (isset($options['after']))
        //    $options['after'] .= $this->_inputDefaults['after'];


        if (isset($options['label']) && $options['label'] !== false)
            $options['label'] = array('text' => $options['label'], 'class' => 'control-label');

        if (!isset($options['label']))
            $options['label'] = array('text' => Inflector::humanize($model), 'class' => 'control-label');

        if (isset($options['label']) && isset($options['id']) && $options['label'] !== false)
            $options['label']['for'] = $options['id'];


        if (isset($options['format']) && is_array($options['format']))
        {
            foreach ($options['format'] as $format)
                if (!isset($options[$format]))
                    $options[$format] = '';
        }

        if (isset($options['format']))
            $options['format'] = array_unique($options['format']);

        unset($options['input']);
        return parent::input($model, $options);
    }

    public function timezone($model, $options = array())
    {
        $options = Set::merge(array(
                    'type' => 'select',
                    'options' => CakeTime::listTimezones(),
                    'empty' => false,
                    'default' => 'Europe/London'), $options);

        return self::input($model, $options);
    }

    public function colorPicker($model = null, $options = array())
    {

        $uID = '_' . $this->getID();


        $script = "$(function() {
                $('.colorInput$uID').each(function() {
                    $(this).parent().css('backgroundColor', $(this).val());
                });

		$('.colorSelector$uID').ColorPicker({
			color: $('.colorInput$uID').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('.colorSelector$uID div').css('backgroundColor', '#' + hex);
				$('.colorSelector$uID div').children('.colorInput$uID').val('#' + hex)
			}
		});
	});";

        $this->Html->css(array('/js/jquery/colorpicker/css/colorpicker'), 'stylesheet', array('inline' => false));
        $this->Html->css(array('/js/jquery/colorpicker/css/layout'), 'stylesheet', array('inline' => false));
        $this->Html->script('/js/jquery/colorpicker/js/colorpicker', array('inline' => false));
        $this->Html->scriptBlock($script, array('inline' => false));

        $options = Set::merge(
                        array(
                    'value' => ($this->value($model) != null ? $this->value($model) : '#ffffff'), // set default colour
                    'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
                    'type' => 'text', 'class' => 'colorInput' . $uID, 'style' => 'visibility: hidden;',
                    'between' => '<div class="colorSelector colorSelector' . $uID . '">
                    <div style="background-color: ' . ($this->value($model) != null ? $this->value($model) : '#ffffff') . '">',
                    'after' => '</div>
                </div>'
                        ), $options);


        return self::input($model, $options);
    }

    public function tinyMce($model = null, $options = array())
    {
        return $this->TinyMce->tinyMce($model, $options);
    }

}