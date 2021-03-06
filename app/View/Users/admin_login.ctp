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
<style type="text/css">
    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }
    .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        box-shadow: 0 1px 2px rgba(0,0,0,.05);
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }

</style>
<div class="users form">
    <div class="container">
        <div class="form-signin">
            <?php echo $this->Html->image('common/logo-clientengage-large.png', array('style' => '')); ?>

            <h2 class="form-signin-heading"><?php echo __('Login'); ?></h2>
            <fieldset>
                <?php
                echo $this->Form->create('User', array('class' => ''));
                echo $this->Form->input('email', array('label' => __('Email')));
                echo $this->Form->input('password', array('type' => 'password', 'value' => null, 'autocomplete' => 'off', 'label' => __('Password')));
                echo '<label for="UserRememberMe" class="control-label checkbox">' . $this->Form->checkbox('remember_me') . ' ' . __('Remember me for 2 weeks') . '</label><br />';
                echo $this->Form->submit(__('Login'), array('class' => 'btn btn-primary btn-large'));
                echo $this->Form->end();
                echo $this->Html->link(__('Forgot your password?'), array('controller' => 'users', 'action' => 'forgotten_password', 'admin' => false));
                ?>
            </fieldset>
        </div>
    </div>
</div>
