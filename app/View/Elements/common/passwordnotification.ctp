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
<?php if (AppAuth::is(UserRoles::Client, UserRoles::Admin) && trim(AppAuth::user('temp_password')) != ''): ?>	
    <div class="alert alert-error keepopen">
        <h4 class="alert-heading"><?php echo __('Password Change'); ?></h4>
        <?php echo __('You are still using the temporary password which was generated for you. Please change your password:'); ?> 
        <?php echo $this->Html->link(__('Your User Profile'), array('controller' => 'users', 'action' => 'profile', 'admin' => false), array('class' => 'btn btn-mini btn-danger')); ?>
    </div>
<?php endif; ?>