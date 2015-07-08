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

/**
 * Layout helper
 */
class LayoutHelper extends AppHelper
{

    public $helpers = array(
        'Html' => array('className' => 'AppHtml'),
        'Text',
        'Time' => array('className' => 'AppTime'),
        'Number' => array('className' => 'AppNumber'),
        'Form' => array('className' => 'AppForm'));

    function __construct(View $view, $settings = array())
    {
        parent::__construct($view, $settings);
    }

    /**
     * Prepares the ClientEngage Project Platform for the fluid layout option
     * @return void
     */
    public function fluid()
    {
        if (AppConfig::read('Layout.fluid') !== true)
            return;

        echo '<style type="text/css">
    @media (min-width: 768px) and (max-width: 980px) {
        body {
            padding-top: 0;
        }
    }
    @media (max-width: 768px) {
        body {
            padding-top: 0;
        }
    }           
</style>';

        echo $this->Html->css('bootstrap/css/bootstrap-responsive.min');
    }

    /**
     * Returns the verbose version of a boolean value
     * @param boolean $bool The boolean value to be rendered verbose
     * @return string Yes or No (in the respective locale)
     */
    public function boolYesNo($bool = null)
    {
        if ($bool === null)
            return __('N/A');
        if ($bool === true)
            return __('Yes');
        else
            return __('No');
    }

    /**
     * Renders activity notifications
     * @param array $notification The notification to be rendered
     * @return string HTML output rendering a notification
     */
    public function renderNotification($notification = null)
    {
        if (isset($notification['Notification']))
            foreach ($notification['Notification'] as $k => $v)
                $notification[$k] = $v;

        $deletedInfo = $notification['deleted'] ? $this->renderHelpIcon(__('The affected record has since been deleted')) : '';

        $notification['title'] = $this->Text->truncate(strip_tags($notification['title']), 100, array('ending' => ' [...]', 'exact' => false));

        $phase = '';
        if (isset($notification['Phase']['id']))
        {
            $phase = $this->Html->link($notification['Phase']['title'], array('controller' => 'projects', 'action' => 'phase', $notification['Phase']['slug'], '#' => $notification['foreign_key'], 'admin' => false)) . ': ';
        }

        $projectLink = (isset($notification['Project']['id']) && AppAuth::is(UserRoles::Admin)) ? $this->Html->link($notification['Project']['title'], array('controller' => 'projects', 'action' => 'dashboard', $notification['Project']['slug'], 'admin' => false)) . ': ' : '';
        $deleteAction = AppAuth::is(UserRoles::Admin) ? $this->Form->postLink(__('Delete'), array('controller' => 'notifications', 'action' => 'delete', $notification['id'], 'admin' => true), array('escape' => false, 'class' => 'btn btn-danger btn-mini pull-right'), __('Are you sure you want to delete this notification?')) : '';

        if ($notification['action'] == 'create')
        {
            return '<div class="well notification-container notification-created">' . $deleteAction . String::insert(__('<span class="label" data-rel="tooltip" data-original-title=":created">:date:</span><br />:username<br />:prefixinfo<span class="label label-inverse">Created</span> a new element of type <code>:elementtype</code>: <span class="muted">:title</span>'), array(
                        'created' => $this->Time->nice($notification['created']),
                        'prefixinfo' => $deletedInfo . $projectLink . $phase,
                        'date' => $this->Time->timeAgoInWords($notification['created']),
                        'username' => $this->renderUsername($notification['User'], true),
                        'elementtype' => __($notification['model']),
                        'title' => $notification['title'],
                    )) . '</div>';
        }
        else
        {
            $old = $new = null;
            if (strpos($notification['field'], 'date') !== false)
            {
                $old = ($notification['value_old'] === null ? __('N/A') : $this->Time->nice($notification['value_old']));
                $new = ($notification['value_new'] === null ? __('N/A') : $this->Time->nice($notification['value_new']));
            }
            else if (strpos($notification['field'], 'percent') !== false)
            {
                $old = ($notification['value_old'] === null ? __('N/A') : $notification['value_old']) . '%';
                $new = ($notification['value_new'] === null ? __('N/A') : $notification['value_new']) . '%';
            }
            else
            {
                $old = ($notification['value_old'] === null ? __('N/A') : $notification['value_old']);
                $new = ($notification['value_new'] === null ? __('N/A') : $notification['value_new']);
            }

            return '<div class="well notification-container notification-updated">' . $deleteAction . String::insert(__('<span class="label" data-rel="tooltip" data-original-title=":created">:date:</span><br />:username<br />:prefixinfo<span class="label label-inverse">Updated</span> the field <code>:field</code> of the element <code>:elementtype</code> from <span class="label label-warning">:oldvalue</span> to <span class="label label-success">:newvalue</span>: <span class="muted">:title</span>'), array(
                        'created' => $this->Time->nice($notification['created']),
                        'prefixinfo' => $deletedInfo . $projectLink . $phase,
                        'date' => $this->Time->timeAgoInWords($notification['created']),
                        'username' => $this->renderUsername($notification['User'], true),
                        'field' => __($notification['field']),
                        'elementtype' => __($notification['model']),
                        'title' => $notification['title'],
                        'oldvalue' => $old,
                        'newvalue' => $new,
                    )) . '</div>';
        }
    }

