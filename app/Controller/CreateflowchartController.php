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
class CreateflowchartController extends AppController
{
	/* public $layout;
	public function __construct($args){
		parent::__construct($args);
	}
	*/
	public function index()
	{
		$this->admin_index();
	}
	public function admin_index()
	{
		$this->layout = 'createflowchart';
		$this->loadModel('Charts');
		if (AppAuth::is(UserRoles::Admin)){ 
			$charts=$this->Charts->find('all');
		}else
		{
			$charts=$this->Charts->find('all',array('conditions'=>array('Charts.user_id'=>AuthComponent::user('id'))));
		}
		
		if(empty($charts))
		{
			$this->Session->setFlash(__('No chart created by you! create a new chart'), Flash::Error);
		}
		$this->set('charts',$charts);
	}
	public function organization()
	{
		$this->admin_Organization();
	}
	
	public function admin_Organization()
	{
		$this->layout = 'createflowchart';
		$this->loadModel('OrgCharts');
		if (AppAuth::is(UserRoles::Admin)){ 
			$flowcharts=$this->OrgCharts->find('all');
		}else
		{
			$flowcharts=$this->OrgCharts->find('all',array('conditions'=>array('OrgCharts.user_id'=>AuthComponent::user('id'))));
		}
		
		if(empty($flowcharts))
		{
			$this->Session->setFlash(__('No chart created by you! create a new chart'), Flash::Error);
		}
		$this->set('flowcharts',$flowcharts);
		
		
	}
	
	public function saveorgflowchart()
	{
		$this->autoRender = false;
		$chartcode=$_POST['chartcode'];
		$flowchartname=$_POST['flowchartname'];
		$this->loadModel('OrgCharts');
		if(empty($chartcode))
		{
			
			$this->request->data['OrgCharts']['chart_code']=md5(time());
			//$model->chart_create_by=$this->currentuser()->id;
			$this->OrgCharts->create();
		}else
		{
		$this->request->data['OrgCharts']['id']=$chartcode;
		//$model->chart_update_dt
		//$model->chart_update_by=1;
		
		}
		$this->request->data['OrgCharts']['chart_name']=$flowchartname;
		$this->request->data['OrgCharts']['chart_wiki']=$_POST['wiki'];
		$this->request->data['OrgCharts']['chart_json']=$_POST['content'];
		if($this->OrgCharts->save($this->request->data))
		{
			
			echo json_encode(array(
                              'status'=>'success','code'=>$this->OrgCharts->id,'name'=>$flowchartname
                         ));
			
		}else
		{
			echo "some error";
			
		}
		
	}
	
	public function saveflowchart()
	{
		$this->autoRender = false;
		$chartcode=$_POST['chartcode'];
		$flowchartname=$_POST['flowchartname'];
		$this->loadModel('Charts');
		if(empty($chartcode))
		{
			$this->request->data['Charts']['chart_code']=md5(time());
			//$model->chart_create_by=$this->currentuser()->id;
			$this->Charts->create();
		}else
		{
			$this->request->data['Charts']['id']=$chartcode;
		
		}
		$this->request->data['Charts']['chart_name']=$flowchartname;
		$this->request->data['Charts']['chart_wiki']=$_POST['wiki'];
		$this->request->data['Charts']['chart_json']=$_POST['content'];
		if($this->Charts->save($this->request->data))
		{
			echo json_encode(array(
                              'status'=>'success','code'=>$this->Charts->id,'name'=>$flowchartname
                         ));
         				
			
		}else
		{
			echo "some error";
		}
		
	}

	public function showorgflowchart()
	{
		$this->autoRender = false;
		if(isset($_POST['chartcode']))
		{
			$chartcode=$_POST['chartcode'];
			$this->loadModel('OrgCharts');
			$this->OrgCharts->id = $chartcode;
			if (!$this->OrgCharts->exists())
			{
				echo json_encode(array('status'=>'error','msg'=>'chart not exists'));
			}else
			{
				$projects=$this->OrgCharts->find('first',array(
						'conditions'=>array('OrgCharts.id'=>$chartcode)
					));
				echo json_encode(array(
								  'status'=>'success','json'=>$projects['OrgCharts']['chart_json'],'code'=>$projects['OrgCharts']['id'],'name'=>$projects['OrgCharts']['chart_name'],'wiki'=>$projects['OrgCharts']['chart_wiki']
							 ));
							
			}
		}
	}

