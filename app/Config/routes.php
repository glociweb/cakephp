<?php

/**
 * TODO: If IIS --> Router::connectNamed(true, array('separator'=>';')); 
 */

/**
 * Loads the Installer routes
 */
if (CakePlugin::loaded('Installer'))
    CakePlugin::routes('Installer');

/**
 * Loads the Updater routes
 */
if (CakePlugin::loaded('Updater'))
    CakePlugin::routes('Updater');
/**
 * Routing configuration
 */
Router::parseExtensions('json');
Router::connect('/', array('controller' => 'dashboard', 'action' => 'index'));
Router::connect('/admin', array('controller' => 'dashboard', 'action' => 'index', 'admin' => true));
Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
Router::connect('/admin/login', array('controller' => 'users', 'action' => 'login', 'admin' => true));
Router::connect('/contents/*', array('controller' => 'contents', 'action' => 'view'));


/**
 * Loads the CakePHP default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
