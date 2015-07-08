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
?><!DOCTYPE html>
<html lang="<?php echo AppConfig::read('System.language'); ?>">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <?php
        echo $this->Html->appMeta();
        echo $this->Html->script('jquery/jquery.min.js');
        echo $this->Html->css('/js/jquery/jqueryui/css/smoothness/jquery-ui.custom');
        echo $this->Html->script('jquery/jqueryui/js/jquery-ui.min', array('inline' => false));
        echo $this->Html->script('jquery/plugins/jquery.blockUI', array('inline' => false));
        echo $this->fetch('css');
        echo $this->fetch('script');
        echo $this->Html->css('/css/flowcharts/bootstrap.min');
        echo $this->Html->css('bootstrap/css/bootstrap.min');
         
    
         
         
        echo $this->Html->script('/css/flowcharts/bootstrap.min');
        echo $this->Html->css(Router::url(array('controller' => 'configurations', 'action' => 'customstyles'), true));
        echo $this->Html->script('custom');
        echo $this->Html->css('custom');
        echo $this->Html->css('style');
        echo $this->Html->script('charts/initialize');
        echo $this->Html->script('/js/charts/assets/spectrum');
        echo $this->Html->css('/js/charts/assets/spectrum');
        //echo $this->Html->script('charts/initialize');
        
        echo $this->Html->script('charts/go_002');
        echo $this->Html->script('jquery');
        echo $this->Html->script('tinymce/tinymce.min');
        echo $this->Html->script('tinymce/jquery.tinymce.min');
        echo $this->Layout->fluid();
        if (Configure::read('debug') > 0)
            echo $this->Html->css('debug');
        ?>
         <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
        <?php if (Configure::read('demo') === true): ?>
            <script type="text/javascript">
                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-4514355-15']);
                _gaq.push(['_setDomainName', 'clientengage.com']);
                _gaq.push(['_trackPageview']);

                (function() {
                    var ga = document.createElement('script');
                    ga.type = 'text/javascript';
                    ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(ga, s);
                })();
            </script>
        <?php endif; ?>
        <style>
        .right {
				margin-left: 4px;
			}
        .container-fluid {
    padding-left: 0px;
    padding-right: 0px;
}
        </style>
    </head>
    <body onload="init()" data-target=".subnav" data-offset="50">
        <?php echo $this->element('layout/topbar', array('topbar' => null)); ?>
		<div class="col-md-12">
				<?php echo $this->element('common/passwordnotification'); ?>
                <?php echo $this->Session->flash('auth'); ?>
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>

                <?php echo $this->element('layout/footer'); ?>
		</div>
    </div>
</body>
</html>
