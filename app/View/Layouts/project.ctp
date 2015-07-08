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
        echo $this->Html->css('bootstrap/css/bootstrap.min');
        echo $this->Html->script('/css/bootstrap/js/bootstrap.min');
        echo $this->Html->css(Router::url(array('controller' => 'configurations', 'action' => 'customstyles'), true));
        echo $this->Html->script('custom');
         echo $this->Html->css('resources/font-awesome/css/font-awesome.min.css');
        echo $this->Html->css('custom');
        echo $this->Layout->fluid();
        if (Configure::read('debug') > 0)
            echo $this->Html->css('debug');
        echo $this->Layout->renderPreviewJS();
        ?>
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
    </head>
    <body data-target=".subnav" data-offset="50">
        <?php echo $this->element('layout/topbar', array('topbar' => null)); ?>

        <div class="container">
            <div class="row">


                <div class="tabs-left">
                    <?php echo $this->element('phase/phasetabs', array('project' => $project)); ?>
                    <div class="tab-content">

                        <?php echo $this->element('common/passwordnotification'); ?>
                        <?php if ($project['Project']['archived']): ?>
                            <div class="alert alert-error keepopen">
                                <h4 class="alert-heading"><?php echo __('Project Archived'); ?></h4>
                                <?php echo __('This project was archived and you cannot perform any changes.'); ?> 
                            </div>
                        <?php endif; ?>

                        <?php
                        $path = array();
                        $path[] = array('title' => $project['Project']['title'], 'url' => array('controller' => 'projects', 'action' => 'dashboard', $project['Project']['slug']));

                        if (isset($project['Phase']['id']))
                            $path[] = array('title' => '<span class="badge">' . $project['Phase']['position'] . '</span> ' . $project['Phase']['title'], 'url' => array('controller' => 'projects', 'action' => 'phase', $project['Phase']['position']));

                        echo $this->element('layout/navigationpath', array('navigationpath' => $path));
                        ?>

                        <?php echo $this->Session->flash('auth'); ?>
                        <?php echo $this->Session->flash(); ?>
                        <?php //echo $content_for_layout; ?>
                        <?php echo $this->fetch('content'); ?>



                        <?php echo $this->element('layout/footer'); ?>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
//echo $this->element('sql_dump'); ?>
