<?php
namespace App\Controller;

use App\Controller\AppController;

class ProfilesController extends AppController
{
    public function initialize()
    {
      parent::initialize();
      // Add logout to the allowed actions list.
      $this->Auth->allow(['show']);
    }
    
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
        $skills_and_hobbies = $user->skills_and_hobbies;
        $personal_values = $user->personal_values;
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
        $this->set(compact('id'));
        $this->set(compact('personal_values'));
        $this->set(compact('skills_and_hobbies'));
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
        $user->image = $this->request->data['image'];
        $user->skills_and_hobbies = $this->request->data['skills_and_hobbies'];
        $user->personal_values = $this->request->data['personal_values'];

        if($this->Users->save($user))
        {
          $this->Flash->success(__('Your profile has been updated'));
        }
        else {
          $this->Flash->error(__('Your error could not be updated'));
        }
      }
      
      $skills_and_hobbies = $user->skills_and_hobbies;
      $personal_values = $user->personal_values;
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
      $this->set(compact('personal_values'));
      $this->set(compact('skills_and_hobbies'));
      $this->set(compact('image'));
    }
}
