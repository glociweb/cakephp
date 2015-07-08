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
/* Main Topbar */
.navbar .nav > li > a
{
    text-shadow: none;
}
.navbar-inner, .topbar .fill, .navbar-inverse .navbar-inner
{
    background: <?php echo AppConfig::read('Color.topbar_fill'); ?>;
    background-color: <?php echo AppConfig::read('Color.topbar_fill'); ?>;
}
.navbar a 
{
    color: <?php echo AppConfig::read('Color.topbar_text'); ?> !important;
}
.navbar .nav .active > a, .navbar .nav .active > a:hover {
    background-color:  <?php echo $this->Html->adaptColor(AppConfig::read('Color.topbar_fill'), -15); ?>;
}
/* Main Topbar */


/* Topbar Submenu */
.dropdown-menu a
{
    color: #333 !important;
}
.navbar a.dropdown-toggle:hover, .navbar-inverse .nav > li.dropdown.open > a
{
background-color:  <?php echo $this->Html->adaptColor(AppConfig::read('Color.topbar_fill'), -15); ?> !important;
}
.navbar .submenu a.dropdown-toggle:hover
{
background-color:  transparent !important;
}
.dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover
{
    background-color:  transparent !important;
}
/* Topbar Submenu */

.dropdown-menu > li:hover
{
    background-color: transparent !important;
}
.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .dropdown-submenu:hover > a, .dropdown-submenu:focus > a
{
    background-image: none !important;
    color: #000;
}
/* Global Links */
a 
{
    color: <?php echo AppConfig::read('Color.link'); ?>;
}
a:hover
{
    color: <?php echo $this->Html->adaptColor(AppConfig::read('Color.link'), -20); ?>;
}
/* Global Links */


<?php if (AppConfig::read('Layout.fluid') === true): ?>
@media (max-width: 480px) { 
    ul.nav.phonereflow
    {
        float: none;
        border: 0;
        margin-right: 0;
    }
}
@media (max-width: 979px) {
    .navbar .dropdown-menu a
    {
        color: <?php echo $this->Html->adaptColor(AppConfig::read('Color.topbar_text'), 90); ?> !important;
    }
    .navbar .nav-header
    {
        color: <?php echo $this->Html->adaptColor(AppConfig::read('Color.topbar_text'), 70); ?> !important;
    }
}
 <?php endif; ?>