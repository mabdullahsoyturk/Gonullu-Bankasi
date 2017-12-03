<?php
namespace App\Controller;

use App\Controller\AdminController;

/**
 * ContactMessages Controller
 *
 * @property \App\Model\Table\ContactMessagesTable $ContactMessages
 *
 * @method \App\Model\Entity\ContactMessage[] paginate($object = null, array $settings = [])
 */
class AdminController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
      

    }


    public function isAuthorized($user)
    {
        if ($this->is_admin) {
            return true;
        } else {
          return false;
        }
   }
}
