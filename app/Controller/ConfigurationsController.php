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
 * Configurations Controller
 *
 * @property Configuration $Configuration
 */
class ConfigurationsController extends AppController
{

    /**
     * Holds this controller's name
     * @var string 
     */
    public $name = 'Configurations';

    /**
     * admin_index editing method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_index()
    {
        $sel = !empty($this->request->params['named']['section']) ? $this->request->params['named']['section'] : '';

        if ($sel == 'email')
            $this->view = 'admin_email';

        if (isset($this->request->data['btn_test-email']))
        {
            if (isset($this->request->data['test-email']) && trim($this->request->data['test-email']) != '')
                $this->__sendTestEmail();
            else
                $this->Session->setFlash(__('Please provide an email address to send the test-email to.'));
            return;
        }

        $id = $this->Configuration->find('first');
        $id = $id['Configuration']['id'];
        $this->Configuration->id = $id;
        if (!$this->Configuration->exists())
        {
            throw new NotFoundException(__('Invalid configuration'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Configuration->save($this->request->data))
            {
                Cache::clear(false, '_cake_model_');
                Cache::clear(false, '_cake_core_');
                Cache::clear();

                $this->Session->setFlash(__('The configuration has been saved'), Flash::Success);
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The configuration could not be saved. Please, try again.'));
            }
        } else
        {
            $this->request->data = $this->Configuration->read(null, $id);
        }
    }

    private function __sendTestEmail()
    {
        try
        {
            App::uses('CakeEmail', 'Network/Email');

            $recipient = $this->request->data('test-email');
            $cEmail = new CakeEmail(array(
                        'host' => $this->request->data('Configuration.Email-host'),
                        'port' => $this->request->data('Configuration.Email-port'),
                        'username' => $this->request->data('Configuration.Email-username'),
                        'password' => $this->request->data('Configuration.Email-password'),
                        'transport' => 'Smtp',
                    ));
            $cEmail->subject(__('ClientEngage Email Delivery Test'))
                    ->from($this->request->data('Configuration.Email-email'), $this->request->data('Configuration.Email-sender'))
                    ->to($recipient)
                    ->subject(__('ClientEngage Email Delivery Test'))
                    ->from($this->request->data('Configuration.Email-email'), $this->request->data('Configuration.Email-sender'))
                    ->send();
        } catch (SocketException $ex)
        {
            $this->Session->setFlash(__('The SMTP connection could not be established. Please check your details or select the mail() function and click "Save Configuration".'), Flash::Error);
            return;
        }

        $this->Session->setFlash(__('The test message was sent via SMTP. Please check if you received the message. <strong> If you do not receive the test email, it is important that you review the SMTP details or use the mail() function instead and then click "Save Configuration".</strong>'));

        return;
    }

    /**
     * Renders the system's custom stylesheet
     */
    public function customstyles()
    {
        $this->layout = 'plain';
        $this->response->type('css');
    }

    /**
     * Returns the system's logo
     * @param string $imgName The image's filename
     */
    public function logo($imgName = null)
    {
        $this->viewClass = 'Media';

        $params = array(
            'id' => AppConfig::read('System.logo_name'),
            'path' => CONFIGURATIONBASE . AppConfig::read('System.logo_dir') . DS
        );
        $this->set($params);
    }

}
