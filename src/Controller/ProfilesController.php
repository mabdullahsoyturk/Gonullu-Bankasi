<?php
namespace App\Controller;

use App\Controller\AppController;

class ProfilesController extends AppController
{
    public function isAuthorized($user)
    {
      $action = $this->request->action;
      if($action == "show")
      {
        return true;
      }
      else if($action == "edit")
      {
        return true;
      }

      return false;
    }

    public function show($id)
    {
      $this->loadModel("Users");
      $this->loadModel('EventApplications');
      if(true)
      {
        $user = $this->Users->get($id);
        $first_name = $user->first_name;
        $last_name = $user->last_name;
        $university = $user->university;
        $department = $user->department;
        $about = $user->about;
        $image = $user->image;
        $applications = $this->EventApplications->find('all')->contain(['Events'])->where(['EventApplications.user_id' => $id, 'status' => 1])->all();
        $this->set(compact('applications'));
        $this->set(compact('first_name'));
        $this->set(compact('last_name'));
        $this->set(compact('university'));
        $this->set(compact('department'));
        $this->set(compact('about'));
        $this->set(compact('image'));
      }
    }

    public function edit()
    {
      $user_id = $this->Auth->user('id');
      $this->loadModel("Users");
      $user = $this->Users->get($user_id);

      if($this->request->is('post'))
      {
        $user->first_name = $this->request->data['first_name'];
        $user->last_name = $this->request->data['last_name'];
        $user->university = $this->request->data['university'];
        $user->department = $this->request->data['department'];
        $user->about = $this->request->data['about'];

        if($this->Users->save($user))
        {
          $this->Flash->success(__('Your profile has been updated'));
        }
        else {
          $this->Flash->error(__('Your error could not be updated'));
        }
      }


      $first_name = $user->first_name;
      $last_name = $user->last_name;
      $university = $user->university;
      $department = $user->department;
      $about = $user->about;
      $image = $user->image;

      $this->set(compact('user_id'));
      $this->set(compact('applications'));
      $this->set(compact('first_name'));
      $this->set(compact('last_name'));
      $this->set(compact('university'));
      $this->set(compact('department'));
      $this->set(compact('about'));
      $this->set(compact('image'));
    }
}