    /**
     * Renders the taskl checkbox of a comment
     * @param array $comment The comment for which to render the task
     * @return string HTML output of the rendered task-checkbox
     */
    public function renderTaskCheckbox($comment = null, $projectarchived = false)
    {
        if ($comment === null)
            return;
        if (isset($comment['Comment']))
        {
            foreach ($comment['Comment'] as $k => $v)
                $comment[$k] = $v;

            unset($comment['Comment']);
        }

        $out = '<div class="checktask-container">';

        $label = '';
        $isCompleted = false;
        if ($comment['completed_date'] !== null)
        {
            $title = $this->Time->nice($comment['completed_date']) . (AppAuth::is(UserRoles::Admin) ? ' (IP: ' . $comment['completed_ip'] . ')' : '');
            $label = '<i class="check-task check-task-on" data-rel="tooltip" data-original-title="' . $title . '"></i>';
            $isCompleted = true;
        }
        else
        {
            $label = '<i class="check-task"></i>';
        }

        $out .= $this->Form->create('Comment', array('controller' => 'comments', 'action' => 'statuschange', 'class' => 'clearform'));
        $out .= $this->Form->input('id', array('type' => 'hidden', 'value' => $comment['id']));
        $out .= $this->Form->input('set_completed', array('type' => 'checkbox', 'label' => $label, 'class' => 'hide check-task_complete', 'id' => 'checktask-' . $comment['id'], 'div' => false, 'before' => false, 'after' => false, 'between' => false));

        switch ($comment['priority'])
        {
            case TaskPriority::Low:
                $out .= '<span class="label">Low</span>';
                break;
            case TaskPriority::Normal:
                $out .= '<span class="label label-info">Normal</span>';
                break;
            case TaskPriority::High:
                $out .= '<span class="label label-important">High</span>';
                break;
        }

        if (!$projectarchived)
            $out .= $this->Form->input('send_activity', array('type' => 'checkbox', 'label' => false, 'checked' => AppConfig::read('Email.checked_default'), 'after' => ' ' . $this->renderHelpIcon(__('Send email notification to project members?')) . '</div>'));

        $out .= $this->Form->end();

        $out .= '</div>';

        return $out;
    }

    public function renderTaskPriorityLabel($comment = array())
    {
        switch ($comment['priority'])
        {
            case TaskPriority::Low:
                return '<span class="label">Low</span>';
                break;
            case TaskPriority::Normal:
                return '<span class="label label-info">Normal</span>';
                break;
            case TaskPriority::High:
                return '<span class="label label-important">High</span>';
                break;
        }
    }

