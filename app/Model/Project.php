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
App::uses('AppModel', 'Model');

/**
 * Project Model
 *
 * @property Phase $Phase
 * @property Client $Client
 */
class Project extends AppModel
{

    /**
     * Holds this model's name
     * @var string 
     */
    public $name = 'Project';

    /**
     * Contains this model's display field
     * @var string 
     */
    public $displayField = 'title';

    /**
     * Contains the behaviours that are attached to this model
     * @var array 
     */
    public $actsAs = array(
        'Utility.Sluggable',
        'Notification' => array(
            'observeCreate' => true
        )
    );

    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
    }

    /**
     * Contains the validation rules for this model's data
     * @var array 
     */
    public $validate = array(
        'title' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter a name.'
            ),
            'maxlength' => array(
                'rule' => array('maxLength', 240),
                'message' => 'Please enter less than 240 characters.'
            )
        ),
        'slug' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter a valid Url segment.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'This URL has already been taken'
            ),
            'validslug' => array(
                'rule' => '/^[a-z0-9-_]+$/',
                'message' => 'Please enter a valid Url segment.'
            )
        ),
        'phase_count' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid integer.'
            ),
        ),
    );

    /**
     * Contains this model's hasMany entity associations
     *
     * @var array
     */
    public $hasMany = array(
		'Notes' => array(
            'className' => 'Notes',
            'foreignKey' => 'project_id',
            'dependent' => true,
            'conditions' => '',
            'group' => 'Notes.version',
            'order' => 'Notes.version desc',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Notescomment' => array(
            'className' => 'Notescomment',
            'foreignKey' => 'note_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => 'Notescomment.created desc',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Phase' => array(
            'className' => 'Phase',
            'foreignKey' => 'project_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => 'Phase.position asc',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Notification' => array(
            'className' => 'Notification',
            'foreignKey' => 'project_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => 'Notification.created desc',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
        
    );

    /**
     * Contains this model's hasAndBelongsTo entity associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Client' => array(
            'className' => 'Client',
            'joinTable' => 'projects_clients',
            'foreignKey' => 'project_id',
            'associationForeignKey' => 'client_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ),
        'User' => array(
            'className' => 'User',
            'joinTable' => 'projects_users',
            'foreignKey' => 'project_id',
            'associationForeignKey' => 'user_id',
            'unique' => 'keepExisting',
            'with' => 'ProjectsUser',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ),
    );

    public function getPhase($phase_slug)
    {

        $commentConditions = array();
        $commentConditions[] = array('Comment.parent_id' => null);

        $childCommentConditions = array();

        if (AppAuth::is(UserRoles::Client))
        {
            $commentConditions[] = array('Comment.admin_only' => false);
            $childCommentConditions = array('ChildComment.admin_only' => false);
        }
        return $this->Phase->find('first', array(
                    'conditions' => array('Phase.slug' => $phase_slug),
                    'contain' => array(
                        'Comment' => array(
                            'conditions' => $commentConditions,
                            'Attachment',
                            'User',
                            'ChildComment' => array('Attachment', 'User', 'conditions' => $childCommentConditions)
                        ),
                        'Project' => array(
                            'Phase' => array(
                                'fields' => array('id', 'slug', 'title', 'description', 'date_start', 'date_end', 'percent_completed', 'position'),
                            )
        ))));
    }

    /**
     * Returns the project dashboard for when viewing a project in the front-end
     * @param type $project_slug
     * @return array
     */
    public function getDashboard($project_slug)
    {
        return $this->find('first', array(
                    'conditions' => array('Project.slug' => $project_slug),
                    'contain' => array(
                        'Notification' => array('limit' => 10, 'order' => 'Notification.created DESC', 'User', 'Phase'),
                        'Phase' => array('id', 'slug', 'title', 'description', 'date_start', 'date_end', 'percent_completed', 'position'),
                        'Client' => array('User' => array('id', 'client_id', 'role', 'username', 'lastactivity', 'avatarpath')),
                        'User',
                        'Notes',
        )));
    }

    /**
     * Returns all projects associated to a user
     * @return array
     */
    public function getUserProjects()
    {
        $client_id = AppAuth::user('client_id');
        $projects = $this->Client->find('first', array(
            'conditions' => array('Client.id' => $client_id),
            'contain' => array(
                'Project' => array(
                    'conditions' => array('Project.archived' => false),
                    'Phase',
                    'Notification' => array(
                        'User',
                        'order' => 'Notification.created DESC',
                        'limit' => 5
                    ),
                    'User' => array('fields' => array('id', 'username'))))));

        return $projects;
    }

    /**
     * gets the quick links for the main topbar menu
     * @param type $for
     * @return array
     */
    public function getQuickLinks($for = 'client')
    {
        if ($for == 'client')
        {
            $client_id = AppAuth::user('client_id');

            if (($projects = Cache::read('quicklinks_' . $client_id, AppCaches::Project)) === false)
            {
                $projects = $this->Client->find('first', array(
                    'conditions' => array('Client.id' => $client_id),
                    'contain' => array(
                        'Project' => array(
                            'conditions' => array('Project.archived' => false),
                            'fields' => array('title', 'slug'),
                            'order' => 'Project.created DESC',
                            'limit' => 10
                ))));

                if ($projects)
                    Cache::write('quicklinks_' . $client_id, $projects, AppCaches::Project);
            }

            $projects = $projects['Project'];
        } else
        {
            if (($projects = Cache::read('quicklinks_admin', AppCaches::Project)) === false)
            {
                $projects = $this->find('all', array(
                    'limit' => 10,
                    'order' => 'Project.created DESC',
                    'conditions' => array('Project.archived' => false),
                    'fields' => array('id', 'title', 'slug', 'created')));

                foreach ($projects as $k => $p)
                {
                    foreach ($p['Project'] as $f => $v)
                        $projects[$k][$f] = $v;
                    unset($projects[$k]['Project']);
                }

                if ($projects)
                    Cache::write('quicklinks_admin', $projects, AppCaches::Project);
            }
        }

        return $projects;
    }

    /**
     * Duplicates a Project with all its associated Phases and re-bases the dates on "today"
     * @param string $project_id
     * @return bool Success
     * @throws BadMethodCallException
     */
    public function duplicate($project_id = null)
    {
        if ($project_id == null)
            throw new BadMethodCallException();

        $project = $this->find('first', array(
            'conditions' => array('Project.id' => $project_id),
            'contain' => array('Phase')
        ));

        $baseDate = strtotime($project['Project']['date_start']);
        $now = time();
        $diff = ($now - $baseDate);


        $project['Project']['title'] .= __('_Copy');
        unset($project['Project']['id']);
        unset($project['Project']['slug']);
        unset($project['Project']['percent_completed']);
        unset($project['Project']['created']);
        unset($project['Project']['modified']);
        $project['Project']['date_start'] = date('Y-m-d', strtotime($project['Project']['date_start']) + $diff);
        $project['Project']['date_end'] = date('Y-m-d', strtotime($project['Project']['date_end']) + $diff);

        foreach ($project['Phase'] as &$phase)
        {
            unset($phase['id']);
            unset($phase['project_id']);
            unset($phase['slug']);
            unset($phase['comment_count']);
            unset($phase['percent_completed']);
            unset($phase['created']);
            unset($phase['modified']);

            $phase['date_start'] = date('Y-m-d', strtotime($phase['date_start']) + $diff);
            $phase['date_end'] = date('Y-m-d', strtotime($phase['date_end']) + $diff);
        }
        return $this->saveAssociated($project);
    }

    public function hasAccess($user = array(), $project_slug = '')
    {
        $accessCheck = $this->find('first', array(
            'conditions' => array('Project.slug' => $project_slug),
            'contain' => array(
                'ProjectsClient',
                'Client' => array(
                    'fields' => array('id'),
                    'User' => array(
                        'fields' => array('id', 'client_id', 'username'),
                        'conditions' => array('User.id' => $user['id'])))),
        ));
        $extrUser = Set::extract('Client.{n}.User', $accessCheck);
        if ($extrUser === null)
            return false;
        else
            return !empty($extrUser);
    }

    public function afterSave($created)
    {
        parent::afterSave($created);
        Cache::clearGroup('project', AppCaches::Project);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        Cache::clearGroup('project', AppCaches::Project);
    }

    public function beforeSave($options = array())
    {
        if (!parent::beforeSave($options))
            return false;

        App::import('Utility', 'CakeTime');
        if (isset($this->data[$this->alias]['date_start']))
        {
            $start = $this->data[$this->alias]['date_start'] . ' 00:00';
            $this->data[$this->alias]['date_start'] = CakeTime::toServer($start, AppAuth::user('timezone'));
        }
        if (isset($this->data[$this->alias]['date_end']))
        {
            $end = $this->data[$this->alias]['date_end'] . ' 00:00';
            $this->data[$this->alias]['date_end'] = CakeTime::toServer($end, AppAuth::user('timezone'));
        }
        return true;
    }

    public function getFavourites()
    {
        $favourites = $this->ProjectsUser->find('all', array(
            'conditions' => array('ProjectsUser.user_id' => AppAuth::user('id')),
            'contain' => array('Project' => array('fields' => array('id', 'title', 'slug')))));

        return Hash::extract($favourites, '{n}.Project');
    }

    public function search($query, $limit = 5,$contain=null)
    {
        if (AppAuth::is(UserRoles::Admin))
        {
            $data= array(
                'Project' => $this->find('all', array(
                    'conditions' => array(
                        'OR' => array(
                            'Project.title LIKE' => '%' . $query . '%',
                            'Project.description LIKE' => '%' . $query . '%',
                        )
                    ),
                    'fields' => array('id', 'title', 'description', 'slug'),
                    'limit' => $limit
                )),
                'Phase' => $this->Phase->find('all', array(
                    'conditions' => array(
                        'OR' => array(
                            'Phase.title LIKE' => '%' . $query . '%',
                            'Phase.description LIKE' => '%' . $query . '%',
                        )
                    ),
                    'fields' => array('id', 'title', 'description', 'slug'),
                    'limit' => $limit
                )),
                'Comment' => $this->Phase->Comment->find('all', array(
                    'conditions' => array(
                        'Comment.content LIKE' => '%' . $query . '%',
                    ),
                    'fields' => array('id', 'content', 'needsaction'),
                    'contain' => array('Phase.slug'),
                    'limit' => $limit
                )),
                'Notes' => $this->Notes->find('all', array(
                    'conditions' => array(
						'OR' => array(
						'Notes.title LIKE' => '%' . $query . '%',
                        'Notes.description LIKE' => '%' . $query . '%',
						)
                        
                    ),
                    'fields' => array('id', 'title', 'description', 'slug'),
                    
                    'limit' => $limit
                )),
                'Notescomment' => $this->Notescomment->find('all', array(
                    'conditions' => array(
                        'Notescomment.content LIKE' => '%' . $query . '%',
                    ),
                    'fields' => array('id', 'content','note_id'),
                    
                    'limit' => $limit
                )),
                
            );
            return $contain==null?$data :$data[$contain];
        }

        $accessTo = ClassRegistry::init('ProjectsClient')->find('all', array(
            'conditions' => array('ProjectsClient.client_id' => AppAuth::user('client_id')),
            'contain' => array('Project' => array('Phase' => array('fields' => array('id', 'project_id', 'slug')), 'fields' => array('id', 'slug')))
        ));

        $projectIDs = Hash::extract($accessTo, '{n}.Project.id');
        $phaseIDs = Hash::extract($accessTo, '{n}.Project.Phase.{n}.id');

        $data= array(
            'Project' => $this->find('all', array(
                'conditions' => array(
                    'OR' => array(
                        'Project.title LIKE' => '%' . $query . '%',
                        'Project.description LIKE' => '%' . $query . '%',
                    ),
                    'Project.id' => $projectIDs
                ),
                'fields' => array('id', 'title', 'description', 'slug'),
                'limit' => $limit
            )),
            'Phase' => $this->Phase->find('all', array(
                'conditions' => array(
                    'OR' => array(
                        'Phase.title LIKE' => '%' . $query . '%',
                        'Phase.description LIKE' => '%' . $query . '%',
                    ),
                    'Phase.id' => $phaseIDs
                ),
                'fields' => array('id', 'title', 'description', 'slug'),
                'limit' => $limit
            )),
            'Comment' => $this->Phase->Comment->find('all', array(
                'conditions' => array(
                    'Comment.content LIKE' => '%' . $query . '%',
                    'Comment.phase_id' => $phaseIDs
                ),
                'fields' => array('id', 'content', 'needsaction'),
                'contain' => array('Phase.slug'),
                'limit' => $limit
            )),
            'Notes' => $this->Notes->find('all', array(
                    'conditions' => array(
						'OR' => array(
						'Notes.title LIKE' => '%' . $query . '%',
                        'Notes.description LIKE' => '%' . $query . '%',
						)
                        
                    ),
                    'fields' => array('id', 'title', 'description', 'slug'),
                    
                    'limit' => $limit
                )),
                'Notescomment' => $this->Notescomment->find('all', array(
                    'conditions' => array(
                        'Notescomment.content LIKE' => '%' . $query . '%',
                    ),
                    'fields' => array('id', 'content','note_id'),
                    'contain' => array('Note.slug'),
                    'limit' => $limit
                )),
        );
        return $contain==null?$data :$data[$contain];
    }

    public function searchConditionsProject($query)
    {
        if (AppAuth::is(UserRoles::Admin))
        {
            return array(
                'conditions' => array(
                    'OR' => array(
                        'Project.title LIKE' => '%' . $query . '%',
                        'Project.description LIKE' => '%' . $query . '%',
                    )
                ),
                'fields' => array('id', 'title', 'description', 'slug'),
                'limit' => 15
            );
        }

        $accessTo = ClassRegistry::init('ProjectsClient')->find('all', array(
            'conditions' => array('ProjectsClient.client_id' => AppAuth::user('client_id')),
            'contain' => array('Project' => array('Phase' => array('fields' => array('id', 'project_id', 'slug')), 'fields' => array('id', 'slug')))
        ));

        $projectIDs = Hash::extract($accessTo, '{n}.Project.id');

        return array(
            'conditions' => array(
                'OR' => array(
                    'Project.title LIKE' => '%' . $query . '%',
                    'Project.description LIKE' => '%' . $query . '%',
                ),
                'Project.id' => $projectIDs
            ),
            'fields' => array('id', 'title', 'description', 'slug'),
            'limit' => 15
        );
    }

    public function searchConditionsPhase($query)
    {
        if (AppAuth::is(UserRoles::Admin))
        {
            return array(
                'conditions' => array(
                    'OR' => array(
                        'Phase.title LIKE' => '%' . $query . '%',
                        'Phase.description LIKE' => '%' . $query . '%',
                    )
                ),
                'fields' => array('id', 'title', 'description', 'slug'),
                'limit' => 15
            );
        }

        $accessTo = ClassRegistry::init('ProjectsClient')->find('all', array(
            'conditions' => array('ProjectsClient.client_id' => AppAuth::user('client_id')),
            'contain' => array('Project' => array('Phase' => array('fields' => array('id', 'project_id', 'slug')), 'fields' => array('id', 'slug')))
        ));

        $phaseIDs = Hash::extract($accessTo, '{n}.Project.Phase.{n}.id');


        return array(
            'conditions' => array(
                'OR' => array(
                    'Phase.title LIKE' => '%' . $query . '%',
                    'Phase.description LIKE' => '%' . $query . '%',
                ),
                'Phase.id' => $phaseIDs
            ),
            'fields' => array('id', 'title', 'description', 'slug'),
            'limit' => 15
        );
    }

    public function searchConditionsComment($query)
    {
        if (AppAuth::is(UserRoles::Admin))
        {
            return array(
                'conditions' => array(
                    'Comment.content LIKE' => '%' . $query . '%',
                ),
                'fields' => array('id', 'content', 'needsaction'),
                'contain' => array('Phase.slug'),
                'limit' => 15
            );
        }

        $accessTo = ClassRegistry::init('ProjectsClient')->find('all', array(
            'conditions' => array('ProjectsClient.client_id' => AppAuth::user('client_id')),
            'contain' => array('Project' => array('Phase' => array('fields' => array('id', 'project_id', 'slug')), 'fields' => array('id', 'slug')))
        ));

        $phaseIDs = Hash::extract($accessTo, '{n}.Project.Phase.{n}.id');

        return array(
            'conditions' => array(
                'Comment.content LIKE' => '%' . $query . '%',
                'Comment.phase_id' => $phaseIDs
            ),
            'fields' => array('id', 'content', 'needsaction'),
            'contain' => array('Phase.slug'),
            'limit' => 15
        );
    }

}
