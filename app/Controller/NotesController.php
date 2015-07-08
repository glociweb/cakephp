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
class NotesController extends AppController
{
	
	
	 /**
     * Holds this controller's name
     * @var string 
     */
    //public $name = 'Notes';
	public $paginate = array(
        'limit' => 25
    );
    public function index()
    {
		$this->redirect( '/notes/meetingnotes' );
	}
	/**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
		$this->redirect( '/notes/meetingnotes' );
	}
    public function meetingnotes()
    {
        $this->layout = 'system_front';
        $this->loadModel('Notes');
		$notes=$this->Notes->find('all');
        $this->set('title_for_layout', 'Meeting notes');
        $this->set('notes', $notes,$this->paginate());
    }
	
	public function addmeetingnote()
	{
		$this->layout = 'system_front';
		$view = new View($this, false);
		$html = $view->element('meetingnotes/meeting-note'); // get the rendered markup
		$title=date('Y-m-d').'Meeting Notes';
		$html=str_replace('{title}',$title,$html);
		$date=date('d M Y');
		$html=str_replace('{date}',$date,$html);
		$this->set('title_for_layout', 'Add Meeting note');
        $this->set('template',$html);
	}
	public function admin_addmeetingnote($project_id = null)
	{
		
		$this->loadModel('Project');
		 if (!$this->Project->exists($project_id))
        {
            throw new NotFoundException(__('No project was passed'));
        }
        $project = $this->Project->find('first', array(
            'conditions' => array('Project.id' => $project_id)
        ));
        $this->request->data['Notes']['version']='1.0';
        if ($this->request->is('post'))
        {
			
			$this->loadModel('Notes');
			if(is_array($this->request->data['Projects']['Projects']))
			{
				foreach($this->request->data['Projects']['Projects'] as $key=>$project_id)
				{
					$this->Notes->create();
					$this->request->data['Notes']['project_id'] = $project_id;
					$this->request->data['Notes']['note_code']=$this->request->data['Projects']['note_code'];
					if ($this->Notes->save($this->request->data))
					{
						$this->Session->setFlash(__('The Note has been saved'), Flash::Success);
						
					} else
					{
						$this->Session->setFlash(__('The phase could not be saved. Please, try again.'));
					}
				
				}
			}else
			{
				$this->Notes->create();
					$this->request->data['Notes']['note_code']=$this->request->data['Projects']['note_code'];
					$this->request->data['Notes']['project_id'] = $project_id;
					if ($this->Notes->save($this->request->data))
					{
						$this->Session->setFlash(__('The Note has been saved'), Flash::Success);
						
					} else
					{
						$this->Session->setFlash(__('The phase could not be saved. Please, try again.'));
					}
			}
			if (isset($this->request->data['add_new']))
						$this->redirect(array('controller' => 'notes', 'action' => 'addmeetingnote', $project_id));

					$this->redirect(array('controller' => 'projects', 'action' => 'view', $project_id));
        }
		$view = new View($this, false);
		$html = $view->element('meetingnotes/meeting-note'); // get the rendered markup
		$title=date('Y-m-d').'Meeting Notes';
		$html=str_replace('{title}',$title,$html);
		$date=date('d M Y');
		$html=str_replace('{date}',$date,$html);
		$this->set('title_for_layout', 'Add Meeting note');
		$this->loadModel('Project');
		$projects= $this->Project->find('list');
        $this->set('template',$html);
        $this->set('project',$project);
        $this->set(compact('projects'));
	}
	public function addactionitems()
	{
		$this->autoRender = false;
		if(isset($_POST['user']))
		{
			$this->loadModel('Actionitems');
			
			$data = array('project_id' => $_POST['project_id'], 'action_type' => 'action','username'=>$_POST['user'],'action_content'=>$_POST['action_items'],'note_code'=>$_POST['note_code']);
			if ($this->Actionitems->save($data)) 
			{
				echo "data saved";
			}else
			{
				echo "some error";
			}
		}
		
	}
	public function addmentionitems()
	{
		$this->autoRender = false;
		if(isset($_POST['user']))
		{
			$this->loadModel('Actionitems');
			$content=$_POST['action_items']." at ".date('d-m-y h:i:s');
			$data = array('project_id' => $_POST['project_id'], 'action_type' => 'mention','username'=>$_POST['user'],'action_content'=>$content,'note_code'=>$_POST['note_code']);
			if ($this->Actionitems->save($data)) 
			{
				echo "data saved";
			}else
			{
				print_r($this->Actionitems->validationErrors);
				var_dump($this->Actionitems->invalidFields());
			}
		}
		
	}
	public function savenotes()
	{
		if(isset($_POST['content']))
		{
			$this->loadModel('Notes');
			
			$data = array('description' => $_POST['content'], 'title' => $_POST['name'],'slug'=>str_replace(' ','-',$_POST['name']));
			if ($this->Notes->save($data)) 
			{
				echo "data saved";
			}else
			{
				echo "some error";
			}
		}
	}
	public function getusers()
	{
		$this->loadModel('User');
		$query=$_POST['searchword'];
		$query=str_replace("@","",$query);
		$query=str_replace(" ","%",$query);
		$all=$this->User->find('all', array(
                    'conditions' => array(
                        'User.username LIKE' => '%' . $query . '%',
                    )));
		$users=array();
		foreach($all as $key=>$user)
		{ 

			if($user['User']['avatarpath']) $imgurl=$this->webroot."users/avatar/".$user['User']['id'].'/'.$user['User']['avatarpath'];
			else $imgurl=$this->webroot."/img/defaults/default_avatar.jpg";
			?>
			<div class="display_box" >
			<img src="<?php echo $imgurl; ?>" class="image" />	
			<a   class='addname' title='<?php echo $user['User']['username']; ?>'>
			<?php echo $user['User']['fname']; ?>&nbsp;<?php echo $user['User']['lname']; ?></a><br>
			<span style="display: inherit;font-size:12px; color:#999999"><?php echo '@'.$user['User']['username']; ?></span>
			</div>
		<?php 
		}
		//$users=array(array("name"=>"manoj dhiman"),array("name"=>"checking"));
		//echo json_encode($users);
	}
	public function getusersdept()
	{
		$this->autoRender = false;
		$this->loadModel('User');
		$query=$_POST['searchword'];
		$query=str_replace("@","",$query);
		$query=str_replace(" ","%",$query);
		$all=$this->User->find('all', array(
                    'conditions' => array(
                        'User.username LIKE' => '%' . $query . '%',
                    )));
		$users=array();
		foreach($all as $key=>$user)
		{ 

			if($user['User']['avatarpath']) $imgurl=$this->webroot."users/avatar/".$user['User']['id'].'/'.$user['User']['avatarpath'];
			else $imgurl=$this->webroot."/img/defaults/default_avatar.jpg";
			?>
			<div class="display_box" >
			<img src="<?php echo $imgurl; ?>" class="image" />	
			<a   class='addname2' title='<?php echo $user['User']['username']; ?>'>
			<?php echo $user['User']['fname']; ?>&nbsp;<?php echo $user['User']['lname']; ?></a><br>
			<span style="display: inherit;font-size:12px; color:#999999"><?php echo '@'.$user['User']['username']; ?></span>
			</div>
		<?php 
		}
		//$users=array(array("name"=>"manoj dhiman"),array("name"=>"checking"));
		//echo json_encode($users);
	}
	public function getuserfromdepartment()
	{
		$this->autoRender = false;
		if(isset($_POST['dept']))
		{
			$query=$_POST['dept'];
			$this->loadModel('User');
			$all=$this->User->find('all', array(
                    'conditions' => array(
                        'User.department LIKE' => '%' . $query . '%',
                    )));
            foreach($all as $key=>$user)
			{
				echo "&nbsp<a class='red mentions' contenteditable='false' href='#' >" .$user['User']['username']. "</a>&nbsp; ";
			}       
		}
	}
	public function getdept()
	{
		$this->autoRender = false;
		$this->loadModel('Department');
		$query=$_POST['searchword'];
		$query=str_replace("#","",$query);
		$query=str_replace(" ","%",$query);
		$all=$this->Department->find('all', array(
                    'conditions' => array(
                        'Department.dep_name LIKE' => '%' . $query . '%',
                    ),
                    'contain' => array(
					'User'
			)));
         
		foreach($all as $key=>$user)
		{ 
			?>
			<div class="display_box" >	
			<a   class='adddept2' alt='<?php echo $user['Department']['id']; ?>' title='<?php echo $user['Department']['dep_name']; ?>'>
			<?php echo $user['Department']['dep_name']; ?></a><br>
			<span style="display: inherit;font-size:12px; color:#999999"><?php echo '@'.$user['User']['username']; ?></span>
			</div>
		<?php 
		}
		//$users=array(array("name"=>"manoj dhiman"),array("name"=>"checking"));
		//echo json_encode($users);
	}
	public function view($id = null)
    {
		
		$this->loadModel('Notes');
        $this->Notes->id = $id;
        if (!$this->Notes->exists())
        {
            throw new NotFoundException(__('Invalid Notes'));
        }
       
         $notefull=$this->Notes->getNotes($id);
         //echo "<pre>";print_r($notefull); die;
         $slug=$notefull['Notes']['project_id'];
         $this->loadModel('Project');
         $project = $this->Project->find('first', array(
            'conditions' => array('Project.id' => $slug)
        ));
       
        $this->set('meetingnotes', $notefull);
        $this->set('project', $project);
    }
    
    public function admin_view($id = null)
    {
		
		$this->loadModel('Notes');
        $this->Notes->id = $id;
        if (!$this->Notes->exists())
        {
            throw new NotFoundException(__('Invalid Notes'));
        }
       
         $notefull=$this->Notes->getNotes($id);
         //echo "<pre>";print_r($notefull); die;
         
        $this->set('meetingnotes', $notefull);
    }
    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
		$this->layout = 'system_front';
		$this->loadModel('Notes');
        $this->Notes->id = $id;
        if (!$this->Notes->exists())
        {
            throw new NotFoundException(__('Invalid Notes'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
			$data = array('description' => $_POST['note-text']);
            if ($this->Notes->save($data))
            {
                $this->Session->setFlash(__('The Notes has been saved'), Flash::Success);
                $this->redirect(array('action' => 'view', $id));
            }
            else
            {
                $this->Session->setFlash(__('The Notes could not be saved. Please, try again.'));
            }
        }
        $this->set('meetingnotes', $this->Notes->findById($id));
        
    }
    public function markdone()
    {
		$this->autoRender = false;
		$this->loadModel('Notes');
		$this->Notes->id = $_POST['id'];
		
		 if (!$this->Notes->exists())
        {
            throw new NotFoundException(__('Invalid Notes'));
        }
		$data = array('description' => $_POST['content']);
		if ($this->Notes->save($data))
		{
			echo 'save';
		}
		else
		{
			echo 'error';
		}
		
		
	}
	public function markcomplete()
    {
		$this->autoRender = false;
		$this->loadModel('Actionitems');
		$this->Actionitems->id = $_POST['id'];
		
		if (!$this->Actionitems->exists())
        {
            throw new NotFoundException(__('Invalid Actionitems'));
        }
		$data = array('completed' => $_POST['action']);
		if ($this->Actionitems->save($data))
		{
			echo 'save';
		}
		else
		{
			echo 'error';
		}
		
		
	}
	
	
    public function admin_edit($id = null)
    {
		$this->layout = 'system_front';
		$this->loadModel('Notes');
        $this->Notes->id = $id;
        if (!$this->Notes->exists())
        {
            throw new NotFoundException(__('Invalid Notes'));
        }
        $note=$this->Note->find('first');
        $note = $this->Note->find('first', array(
            'conditions' => array('Note.id' => $id)
        ));
        $version= $note['Note']['version'];
        $newversion=$version+0.1;
        if ($this->request->is('post') || $this->request->is('put'))
        {
			$data=$this->request->data;
			$project_id=$data['Notes']['project_id'];
			$this->request->data['Notes']['version']=$newversion;
			$historydata=array('note_id'=>$note['Note']['id'],'project_id'=>$note['Note']['project_id'],'version'=>$note['Note']['version'],'title'=>$note['Note']['title'],'slug'=>$note['Note']['slug'],'description'=>$note['Note']['description']);
			$this->loadModel('Noteshistory');
			$this->Noteshistory->create($historydata);
			$this->Noteshistory->save();
            if ($this->Notes->save($this->request->data))
            {
                $this->Session->setFlash(__('The Notes has been saved'), Flash::Success);
                if (isset($this->request->data['add_new']))
                    $this->redirect(array('controller' => 'notes', 'action' => 'addmeetingnote', $project_id));
                $this->redirect(array('action' => 'view', $id));
            }
            else
            {
                $this->Session->setFlash(__('The Notes could not be saved. Please, try again.'));
            }
        
        }
        $this->set('meetingnotes', $this->Notes->findById($id));
        
    }
    /**
     * admin_delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
     public function admin_delete($id = null)
    {
		$this->loadModel('Notes');
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->Notes->id = $id;
        if (!$this->Notes->exists())
        {
            throw new NotFoundException(__('Invalid Notes'));
        }
        if ($this->Notes->delete())
        {
            $this->Session->setFlash(__('Meeting Note deleted'));
            $this->redirect(array('controller'=>'projects','action' => 'index'));
        }
        $this->Session->setFlash(__('Notes was not deleted'));
        $this->redirect($this->referer());
    }
    public function delete($id = null)
    {
		$this->loadModel('Notes');
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->Notes->id = $id;
        if (!$this->Notes->exists())
        {
            throw new NotFoundException(__('Invalid Notes'));
        }
        if ($this->Notes->delete())
        {
            $this->Session->setFlash(__('Meeting Note deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Notes was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    
    public function admin_history($id=null)
    {
		$this->loadModel('Noteshistory');
        if (!$this->Noteshistory->hasAny(['note_id'=>$id]))
        {
			$this->Session->setFlash(__('No history found for this note'));
			$this->redirect(array('controller'=>'notes','action' => 'view',$id));
            //throw new NotFoundException(__("Invalid Note , can't find the history"));
        }
        $Noteshistory = $this->Noteshistory->find('all', array(
            'conditions' => array('Noteshistory.note_id' => $id)));
          $this->set(compact('Noteshistory'));  
	}
	public function history($id=null)
    {
		$this->loadModel('Noteshistory');
        if (!$this->Noteshistory->hasAny(['note_id'=>$id]))
        {
			$this->Session->setFlash(__('No history found for this note'));
			$this->redirect(array('controller'=>'notes','action' => 'view',$id));
            //throw new NotFoundException(__("Invalid Note , can't find the history"));
        }
        $Noteshistory = $this->Noteshistory->find('all', array(
            'conditions' => array('Noteshistory.note_id' => $id)));
          $this->set(compact('Noteshistory')); 
	}
	public function admin_viewhistory($id=null,$version=null)
	{
		$this->loadModel('Noteshistory');
		$this->Noteshistory->id=$id;
        if (!$this->Noteshistory->exists())
        {
			//$this->Session->setFlash(__('No history found for this note'));
			//$this->redirect(array('controller'=>'notes','action' => 'view',$id));
            throw new NotFoundException(__("Invalid Note , can't find the history"));
        }
        $Noteshistory = $this->Noteshistory->find('first', array(
            'conditions' => array(
							'AND'=>array(
								'Noteshistory.id' => $id,
								'Noteshistory.version' => $version
							)
            )));
          $this->set(compact('Noteshistory')); 
	}
	public function viewhistory($id=null,$version=null)
	{
		$this->loadModel('Noteshistory');
		$this->Noteshistory->id=$id;
        if (!$this->Noteshistory->exists())
        {
			//$this->Session->setFlash(__('No history found for this note'));
			//$this->redirect(array('controller'=>'notes','action' => 'view',$id));
            //throw new NotFoundException(__("Invalid Note , can't find the history"));
        }
        $Noteshistory = $this->Noteshistory->find('first', array(
            'conditions' => array(
							'AND'=>array(
								'Noteshistory.id' => $id,
								'Noteshistory.version' => $version
							)
            )));
          $this->set(compact('Noteshistory')); 
	}
}