    /**
     * Displays the default edit actions for administrative functions
     * @param string $actions The set of actions that shall be rendered
     * @param array $options The routing options to be passed
     * @return string Rendered HTML markup of edit actions
     */
    public function editActions($actions = 'default', $options = array())
    {
        $options = Set::merge(array('class' => '', 'linktext' => '<i class="ico-cog"></i> ' . __('Actions'), 'btn' => 'primary', 'admin' => true), $options);

        $url = array();
        if (isset($options['controller']))
            $url = array('controller' => $options['controller'], 'admin' => $options['admin']);

        $out = '
            <div class="btn-group inline ' . $options['class'] . '">
          <button class="btn btn-mini btn-' . $options['btn'] . ' dropdown-toggle" data-toggle="dropdown">' . $options['linktext'] . ' <span class="caret"></span></button>
          <ul class="dropdown-menu">';

        if ($actions == 'default' || is_array($actions) && (in_array('view', $actions)))
            $out .= '<li>' . $this->Html->link('<i class="ico-folder_go"></i> ' . __('View'), array_merge($url, array('action' => 'view', $options['id'])), array('escape' => false)) . '</li>';
        if ($actions == 'default' || is_array($actions) && (in_array('edit', $actions)))
            $out .= '<li>' . $this->Html->link('<i class="ico-pencil"></i> ' . __('Edit'), array_merge($url, array('action' => 'edit', $options['id'])), array('escape' => false)) . '</li>';
        if (is_array($actions) && (in_array('addphase', $actions)))
            $out .= '<li>' . $this->Html->link('<i class="ico-add"></i> ' . __('Add Phase'), array_merge($url, array('controller' => 'phases', 'action' => 'add', $options['id'])), array('escape' => false)) . '</li>';
        if ($actions == 'default' || is_array($actions) && (in_array('delete', $actions)))
            $out .= '<li class="divider"></li>
                 <li>' . $this->Form->postLink('<i class="ico-bin_closed"></i> ' . __('Delete'), array_merge($url, array('action' => 'delete', $options['id'])), array('escape' => false), __('Are you sure you want to proceed with the deletion? This will also delete all associated records and cannot be undone.')) . '</li>';

        $out .= '   </ul>
        </div>';

        return $out;
    }

    /**
     * 
     * @param string $actions The set of actions that shall be rendered
     * @param array $options The routing options to be passed
     * @return string Rendered HTML markup of edit actions
     */
    public function inlineoptions($actions = 'default', $options = array())
    {
		$options = Set::merge(array('class' => '', 'linktext' => '<i class="ico-cog"></i> ' . __('Actions'), 'btn' => 'primary', 'admin' => true), $options);

        $url = array();
        if (isset($options['controller']))
            $url = array('controller' => $options['controller'], 'admin' => $options['admin']);
		$out = '<div class="inline-link ' . $options['class'] . '">';
          
		if ($actions == 'default' || is_array($actions) && (in_array('view', $actions)))
            $out .= $this->Html->link('<i class="ico-folder_go"></i> ' . __('View'), array_merge($url, array('action' => 'view', $options['id'])), array('escape' => false));
        if ($actions == 'default' || is_array($actions) && (in_array('edit', $actions)))
            $out .= $this->Html->link('<i class="ico-pencil"></i> ' . __('Edit'), array_merge($url, array('action' => 'edit', $options['id'])), array('escape' => false));
        if (is_array($actions) && (in_array('addphase', $actions)))
            $out .= $this->Html->link('<i class="ico-add"></i> ' . __('Add Phase'), array_merge($url, array('controller' => 'phases', 'action' => 'add', $options['id'])), array('escape' => false));
        if ($actions == 'default' || is_array($actions) && (in_array('delete', $actions)))
            $out .= $this->Form->postLink('<i class="ico-bin_closed"></i> ' . __('Delete'), array_merge($url, array('action' => 'delete', $options['id'])), array('escape' => false), __('Are you sure you want to proceed with the deletion? This will also delete all associated records and cannot be undone.')) ;
        $out .= '</div>'; 
         return $out;       
	} 
     
