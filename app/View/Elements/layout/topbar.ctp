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
<script>
$(document).ready(function(e){
		$(document).on('click','.viewall',function(){
			var contain=$(this).attr('alt');
			$.post("<?php echo Router::url(array('controller' => 'projects', 'action' => 'searchall', 'admin' => false, 'plugin' => null), true); ?>", {"data[Search][contain]":""+contain+"","data[Search][query]": "" + $(".input-navsearch").val().trim() + ""}, function(data) {
										$('#search_suggestions').html(data);
										
									});
				
		
	});
	});


</script>
<?php
$mentions = $this->requestAction('/dashboard/getmentions');
$unread = $this->requestAction('/dashboard/unread');

 echo $this->Html->script('tinymce/tinymce.min');
        echo $this->Html->script('tinymce/jquery.tinymce.min');
        
        ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
      <script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="mm0ti477g109m5p"></script>
		<script src="https://www.google.com/jsapi?key=AIzaSyD-vR3KTfGdzHlpTJU-QfQJHNdACDWfs-0"></script>
	<script src="https://apis.google.com/js/client.js?onload=initPicker"></script>
	
	<!-- file upload script -->
	<?php 
	 echo $this->Html->script('/js/fileupload/jquery.ui.widget.js');
	 echo $this->Html->script('/js/fileupload/jquery.iframe-transport.js');
	 echo $this->Html->script('/js/fileupload/jquery.fileupload.js');
     echo $this->Html->css('/css/fileupload/jquery.fileupload.css');
     echo $this->Html->css('/css/fileupload/style.css');
     ?>
<script>
	
	
 var base_url = '<?php echo Router::url('/', true); ?>';