	public function showflowchart()
	{
		$this->autoRender = false;
		if(isset($_POST['chartcode']))
		{
			$chartcode=$_POST['chartcode'];
			$this->loadModel('Charts');
			$this->Charts->id = $chartcode;
			if (!$this->Charts->exists())
			{
				echo json_encode(array('status'=>'error','msg'=>'chart not exists'));
			}else
			{
				$projects=$this->Charts->find('first',array(
						'conditions'=>array('Charts.id'=>$chartcode)
					));
				echo json_encode(array(
								  'status'=>'success','json'=>$projects['Charts']['chart_json'],'code'=>$projects['Charts']['id'],'name'=>$projects['Charts']['chart_name'],'wiki'=>$projects['Charts']['chart_wiki']
							 ));
							
			}
		}
	}

	public function deleteorgflowchart()
	{
		$this->autoRender = false;
		$chartcode=$_POST['chartcode'];
		if(!empty($chartcode))
		{
			$this->loadModel('OrgCharts');
			$this->OrgCharts->id = $chartcode;
			if (!$this->OrgCharts->exists())
			{
				echo json_encode(array('status'=>'error','msg'=>'chart not exists'));
			}else if($this->OrgCharts->delete())
			{
				echo json_encode(array(
                              'status'=>'success'));
			}else
			{
				echo json_encode(array('status'=>'error','msg'=>'unable to delete!'));
         			
			}
			
		}
	}

	public function deleteflowchart()
	{
		$this->autoRender = false;
		$chartcode=$_POST['chartcode'];
		if(!empty($chartcode))
		{
			$this->loadModel('Charts');
			$this->Charts->id = $chartcode;
			if (!$this->Charts->exists())
			{
				echo json_encode(array('status'=>'error','msg'=>'chart not exists'));
			}else if($this->Charts->delete())
			{
				echo json_encode(array(
                              'status'=>'success'));
			}else
			{
				echo json_encode(array('status'=>'error','msg'=>'unable to delete!'));
         			
			}
			
		}
	}
	public function shareorgchart()
	{
		$this->autoRender=false;
		if(isset($_POST['emails']))
		{
			$emails=explode(';',$_POST['emails']);
			$chartcode=$_POST['chartcode'];
			$sharedurl=Router::url(array('controller'=>'flowcharts', 'action'=>'orgflowchart',$chartcode),true);
			$success=array();
			$error=array();
			$message = "
					<p>please click the button to view flowchart</p>
					<a style='padding:5px;background:#428bca;color:#fff' href='".$sharedurl."' target='_blank'>View Flowchart</a>
					<p>or copy the link and open in browser</p>
					<p>".$sharedurl."</p>
					";
				$from=AuthComponent::user('email');
				$subject='Shared Flowchart';
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: <'.$from.'>' . "\r\n";
				//$headers .= 'Cc: myboss@example.com' . "\r\n";
			foreach($emails as $key=>$email)
			{	
				
				if(mail($email,$subject,$message,$headers))
				{
					$success[]=$email;         				
				}else 
				{
					$error[]=$email;
         				
				}
				
			}
			if(count($success)==count($emails))
			{	
				echo json_encode(array(
                              'status'=>'success'));
			}else
			{
				echo json_encode(array('status'=>'error','emails'=>implode(';',$error)));
			}
			
		}
	}
	
	public function shareflowchart()
	{
		$this->autoRender=false;
		if(isset($_POST['emails']))
		{
			$emails=explode(';',$_POST['emails']);
			$chartcode=$_POST['chartcode'];
			$sharedurl=Router::url(array('controller'=>'flowcharts', 'action'=>'flowchart',$chartcode),true);
			$success=array();
			$error=array();
			$message = "
					<p>please click the button to view flowchart</p>
					<a style='padding:5px;background:#428bca;color:#fff' href='".$sharedurl."' target='_blank'>View Flowchart</a>
					<p>or copy the link and open in browser</p>
					<p>".$sharedurl."</p>
					";
				$subject='Shared Flowchart';
				$from=AuthComponent::user('email');
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: <'.$from.'>' . "\r\n";
			foreach($emails as $key=>$email)
			{	
				//$headers .= 'Cc: myboss@example.com' . "\r\n";
				if(mail($email,$subject,$message,$headers))
				{
					$success[]=$email;         				
				}else 
				{
					$error[]=$email;
         				
				}
				
			}
			if(count($success)==count($emails))
			{	
				echo json_encode(array(
                              'status'=>'success'));
			}else
			{
				echo json_encode(array('status'=>'error','emails'=>implode(';',$error)));
			}
			
		}
	} 
	
	
}