    public function editActionsAdminUser($actions = 'default', $options = array())
    {
        $options = Set::merge(array('class' => '', 'linktext' => '<i class="ico-cog"></i> ' . __('Actions'), 'btn' => 'primary', 'admin' => true), $options);

        $url = array();
        if (isset($options['controller']))
            $url = array('controller' => $options['controller'], 'admin' => $options['admin']);

        $out = '
            <div class="btn-group inline ' . $options['class'] . '">
          <button class="btn btn-mini btn-' . $options['btn'] . ' dropdown-toggle" data-toggle="dropdown">' . $options['linktext'] . ' <span class="caret"></span></button>
          <ul class="dropdown-menu">';

        if ($actions == 'default' || is_array($actions) && (in_array('view', $actions)))
            $out .= '<li>' . $this->Html->link('<i class="ico-folder_go"></i> ' . __('View'), array_merge($url, array('action' => 'administrators_view', $options['id'])), array('escape' => false)) . '</li>';
        if ($actions == 'default' || is_array($actions) && (in_array('edit', $actions)))
            $out .= '<li>' . $this->Html->link('<i class="ico-pencil"></i> ' . __('Edit'), array_merge($url, array('action' => 'administrators_edit', $options['id'])), array('escape' => false)) . '</li>';
        if ($actions == 'default' || is_array($actions) && (in_array('delete', $actions)))
            $out .= '<li class="divider"></li>
                 <li>' . $this->Form->postLink('<i class="ico-bin_closed"></i> ' . __('Delete'), array_merge($url, array('action' => 'delete', $options['id'])), array('escape' => false), __('Are you sure you want to proceed with the deletion? This will also delete all associated records and cannot be undone.')) . '</li>';

        $out .= '   </ul>
        </div>';

        return $out;
    }

    /**
     * Syste,-wide default display for DateTime values
     * @param string $time The DateTime to be rendered
     * @return string Rendered display version of the DateTime
     */
    public function displayTimeDefault($time = null)
    {
        if ($time === null)
            return '';
        else
            return '<span data-original-title="' . $this->Time->timeAgoInWords($time) . '" data-rel="tooltip">' . $this->Time->nice($time) . '</span>';
    }

    /**
     * Renders tthe DateTime of phases & projects; treats null-values as empty
     * @param string $time The DateTime to be rendered
     * @return string the formatted DateTime
     */
    public function displayProjectDates($time = null)
    {
        if ($time === null)
            return '';
        else
            return $this->Time->format(AppLanguages::getDateFormat(DateFormats::ProjectDate), $time);
    }

    /**
     * 
     * @param string $text The string to be rendered in a help icon
     * @return string The HTML markup of the help icon & tooltip
     */
    public function renderHelpIcon($text = '')
    {
        $out = '<i class="ico-information" data-rel="tooltip" tabindex="100" data-original-title="' . $text . '"></i>';
        return $out;
    }

    /**
     * Used to render an icon & tooltip for showing disallowed/blacklisted file-extensions
     * @return string HTML output of the icon & tooltip indicating disallowed file-extensions
     */
    public function renderExtBlacklistIcon()
    {
        $blackList = AppConfig::read('Uploads.extension_blacklist');
        if ($blackList == null || $blackList == '')
            return '';

        $blackList = explode('|', '.' . implode('|.', explode(',', $blackList)));

        return $this->renderHelpIcon(__('Blacklisted file extensions: ') . $this->Text->toList($blackList, __('and')));
    }

