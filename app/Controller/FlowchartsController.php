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
App::uses('AppController', 'Controller');

/**
 * Projects Controller
 *
 * @property Project $Project
 * @property Project $ProjectsUser
 * @property Client $Client
 */

?>
<?php
class FlowchartsController extends AppController
  {
	
    public function organization()
      {
        $this->layout = 'flowcharts';
        $this->loadModel('OrgCharts');
        if (AppAuth::is(UserRoles::Admin))
        {
            $flowcharts = $this->OrgCharts->find('all');
         }
        else
          {
			$this->loadModel('Department');
			$dept_head=$this->Department->find('first',array('conditions'=>array('Department.id'=>AuthComponent::user('department')))) ; 
			$head=$dept_head['Department']['dep_head'];
            $flowcharts = $this->OrgCharts->find('all', array(
                'conditions' => array(
                    'OR' => array(
                        array('OrgCharts.user_id' => AuthComponent::user('id')),
                        array('OrgCharts.user_id'=>$head)
                    )
                )
            ));
          }
          if (empty($flowcharts))
          {
            $this->Session->setFlash(__('No chart available for you , Contact with your department head.'), Flash::Error);
          }
		  $this->set(compact('flowcharts'));
     }
     
     public function latestorganization()
      {
		$this->autoRender = false; 
        $this->layout = 'flowcharts';
        $this->loadModel('OrgCharts');
        if (AppAuth::is(UserRoles::Admin))
        {
            $flowcharts = $this->OrgCharts->find('all',array('limit'=>5,'order' => array(
                'OrgCharts.created' => 'DESC'
				)));
         }
        else
          {
			$this->loadModel('Department');
			$dept_head=$this->Department->find('first',array('conditions'=>array('Department.id'=>AuthComponent::user('department')))) ; 
			$head=$dept_head['Department']['dep_head'];
            $flowcharts = $this->OrgCharts->find('all', array(
                'conditions' => array(
                    'OR' => array(
                        array('OrgCharts.user_id' => AuthComponent::user('id')),
                        array('OrgCharts.user_id'=>$head)
                    )
                ),
				'limit' => 5,
				'order' => array(
                'OrgCharts.created' => 'DESC'
				),
            ));
          }
       
		  return $flowcharts;
     }
    public function latestcharts()
    {
		$this->autoRender = false; 
        $this->layout = 'flowcharts';
        $this->loadModel('Charts');
        if (AppAuth::is(UserRoles::Admin))
        {
            $flowcharts = $this->Charts->find('all',array('limit'=>5,'order' => array(
                'Charts.created' => 'DESC'
				)));
         }
        else
          {
			$this->loadModel('Department');
			$dept_head=$this->Department->find('first',array('conditions'=>array('Department.id'=>AuthComponent::user('department')))) ; 
			$head=$dept_head['Department']['dep_head'];
            $flowcharts = $this->Charts->find('all', array(
				'limit' => 5,
				'order' => array(
                'Charts.created' => 'DESC'
				),
                'conditions' => array(
                    'OR' => array(
                        array('Charts.user_id' => AuthComponent::user('id')),
                        array('Charts.user_id'=>$head)
                    )
                )
            ));
          }
       
		  return $flowcharts;
		
	}
    public function index()
      {
        $this->layout = 'flowcharts';
        $this->loadModel('Charts');
        if (AppAuth::is(UserRoles::Admin))
        {
            $flowcharts = $this->Charts->find('all');
         }
        else
          {
			$this->loadModel('Department');
			$dept_head=$this->Department->find('first',array('conditions'=>array('Department.id'=>AuthComponent::user('department')))) ; 
			$head=$dept_head['Department']['dep_head'];
            $flowcharts = $this->Charts->find('all', array(
                'conditions' => array(
                    'OR' => array(
                        array('Charts.user_id' => AuthComponent::user('id')),
                        array('Charts.user_id'=>$head)
                    )
                )
            ));
          }
        
        if (empty($flowcharts))
          {
            $this->Session->setFlash(__('No chart available for you , Contact with your department head.'), Flash::Error);
          }
        $this->set(compact('flowcharts'));
        
      }
    
    public function getflowchart()
      {
        $this->autoRender = false;
        if (isset($_POST['chartcode']))
          {
            $chartcode = $_POST['chartcode'];
            $this->loadModel('Charts');
            $this->Charts->id = $chartcode;
            if (!$this->Charts->exists())
              {
                echo json_encode(array(
                    'status' => 'error',
                    'msg' => 'chart not exists'
                ));
              }
            else
              {
                $projects = $this->Charts->find('first', array(
                    'conditions' => array(
                        'Charts.id' => $chartcode
                    )
                ));
                echo json_encode(array(
                    'status' => 'success',
                    'json' => $projects['Charts']['chart_json'],
                    'code' => $projects['Charts']['id'],
                    'name' => $projects['Charts']['chart_name'],
                    'wiki' => $projects['Charts']['chart_wiki']
                ));
                
              }
          }
      }
    public function getorgflowchart()
      {
        $this->autoRender = false;
        if (isset($_POST['chartcode']))
          {
            $chartcode = $_POST['chartcode'];
            $this->loadModel('OrgCharts');
            $this->OrgCharts->id = $chartcode;
            if (!$this->OrgCharts->exists())
              {
                echo json_encode(array(
                    'status' => 'error',
                    'msg' => 'chart not exists'
                ));
              }
            else
              {
                $projects = $this->OrgCharts->find('first', array(
                    'conditions' => array(
                        'OrgCharts.id' => $chartcode
                    )
                ));
                echo json_encode(array(
                    'status' => 'success',
                    'json' => $projects['OrgCharts']['chart_json'],
                    'code' => $projects['OrgCharts']['id'],
                    'name' => $projects['OrgCharts']['chart_name'],
                    'wiki' => $projects['OrgCharts']['chart_wiki']
                ));
                
              }
          }
      }
    
    public function orgflowchart($id = null)
      {
        $this->layout = 'flowcharts';
        $this->loadModel('OrgCharts');
        $this->OrgCharts->id = $id;
        if (!$this->OrgCharts->exists())
          {
            throw new NotFoundException(__('This chart is not exist!'));
          }
        
        $chart = $this->OrgCharts->find('first', array(
            'conditions' => array(
                'OrgCharts.id' => $id
            )
        ));
        $this->set(compact('chart'));
      }
    
    public function flowchart($id = null)
      {
        $this->layout = 'flowcharts';
        $this->loadModel('Charts');
        $this->Charts->id = $id;
        if (!$this->Charts->exists())
          {
            throw new NotFoundException(__('This chart is not exist!'));
          }
        
        $chart = $this->Charts->find('first', array(
            'conditions' => array(
                'Charts.id' => $id
            )
        ));
        $this->set(compact('chart'));
      }
    
    
    
    
  }
