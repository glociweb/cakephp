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
 * Attachments Controller
 *
 * @property Attachment $Attachment
 */
class AttachmentsController extends AppController
{

    /**
     * Holds this controller's name
     * @var string 
     */
    public $name = 'Attachments';

    /**
     * Handles the authorisation logic
     * @param array $user The user to authorise
     * @return boolean Whether the user is authorised
     */
    public function isAuthorized($user = array())
    {
        if (AppAuth::is(UserRoles::Admin))
            return true;

        $action = $this->request->params['action'];

        switch ($action)
        {
            case 'download':
                return $this->Attachment->hasAccess($user, $this->request->params['pass'][0]);
                break;
        }

        return parent::isAuthorized($user);
    }

    public function admin_index()
    {
        $this->paginate['Comment'] = array(
            'contain' => array('User', 'Attachment', 'Phase'),
            'conditions' => array('Comment.attachment_count >' => 0)
        );
        $this->set('comments', $this->paginate('Comment'));
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
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists())
        {
            throw new NotFoundException(__('Invalid attachment'));
        }
        if ($this->Attachment->delete())
        {
            $this->Session->setFlash(__('Attachment deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Attachment was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * 
     * @param string $attachment_id The id of the folder where the attachment lies
     * @param string $file_name The file's name
     * @param string $version Indicates whether to return the thumbnail version
     * @return void
     * @throws NotFoundException
     */
    public function download($attachment_id = null, $file_name = null, $version = null)
    {
        $this->autoRender = false;

        if (!$attachment_id)
            return;

        if ($version != null && $version == 'thumb')
            $file_name = 'thumb_' . $file_name;

        if ($version != null && $version == 'custom')
        {
            $meta = getimagesize(ATTACHMENTBASE . $attachment_id . DS . $file_name);
            if (AppConfig::read('Preview.max_width') > $meta[0] || AppConfig::read('Preview.max_height') > $meta[1])
            {
                return $this->response->file(ATTACHMENTBASE . $attachment_id . DS . $file_name);
            }
            else
            {
                App::uses('File', 'Utility');
                $file = new File(ATTACHMENTBASE . $attachment_id . DS . $file_name);
                header('Content-Type: ' . $file->mime());
                header('Content-Length: ' . $file->size());
                imagejpeg($this->__resizeImage(ATTACHMENTBASE . $attachment_id . DS . $file_name, AppConfig::read('Preview.max_width'), AppConfig::read('Preview.max_height')));
            }
            exit();
        }

        if (!file_exists(ATTACHMENTBASE . $attachment_id . DS . $file_name))
            throw new NotFoundException();

        return $this->response->file(ATTACHMENTBASE . $attachment_id . DS . $file_name, array('download' => true));
    }

    private function __resizeImage($image_path, $max_width, $max_height)
    {
        list($width, $height) = getimagesize($image_path);
        $r = $width / $height;

        if ($max_width / $max_height > $r)
        {
            $newwidth = $max_height * $r;
            $newheight = $max_height;
        }
        else
        {
            $newheight = $max_width / $r;
            $newwidth = $max_width;
        }

        $ext = strtolower(end(explode('.', $image_path)));
        $src = null;

        switch ($ext)
        {
            case 'jpg':
            case 'jpeg':
                $src = @imagecreatefromjpeg($image_path);
                break;
            case 'png':
                $src = @imagecreatefrompng($image_path);
                break;
            case 'gif':
                $src = @imagecreatefromgif($image_path);
                break;
            case 'bmp':
                $src = @imagecreatefromwbmp($image_path);
        }

        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        return $dst;
    }

}