    /**
     * 
     * @param array $attachment The attachment for which the file extension icon is to be rendered
     * @return string Returns the icon string (i-tag) for the respective file extension
     */
    public function renderExtIcon($attachment = null)
    {
        $extToIcon = array(
            'txt' => 'ico-page_white_text',
            'doc' => 'ico-page_white_word',
            'docx' => 'ico-page_white_word',
            'xls' => 'ico-page_white_excel',
            'xlsx' => 'ico-page_white_excel',
            'csv' => 'ico-page_white_excel',
            'pdf' => 'ico-page_white_acrobat',
            'ppt' => 'ico-page_white_powerpoint',
            'pptx' => 'ico-page_white_powerpoint',
            'zip' => 'ico-page_white_compressed',
            'rar' => 'ico-page_white_compressed',
            'tar' => 'ico-page_white_compressed',
            '7z' => 'ico-page_white_compressed',
            'gz' => 'ico-page_white_compressed',
            'jpg' => 'ico-page_white_picture',
            'jpeg' => 'ico-page_white_picture',
            'png' => 'ico-page_white_picture',
            'gif' => 'ico-page_white_picture',
            'tiff' => 'ico-page_white_picture',
            'mpeg' => 'ico-film',
            'mpg' => 'ico-film',
            'avi' => 'ico-film',
            'mov' => 'ico-film',
            'wmv' => 'ico-film',
            'wma' => 'ico-film',
            'mkv' => 'ico-film',
            'mp3' => 'ico-music',
        );
        $class = 'ico-page_white';
        if ($attachment['type'] == AttachmentType::Url)
        {
            $class = 'ico-link_go';
        }
        else
        {
            if (trim($attachment['file_extension']) != '' && isset($extToIcon[$attachment['file_extension']]))
            {
                $class = $extToIcon[$attachment['file_extension']];
            }
        }


        $out = '<i class="' . $class . '" title="' . ($attachment['file_extension'] != '' ? String::insert(__('File type: :extension'), array('extension' => $attachment['file_extension'])) : __('External link')) . '"></i>';
        return $out;
    }

    /**
     * 
     * @param array $attachment The attachment to be rendered for display
     * @return string Rendered HTML markup showing the attachment's information
     */
    public function renderAttachmentInfo($attachment = null)
    {
        $info = $this->renderExtIcon($attachment) . ' ';

        switch ($attachment['type'])
        {
            case AttachmentType::Url:
                $info .= $this->Html->link((trim($attachment['title']) != '' ? $attachment['title'] : $attachment['link_url']), $attachment['link_url'], array('target' => '_blank', 'title' => String::insert(__('Open ":website_url" in a new window'), array('website_url' => $attachment['link_url']))));
                break;
            case AttachmentType::Upload:
                $text = $attachment['title'] != '' ? $attachment['title'] : $attachment['file_name'];
                $info .= $this->Html->link($text, array('plugin' => null, 'admin' => false, 'controller' => 'attachments', 'action' => 'download', $attachment['id'], $attachment['file_name']), array('title' => __('Original file name: ') . $attachment['file_name']));
                $info .= ' <span class="smalltext muted">(' . $this->Number->toReadableSize($attachment['file_size']) . ')</span>';
                if (in_array($attachment['file_extension'], array('jpg', 'jpeg', 'png', 'gif')))
                {
                    $info .= ' <i class="ico ico-magnifier image-preview" data-thumb="' . Router::url(array('admin' => false, 'plugin' => null, 'controller' => 'attachments', 'action' => 'download', $attachment['id'], $attachment['file_name'], 'custom')) . '"></i>';
                }
                break;
        }

        return $info;
    }

    private static $avatarPathCache = array();

