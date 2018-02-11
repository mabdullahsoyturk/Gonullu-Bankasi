<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
      parent::initialize();
      // Add logout to the allowed actions list.
      $this->Auth->allow(['logout', 'add', 'verify','password']);
    }

    public function isAuthorized($user)
    {
      if (in_array($this->request->action, ['all'])) {
        return true;
      }
        return false;
    }

    public function verify($token = '')
    {
        if($token == '')
          return;
        $user = $this->Users->find()->where(['activation_code'=>$token])->first();
        $user->active = 1;
        if($this->Users->save($user))
        {
          $this->Flash->success('Email verified!');
          return $this->redirect(['controller'=>'pages','action' => 'display','home']);
        }
        else {
          $this->Flash->error('Email not verified!');
          return $this->redirect(['controller'=>'pages','action' => 'display','home']);
        }
    }

    public function verifyForgottenCode($token = ''){
        if($token == '')
          return;
        $user = $this->Users->find()->where(['forgotten_password_code'=>$token])->first();
        if($this->Users->save($user))
        {
          return $this->redirect(['controller'=>'users','action' => 'reset', $token]);
        }
        else {
          $this->Flash->error('An error occured!');
          return $this->redirect(['controller'=>'pages','action' => 'display','home']);
        }
    }

    private function sendVerificationEmail($user)
    {
      $email = new Email('default');
                $email->emailFormat('both');
                $email->viewVars(['token' => $user->activation_code]);
                $email->template('verification');
                $email->from(['no-reply@gonullubankasi.org' => 'gonullubankasi.org'])
                ->to($user->email)
                ->subject(__('[Gonullubankasi] Email address verification.'))
                ->send();
    }

    private function sendVerificationEmailForPassword($user)
    {
      $email = new Email('default');
                $email->emailFormat('both');
                $email->viewVars(['token' => $user->forgotten_password_code]);
                $email->template('reset');
                $email->from(['no-reply@gonullubankasi.org' => 'gonullubankasi.org'])
                ->to($user->email)
                ->subject(__('[Gonullubankasi] Password change.'))
                ->send();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Groups']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    private function createToken($tokenLength)
    {
      $charset = "qwertyuopasdfghjklizxcvbnmQWERTYUOPASDFGHJKLZXCVBNM0123456789";
      $token = "";
      for ($i=0; $i < $tokenLength; $i++) {
        $charPos = rand(0, strlen($charset) - 1);
        $token .= $charset{$charPos};
      }
      return $token;
    }

    public function password(){

          $users = TableRegistry::get('Users');
          $query = $users->findByEmail($this->request->getData('email'));

          $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $query->first();
            //$user = $this->Users->patchEntity($user, $this->request->getData());
            $user->forgotten_password_code = $this->createToken(40);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Please check your mailbox to change your password'));
                $this->sendVerificationEmailForPassword($user);

                return $this->redirect(['controller'=>'pages','action' => 'display','home']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
    }

    public function reset($token = null){
      if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $user->password = $this->request->getData('password');
                if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['controller'=>'pages','action' => 'display','home']);
            }
            }
            $this->Flash->error('Your password could not be changed.');
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->activation_code = $this->createToken(40);
            $user->active = 1;
            $user->groups  = array($this->Users->Groups->get(4));
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                $this->sendVerificationEmail($user);

                return $this->redirect(['controller'=>'pages','action' => 'display','home']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Groups']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    public function all()
    {
      $users = $this->paginate($this->Users);

      $this->set(compact('users'));
      $this->set('_serialize', ['users']);

    }
}
