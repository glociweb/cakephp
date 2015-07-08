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
<?php
$nav = $navigationpath;

if (empty($nav))
    return null;
?>
<ul class="breadcrumb">
    <li class="active"><?php echo __('You are here:'); ?> </li>
    <?php
    for ($i = 0; $i < count($nav); $i++)
        if (count($nav) - 1 != ($i))
            echo '<li title="' . $nav[$i]['title'] . '">' . $this->Html->link($nav[$i]['title'], $nav[$i]['url']) . ' <span class="divider">/</span></li>';
        else
            echo '<li class="active">' . $nav[$i]['title'] . '</li>';
    ?>
</ul>