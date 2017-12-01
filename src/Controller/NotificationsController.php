<?php
namespace App\Controller;

use Cake\I18n\I18n;
use App\Controller\AppController;

class NotificationsController extends AppController
{
    public function initialize()
    {
      parent::initialize();
      $this->loadComponent('Notifier');
    }

   public function index()
   {
     $user_id = $this->Auth->user('id');
     $notifications = $this->Notifier->getNotifications($user_id);
     foreach ($notifications as $notification) {
       $this->Notifier->markAsRead($notification->id);
     }
     $this->set(compact('notifications'));
   }

   public function isAuthorized($user)
   {
     if($this->request->action === 'index'){
       return true;
     }
     return false;
   }
}
