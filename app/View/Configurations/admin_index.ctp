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
?>
<div class="configurations form">
    <h2><?php echo __('Edit System Configuration'); ?></h2>
    <hr/>

    <ul class="nav nav-tabs">
        <?php
        $sel = !empty($this->request->params['named']['section']) ? $this->request->params['named']['section'] : '';
        ?>
        <li<?php echo ($sel == '') ? ' class="active"' : ''; ?>><?php echo $this->Html->link(__('System Configuration'), array('action' => 'index')); ?></li>
        <li<?php echo ($sel == 'email') ? ' class="active"' : ''; ?>><?php echo $this->Html->link(__('Email Configuration'), Hash::merge($this->request->params['named'], array('section' => 'email'))); ?></li>    
    </ul>

    <?php echo $this->Form->create('Configuration', array('type' => 'file')); ?>
    <fieldset>
        <p><?php echo __('You can adapt global system settings below:'); ?></p>
        <?php
        echo '<h3 class="controls">' . __('System Information') . '</h3>';
        echo '<p class="controls">' . __('Version: ClientEngage Project Platform v') . AppVersion::Version . '</p>';

        echo $this->Form->input('id');
        echo '<h3 class="controls">' . __('General Settings') . '</h3>';
        echo $this->Form->input('System-name', array('label' => __('System Name')));
        echo $this->Form->input('System-language', array('label' => __('System Language'), 'type' => 'select', 'options' => AppLanguages::getAll()));
        echo $this->Form->timezone('System-timezone', array('label' => __('System Timezone')));
        echo $this->Form->input('System-logo_name', array('label' => __('System Logo') . ' ' . $this->Layout->renderHelpIcon(__('This is the logo that your clients will see in the front-end. For best results, please select a logo with a height of 23px.')), 'type' => 'file'));
        if (!is_array($this->Form->value('System-logo_name')) && trim($this->Form->value('System-logo_name')) != '')
            echo $this->Form->input('Configuration.System-logo_name.remove', array('type' => 'checkbox', 'label' => __('Remove current logo?'), 'hiddenField' => false));

        echo $this->Form->input('System-comments_desc', array('label' => __('Show Newest Comments First')));
        echo $this->Form->input('System-maintenance', array('label' => __('Maintenance Mode')));
        echo $this->Form->input('Uploads-extension_blacklist', array('label' => __('File Extension Blacklist') . ' ' . $this->Layout->renderHelpIcon(__('Please enter a comma-separated list of file-extensions that are disallowed (e.g. "exe,bat,ext")'))));

        echo '<h3 class="controls">' . __('Image Preview Settings') . '</h3>';
        echo $this->Form->input('Preview-max_width', array('label' => __('Maximum Width')));
        echo $this->Form->input('Preview-max_height', array('label' => __('Maximum Height')));

        echo '<h3 class="controls">' . __('Frontend Layout Settings') . '</h3>';
        echo '<p class="controls">' . __('The settings below affect the client-facing frontend only:'). '</p>';
        echo $this->Form->colorPicker('Color-topbar_fill', array('label' => __('Menu Bar Colour')));
        echo $this->Form->colorPicker('Color-topbar_text', array('label' => __('Menu Bar Text')));
        echo $this->Form->colorPicker('Color-link', array('label' => __('Link Colour')));
        echo $this->Form->input('Layout-fluid', array('label' => __('Use Fluid Layout')));
        echo $this->Form->input('Misc-showpoweredby', array('label' => __('Show Powered By')));
        ?>
    </fieldset>
    <div class="form-actions">
<?php echo $this->Form->submit(__('Save Configuration'), array('class' => 'btn btn-primary blockinterface')); ?>
    </div>    
</div>