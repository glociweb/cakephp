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
App::uses('UploadHandler', 'Lib');
/**
 * Projects Controller
 *
 * @property Project $Project
 * @property Project $ProjectsUser
 * @property Client $Client
 */

class FileuploadController extends AppController
{

   public function index()
   {
	   $this->autoRender=false;
	   $upload_handler = new UploadHandler();
   }

}
