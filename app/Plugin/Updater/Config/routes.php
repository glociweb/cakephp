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
 * @since           ClientEngage - Project Platform v 1.1.0
 * 
 */

if (strstr(Router::getRequest()->here, 'updater') === false)
{
    Router::redirect('/*', array('plugin' => 'updater', 'controller' => 'update'), array('status' => 302));
    Router::redirect('*', array('plugin' => 'updater', 'controller' => 'update'), array('status' => 302));
}