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
 * @since           ClientEngage - Project Platform v 1.2.1
 * 
 */
?>
<?php
echo $this->Html->script('/js/fullcalendar/fullcalendar.min.js');
echo $this->Html->css('/js/fullcalendar/fullcalendar.css');
//echo $this->Html->css('/js/fullcalendar/fullcalendar.print.css');

$this->Html->scriptBlock('$(function() {
    $("#calendar").fullCalendar({
        events: \'' . Router::url(array('controller' => 'projects', 'action' => 'phasefeed', 'admin' => false, 'ext' => 'json'), true) . '\',
            eventRender: function (e, elem) {
                elem.find("span.fc-event-title").html(elem.find("span.fc-event-title").text());           
            }
    });
});', array('inline' => false));
?>

<div id="calendar"></div>