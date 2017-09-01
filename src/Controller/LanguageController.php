<?php
namespace App\Controller;

use Cake\I18n\I18n;
use App\Controller\AppController;

class LanguageController extends AppController
{
    public function initialize()
    {
      parent::initialize();
      // Add logout to the allowed actions list.
      $this->Auth->allow(['switchTo']);
    }

   public function switchTo($lang = null)
   {
     $session = $this->request->session();
     $session->write('Config.language', $lang."");
     return  $this->redirect($this->referer());
   }

   public function isAuthorized($user)
   {
     return true;
   }
}
