<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\I18n;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 *
 * @method \App\Model\Entity\Event[] paginate($object = null, array $settings = [])
 */
class EventsController extends AppController
{
  public function initialize()
  {
    parent::initialize();
    // Add logout to the allowed actions list.
    $this->Auth->allow(['index', 'view']);
  }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
            'order' => [
            'Events.created_time' => 'desc'
        ]
        ];
        $events = $this->paginate($this->Events);

        $this->set(compact('events'));
        $this->set('_serialize', ['events']);
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicationsTable = TableRegistry::get('EventApplications');

        $event = $this->Events->get($id, [
            'contain' => ['Users']
        ]);
        $applicationCount = $applicationsTable->find()->where(['event_id'=>$id])->count();
        $approved = $applicationsTable->find()->where(['event_id'=>$id,'status'=>1])->count();
        if($this->Auth->user('id') == null)
        {
          $this->set('applied', 'must_login');
          $this->set('belongsTo', false);
        }
        else {
          $user_id = $this->Auth->user('id');
          $event_id = $id;

          $applications = $applicationsTable->find()->where(['user_id'=>$user_id,'event_id'=>$event_id])->count();

          if($applications == 0)
          {
            $this->set('applied', 'can_apply');
          }
          else {
            $this->set('applied', 'applied');
          }
          $this->set('belongsTo', $this->Events->get($id)->user_id == $this->Auth->user('id'));
        }
        $event->total = $applicationCount;
        $event->approved = $approved;


        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $users = $this->Events->Users->find('list', ['limit' => 200]);
        $this->set(compact('event', 'users'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $users = $this->Events->Users->find('list', ['limit' => 200]);
        $this->set(compact('event', 'users'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

      public function isAuthorized($user)
      {
        if (in_array($this->request->action, ['add','index','view'])) {
          return true;
        }

        if(in_array($this->request->action, ['edit','delete']))
        {
          $id = $this->request->getParam('pass.0');
          $event = $this->Events->get($id);
          if($event->user_id == $user['id'])
            return true;
        }
        return parent::isAuthorized($user);
      }

}