</script>
<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
            </a>
            <?php if (!empty($this->request->params['admin'])): ?>
                <?php echo $this->Html->link($this->Html->image('common/logo-clientengage.png', array('title' => String::insert(__('ClientEngage v:app_version'), array('app_version' => AppVersion::Version)), 'alt' => 'ClientEngage logo')), array('controller' => 'dashboard', 'action' => 'index', 'admin' => false, 'plugin' => null), array('class' => 'brand-admin', 'escape' => false)); ?>
            <?php else: ?>
                <?php
                if (($imgName = AppConfig::read('System.logo_name')) !== null && ($imgPath = AppConfig::read('System.logo_dir')) !== null)
                    echo $this->Html->link($this->Html->image(Router::url(array('controller' => 'configurations', 'action' => 'logo', $imgName, 'plugin' => null), true), array('title' => AppConfig::read('System.name'), 'alt' => String::insert(':system_name logo', array('system_name' => AppConfig::read('System.name'))))), array('controller' => 'dashboard', 'action' => 'index', 'admin' => false /* AppAuth::is(UserRoles::Admin)*/, 'plugin' => null), array('class' => 'brand-admin', 'escape' => false));
                else
                    echo $this->Html->link(AppConfig::read('System.name'), array('controller' => 'dashboard', 'action' => 'index',  'plugin' => null), array('class' => 'brand'));
                ?>
            <?php endif; ?>

            <div class="nav-collapse">
                <ul class="nav">

                    <?php if (AppAuth::is(UserRoles::Admin)): ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="ico-folder_wrench"></i> <?php echo __('Administration'); ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <!--
                                <li><?php echo $this->Html->link('<i class="ico-table_gear"></i> ' . __('Dashboard'), array('controller' => 'projects', 'action' => 'index', 'admin' => true, 'plugin' => null), array('escape' => false)); ?></li>
                                <li class="divider"></li>
                                -->
                                <li class="nav-header"><?php echo __('Manage'); ?></li>
                                <li><?php echo $this->Html->link('<i class="ico-report"></i> ' . __('Manage Projects'), array('controller' => 'projects', 'action' => 'index', 'admin' => true, 'plugin' => null), array('escape' => false)); ?></li>
                                <li><?php echo $this->Html->link('<i class="ico-group"></i> ' . __('Manage Clients'), array('controller' => 'clients', 'action' => 'index', 'admin' => true, 'plugin' => null), array('escape' => false)); ?></li>
                                <li><?php echo $this->Html->link('<i class="ico-vcard"></i> ' . __('Manage Users'), array('controller' => 'users', 'action' => 'index', 'admin' => true, 'plugin' => null), array('escape' => false)); ?></li>
                                <li><?php echo $this->Html->link('<i class="ico-vcard"></i> ' . __('Manage Departments'), array('controller' => 'department', 'action' => 'index', 'admin' => true, 'plugin' => null), array('escape' => false)); ?></li>
                                <li class="divider"></li>
                                <li><?php echo $this->Html->link('<i class="ico-bell"></i> ' . __('Notifications'), array('controller' => 'notifications', 'action' => 'index', 'admin' => true, 'plugin' => null), array('escape' => false)); ?></li>                                



                                <li class="divider"></li>
                                <li class="dropdown submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="ico-magnifier"></i> <?php echo __('Finders'); ?></a>
                                    <ul class="dropdown-menu submenu-show submenu-hide">
                                        <li><?php echo $this->Html->link('<i class="ico-magnifier"></i> ' . __('View Attachments'), array('controller' => 'attachments', 'action' => 'index', 'admin' => true, 'plugin' => null), array('escape' => false)); ?></li>
                                        <li><?php echo $this->Html->link('<i class="ico-magnifier"></i> ' . __('View Tasks'), array('controller' => 'comments', 'action' => 'index', 'admin' => true, 'plugin' => null), array('escape' => false)); ?></li>
                                    </ul>
                                </li>



                                <li class="divider"></li>
                                <li class="nav-header"><?php echo __('System Settings'); ?></li>
                                <li><?php echo $this->Html->link('<i class="ico-star"></i> ' . __('Administrators'), array('controller' => 'users', 'action' => 'administrators', 'admin' => true, 'plugin' => null), array('escape' => false)); ?></li>
                                <li><?php echo $this->Html->link('<i class="ico-wrench_orange"></i> ' . __('Configuration'), array('controller' => 'configurations', 'action' => 'index', 'admin' => true, 'plugin' => null), array('escape' => false)); ?></li>
                                <li class="nav-header"><?php echo __('About'); ?></li>
                                <li><?php echo $this->Html->link('<i class="ico-help"></i> ' . __('About'), array('controller' => 'contents', 'action' => 'about', 'admin' => true, 'plugin' => null), array('escape' => false)); ?></li>
                            </ul>
                        </li>
                    <?php endif; ?>



                    <li class="dropdown">
                        <?php echo $this->Html->link('<i class="ico-report"></i> ' . __('Projects') . ' <b class="caret"></b>', '#', array('escape' => false, 'class' => 'dropdown-toggle', 'data-toggle' => 'dropdown')); ?>
                        <?php $quickLinks = $this->requestAction(array('controller' => 'projects', 'action' => 'getQuickMenu', 'admin' => false, 'plugin' => null)); ?>
                        <ul class="dropdown-menu">
                            <li class="nav-header"><?php echo __('Project Calendar'); ?></li>
                            <li><?php echo $this->Html->link('<i class="ico-calendar"></i> ' . __('Project Calendar'), array('controller' => 'projects', 'action' => 'calendar', 'admin' => AppAuth::is(UserRoles::Admin)), array('escape' => false)); ?></li>
                            <li class="nav-header"><?php echo __('Recent Projects'); ?></li>
                            <?php foreach ($quickLinks as $quickLink): ?>
                                <li><?php echo $this->Html->link('<i class="ico-report"></i> ' . $quickLink['title'], array('controller' => 'projects', 'action' => 'dashboard', $quickLink['slug'], 'admin' => false, 'plugin' => null), array('escape' => false)); ?></li>
                            <?php endforeach; ?>
                            <li class="divider"></li>
                            <li class="nav-header"><?php echo __('Dashboard'); ?></li>
                            <li><?php echo $this->Html->link('<i class="ico-report"></i> ' . __('All Projects'), array('controller' => 'projects', 'action' => 'index', 'admin' => false, 'plugin' => null), array('escape' => false)); ?></li>
                        </ul>
                    </li>


                    <li class="dropdown">
                        <?php echo $this->Html->link('<i class="ico-star"></i> ' . __('Favourites') . ' <b class="caret"></b>', '#', array('escape' => false, 'class' => 'dropdown-toggle', 'data-toggle' => 'dropdown')); ?>
                        <?php $favourites = $this->requestAction(array('controller' => 'projects', 'action' => 'getFavourites', 'admin' => false, 'plugin' => null)); ?>
                        <ul class="dropdown-menu">
                            <?php
                            if (empty($favourites))
                                echo '<li class="nav-header">' . __('You currently have no favourite projects.') . '</li>';
                            ?>
                            <?php foreach ($favourites as $fav): ?>
                                <li>
                                    <?php
                                    echo $this->Html->link('<i class="ico-report"></i> ' . $fav['title'], array('controller' => 'projects', 'action' => 'dashboard', $fav['slug'], 'admin' => false, 'plugin' => null), array('escape' => false));
                                    ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="dropdown">
						<?php $isdepthead = $this->requestAction(array('controller' => 'Users', 'action' => 'isdepthead', AuthComponent::user('id'),'admin' => false, 'plugin' => null)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-sitemap"></i> ' . __('Flowcharts') . ' <b class="caret"></b>', '#', array('escape' => false, 'class' => 'dropdown-toggle', 'data-toggle' => 'dropdown')); ?>
                        <ul class="dropdown-menu">
							<?php if (AppAuth::is(UserRoles::Admin)){ ?>
							 <li>
                                <?php echo $this->Html->link('<i class="ico-report"></i> ' .  __('Create Organization flowchart') , array('controller' => 'createflowchart', 'action' => 'organization', 'admin' => true, 'plugin' => null), array('escape' => false));?>
                             </li>
                             <li>
                                <?php echo $this->Html->link('<i class="ico-report"></i> ' .  __('Create flowchart') , array('controller' => 'createflowchart', 'action' => 'index', 'admin' => true, 'plugin' => null), array('escape' => false));?>
                             </li>
                             <li class="divider"></li>
                             <?php }
								else if($isdepthead){ ?>
								<li>
                                <?php echo $this->Html->link('<i class="ico-report"></i> ' .  __('Create Organization flowchart') , array('controller' => 'createflowchart', 'action' => 'organization', 'admin' => false, 'plugin' => null), array('escape' => false));?>
								 </li>
								 <li>
									<?php echo $this->Html->link('<i class="ico-report"></i> ' .  __('Create flowchart') , array('controller' => 'createflowchart', 'action' => 'index', 'admin' => false, 'plugin' => null), array('escape' => false));?>
								 </li>
								 <li class="divider"></li>
                             
                             <?php } ?>
                             <li>
                                <?php echo $this->Html->link('<i class="ico-report"></i> ' .  __('View Organization flowchart') , array('controller' => 'flowcharts', 'action' => 'organization', 'admin' => false, 'plugin' => null), array('escape' => false));?>
                             </li>
                             <li>
                                <?php echo $this->Html->link('<i class="ico-report"></i> ' .  __('view flowchart') , array('controller' => 'flowcharts', 'action' => 'index', 'admin' => false, 'plugin' => null), array('escape' => false));?>
                             </li>
						</ul>
                    </li>
                  
                   
                
                </ul>

                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-weight: bold;"><?php echo $this->Html->image($this->Layout->__getAvatarUrl(AuthComponent::user()), array('class' => 'loggedin-info_img')); ?><?php echo AuthComponent::user('username'); ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php if ($this->Session->check('Personification')): ?>
                                <li><?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Stop Personification'), array('controller' => 'users', 'action' => 'personification', 'revert', 'admin' => true, 'plugin' => null), array('escape' => false)); ?></li>
                            <?php endif; ?>
                            <li><?php echo $this->Html->link('<i class="ico-vcard"></i> ' . __('Your profile'), array('controller' => 'users', 'action' => 'profile', 'admin' => false, 'plugin' => null), array('escape' => false)); ?></li>
                            <li class="divider"></li>
                            <li class="nav-icon nav-logout"><?php echo $this->Html->link('<i class="ico-door_out"></i> ' . __('Log-out'), array('controller' => 'users', 'action' => 'logout', 'admin' => false, 'plugin' => null), array('escape' => false)); ?></li>
                            
                        </ul>
                    </li>
                    
                    <li class="dropdown notifications-menu">
                <a id="notification" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i style="color:#fff" class="fa fa-bell-o"></i>
                  <span class="label label-warning"><?php echo $unread; ?></span>
                </a>
                <ul class="dropdown-menu">
               
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <div class="slimScrollDiv">
						<ul  class="menu notification-content">
						<?php 
						foreach($mentions as $mention)
						{
						?>	
							<li>
							  <i class="fa fa-user text-red"></i> You are mentioned in 
							  <label class='label label-important'><?php echo $this->Html->link( __($mention['Notes']['title']), array('controller' => 'notes', 'action' => 'view', $mention['Notes']['id']), array('escape' => false)); ?></label>
							  under <label class='label label-important'> <?php echo $this->Html->link( __($mention['Project']['title']), array('controller' => 'projects', 'action' => 'dashboard', $mention['Project']['slug']), array('escape' => false)); ?></label> 
							  
							  <i class="label"><?php echo $this->Time->timeAgoInWords($mention['Actionitems']['created']); ?></i>
						   </li>
						<?php } ?>
                    </ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 195.121951219512px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
                  </li>
                  <li class="footer">
					<?php echo $this->Html->link('<i class="fa fa-eye"></i> ' . __('View all'), array('controller' => 'dashboard', 'action' => 'mymentions', 'admin' => false, 'plugin' => null), array('escape' => false)); ?>  
					</li>
                </ul>
              </li>
                </ul>
                
                <?php
                echo $this->Form->create('Search', array('url' => array('controller' => 'projects', 'action' => 'search', 'admin' => false), 'class' => 'navbar-search pull-right'));
                echo '<input type="text" name="data[Search][query]" class="search-query input-navsearch" autocomplete="off" placeholder="' . __('Search...') . '" style="width: 120px">
                      <div id="search_suggestions" class="hidden-phone hidden-tablet" style="display: none;"></div>';
                echo $this->Form->end();
                ?>
                <script type="text/javascript">
                    $(function() {
						$('#notification').on('click',function(e){
								e.preventDefault();
								var val=$('#notification .label-warning').html();
								if(val)
								{
									$.post("<?php echo Router::url(array('controller' => 'notifications', 'action' => 'markread', 'admin' => false, 'plugin' => null), true); ?>", function(data) {
										$('#notification .label-warning').html('');
     
									});
								}
							});
						
                        $(".input-navsearch").on("keyup", function(e) {
                            e.preventDefault();

                            if (!$("#phoneTest").is(":visible"))
                            {
                                return;
                            }

                             if ($(this).val().trim().length < 2)
                            {
                                $('#search_suggestions').fadeOut();
                                return;
                            } 

                            delay(function() {
                                $.post("<?php echo Router::url(array('controller' => 'projects', 'action' => 'search_suggestions', 'admin' => false, 'plugin' => null), true); ?>", {"data[Search][query]": "" + $(".input-navsearch").val().trim() + ""}, function(data) {
                                    $('#search_suggestions').fadeIn();
                                    $('#search_suggestions').html(data);
                                });
                            }, 200);
                        });
                        $(".input-navsearch").blur(function() {
                            if ($(this).val().trim() === "")
                                $('#search_suggestions').fadeOut();
                        });
                        $(".navbar-search").on("submit", function(e) {

                        });
                    });
                    var delay = (function() {
                        var timer = 0;
                        return function(callback, ms) {
                            clearTimeout(timer);
                            timer = setTimeout(callback, ms);
                        };
                    })();
                </script>
            </div><!-- /.nav-collapse -->
        </div>
    </div>
</div><div class="hidden-phone hidden-tablet" id="phoneTest"></div>