    /**
     * Generates the url to the avatar for the passed user
     * @param type $user User
     * @return string url to the passed user's avatar-image
     */
    public function __getAvatarUrl($user = null)
    {
        if (!$user)
            return null;

        // Has already been cached
        if (isset(self::$avatarPathCache[$user['id']]))
            return self::$avatarPathCache[$user['id']];

        // User has custom avatar-image
        if (isset($user['avatarpath']) && $user['avatarpath'] != '')
        {
            self::$avatarPathCache[$user['id']] = Router::url(array('controller' => 'users', 'action' => 'avatar', $user['id'], $user['avatarpath'], 'admin' => false), true);
            return self::$avatarPathCache[$user['id']];
        }

        // No custom avatar-image: return identicon
        self::$avatarPathCache[$user['id']] = 'defaults/default_avatar.jpg';
        return self::$avatarPathCache[$user['id']];
    }

    /**
     * Holds an in-memory cache of already generated username html markup
     * @var array 
     */
    private static $_userNameCache = array();

    /**
     * Renders the HTML display of the passed user's username for display
     * @param type $user
     * @return string Rendered HTML code for the passed user's username 
     */
    public function renderUsername($user = null, $showMenu = true, $showAvatar = true)
    {
        if (isset($user['User']))
            foreach ($user['User'] as $field => $val)
                $user[$field] = $val;

        $link = '#';
        if (isset($user['id']))
            $link = array('controller' => 'users', 'action' => 'view', $user['id'], 'admin' => true);

        if (!isset($user['id']))
        {
            $user = array('id' => 'deleteduser', 'username' => 'Deleted User', 'role' => UserRoles::Client);
            $showMenu = false;
        }
        if (isset(self::$_userNameCache[$user['id']]))
            return self::$_userNameCache[$user['id']];

        $content = '';
        if ($showAvatar)
            $content .= $this->Html->image($this->__getAvatarUrl($user), array('class' => 'avatar-small', 'alt' => String::insert(__('Picture of :username'), array('username' => $user['username']))));

        $content .= $user['username'] . ($user['role'] == UserRoles::Admin ? '<i class="ico-bullet_star admin-ico-pull-up" title="' . __('Administrator') . '"></i>' : '') . $this->renderStatusBullet($user);



        $linkcontent = '';
        if ($showMenu)
            $linkcontent = $this->Html->link($content, $link, array('escape' => false, 'class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
        else
            $linkcontent = $this->Html->link($content, $link, array('escape' => false));


        if ($showMenu)
            $linkcontent = $this->addUserMenu($user, $linkcontent);

        self::$_userNameCache[$user['id']] = '<div class="username inline">' . $linkcontent . '</div>';
        return self::$_userNameCache[$user['id']];
    }

    /**
     * 
     * @param array $user Array of the user's data
     * @return string Image-tag holding the respective user's avatar
     */
    public function renderAvatar($user = null)
    {
        if (isset($user['User']))
            foreach ($user['User'] as $field => $val)
                $user[$field] = $val;

        return $this->Html->image($this->__getAvatarUrl($user), array('class' => 'avatar', 'alt' => String::insert(__('Picture of :username'), array('username' => $user['username']))));
    }

    /**
     * Renders the passed user's online-status bullet
     * @param array $user The user for which to display the online-status
     * @return string The online-status bullet of the passed user
     */
    public function renderStatusBullet($user = null)
    {
        if (isset($user['lastactivity']))
        {
            $current_time = strtotime(date("Y-m-d H:i:s")); // CURRENT TIME 
            $last_visit = strtotime($user['lastactivity']); // LAST VISITED TIME 

            $time_period = floor(round(abs($current_time - $last_visit) / 60, 2)); //CALCULATING MINUTES 

            if ($time_period <= 10)
                return '<div class="bullet_status status_online" title="' . __('Currently online') . '"></div>';
        }

        return '<div class="bullet_status status_offline" title="' . __('Not currently online') . ' | ' . __('Last seen: ') . $this->Time->timeAgoInWords($user['lastactivity']) . '"></div>';
    }

    /**
     * 
     * @param array $user The user for which the menu is intended
     * @param string $linkcontent The pre-rendered content for within the menu
     * @return string The final, rendered user-info with surrounding menu
     */
    public function addUserMenu($user, $linkcontent)
    {
        if (!AppAuth::is(UserRoles::Admin))
            return $linkcontent;

        $divider = '<li class="divider"></li>';
        $html = '<span class="dropdown">' . $linkcontent . '<ul class="dropdown-menu">';

        $html .= '<li>' . $this->Html->link(__('View Profile'), array('controller' => 'users', 'action' => 'view', $user['id'], 'admin' => true)) . '</li>';

        if (($user['id'] != AppAUth::user('id')) && Configure::read('debug') > 0)
            $html .= $divider . '<li>' . $this->Html->link(__('Personify User'), array('controller' => 'users', 'action' => 'personification', 'personify', 'admin' => true, $user['id'])) . '</li>';


        $html .= '</ul></span>';

        return $html;
    }

    /**
     * Determines the status of the passed phase
     * @param array $phase The Phase for which to return the current status
     * @return string Returns the current status of the passed Phase
     */
    public function getPhaseStatus($phase = null)
    {

        if ($phase['percent_completed'] == 100)
            return 'completed';

        if ($phase['percent_completed'] != 100 && strtotime($phase['date_end']) < time())
            return 'overdue';

        if (strtotime($phase['date_start']) < time() && strtotime($phase['date_end']) > time())
            return 'running';

        return 'waiting';
    }

    /**
     * Returns the respective icon of a phase's status
     * @param string $status The status of the Phase 
     * @return string|null Returns the icon of the respective Phase's status
     */
    public function phaseStatusToIcon($status = null)
    {
        switch ($status)
        {
            case PhaseStatus::Completed:
                return '<i class="ico-tick" data-rel="tooltip" title="' . __('completed') . '"></i>';
                break;
            case PhaseStatus::Overdue:
                return '<i class="ico-error" data-rel="tooltip" title="' . __('overdue') . '"></i>';
                break;
            case PhaseStatus::Running:
                return '<i class="ico-time" data-rel="tooltip" title="' . __('running') . '"></i>';
                break;
            case PhaseStatus::Waiting:
                return '<i class="ico-control_pause" data-rel="tooltip" title="' . __('waiting') . '"></i>'; // TODO: OTHER HERE
                break;
        }
        return null;
    }

    /**
     * Returns the progress-bar style of the respectively passed phase status
     * @param string $status The Phase's status
     * @return string|null Returns the progressbar-style for the respectively passed status
     */
    public function phaseStatusToProgStyle($status = null)
    {
        switch ($status)
        {
            case PhaseStatus::Completed:
                return 'progress progress-success';
                break;
            case PhaseStatus::Overdue:
                return 'progress progress-danger progress-striped active';
                break;
            case PhaseStatus::Running:
                return 'progress progress-info progress-striped active';
                break;
            case PhaseStatus::Waiting:
                return 'progress progress-info';
                break;
        }
        return null;
    }

    public function renderPreviewJS()
    {
        return $this->Html->scriptBlock('
$(function() {

        $("i.image-preview").hover(function(e){
            $(this).attr("data-title", $(this).attr("title"));
            $(this).attr("title", "");
            $("body").append("<div class=\'img-preview-container\'>' . str_replace("\"", "'", $this->Html->image('common/loading.gif', array('class' => 'loading-indicator'))) . '<img style=\'display: none;\' src=\'"+ $(this).attr(\'data-thumb\') +"\' /></div>");
            var top = $(this).position().top + 16;
            var left = $(this).position().left + 16;
            $(".img-preview-container").css("top", top + "px").css("left", left + "px").fadeIn("fast").css("position", "absolute");
            
            $(".img-preview-container img").load(function(){
                $(".img-preview-container img").show(0);
                $(".img-preview-container .loading-indicator").hide(0);
            });
        },
        function(){
            $(this).attr("title", $(this).attr("data-title"));
            $(".img-preview-container").fadeOut("fast", function(){
                $(this).remove();
            })
        });
});            
');
    }

}
