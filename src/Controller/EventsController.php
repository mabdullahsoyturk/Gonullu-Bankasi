<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\I18n;
use Cake\Routing\Router;
use App\Utility\NotificationManager;
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
    $this->loadComponent('Notifier');
    $notificationManager = NotificationManager::instance();
    $notificationManager->addTemplate('event_changed', [
    'title' => __("':event_title' has edited"),
    'body' => __('There has been changes in the event, please re-confirm your application. :event_id')
  ]);

  }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $query = $this->Events->find()->where(['approved'=>1, 'deleted'=>0]);
        $this->paginate = [
            'contain' => ['Users'],
            'order' => ['Events.created_time' => 'desc']
        ];
        $events = $this->paginate($query);
        $this->set(compact('events'));
        $this->set('_serialize', ['events']);
    }

    public function indexAdmin() {
      $query = $this->Events->find()->where(['approved'=>0]);
      $this->paginate = [
          'contain' => ['Users'],
          'order' => ['Events.created_time' => 'desc']
      ];
      $events = $this->paginate($query);
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
        if(! $event || $event->deleted == 1){
          $this->redirect(['action'=>'index']);
        }
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

          $applications = $applicationsTable->find()->where(['user_id'=>$user_id,'event_id'=>$event_id]);

          if($applications->count() == 0)
          {
            $this->set('applied', 'can_apply');
          }
          else if($applications->first()->status != "3"){
            $this->set('applied', 'applied');
          }else{
            $this->set('applied', 'validate');
          }
          $this->set('belongsTo', $this->Events->get($id)->user_id == $this->Auth->user('id'));
        }
        $event->total = $applicationCount;
        $event->approved_applications = $approved;
        $this->loadModel('Users');
        $user = $this->Users->get($user_id, ['contain'=>['Groups']]);
        $is_admin = $user['groups'][0]->name == 'Admin';

        $this->set('event', $event);
        $this->set('is_admin', $is_admin);
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
                $this->Flash->success(__('The event has been saved.'));;
                $this->loadModel('users');

                $this->Notifier->notify(
                  // sorry for ugliness :/
                  ['users' => array_map(function($a){ return $a->id; },
                        $this->Events->Users->find('all', ['fields'=>'id'])->all()->toArray()),
                  'template' => 'new_event',
                  'vars'=>
                ['user' => $event->user_id,
                      'event_summary' => strlen($event->description) > 100 ? h(substr($event->description, 0, 100)) . "..." : h($event->description),
                      'event_id' => $event->id,
                      'event_title' => h($event->title),
                      'event_link' => Router::url(['controller'=>'events', 'action' => 'view', $event->id])
                      ]]);

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
        $eventApplications = TableRegistry::get('event_applications');
        $applicationNumber = $eventApplications->find()->where(['event_id'=>$id, 'status !=' => 2])->count() > 0;
        $event = $this->Events->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                if($applicationNumber){
                  $this->loadModel('users');
                  //Cancel the applications
                  //Send notifications to users to approve or disapprove their applications
                  $applications = $eventApplications->find()->where(['event_id'=>$id, 'status !=' => 2]);
                  foreach ($applications as $application) {
                    $application->status = 3;
                    $eventApplications->save($application);
                    $this->Notifier->notify(
                      ['users' => [$application->user_id],
                      'template' => 'event_changed',
                      'vars'=>
                    ['user' => $event->user_id,
                          'event_id' => $event->id,
                          'event_title' => $event->title,
                          'event_link' => Router::url(['controller'=>'events', 'action' => 'view', $event->id])
                          ]]);
                  }
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $this->set(compact('event', 'applicationNumber'));
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
        $event = $this->Events->get($id);
        $event->deleted = 1;
        if ($this->Events->save($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    /**
     * Approve method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function approve($id = null)
    {
        $this->request->allowMethod(['get']);
        $event = $this->Events->get($id);
        $event->approved = 1;

        if ($this->Events->save($event)) {
            $this->Flash->success(__('The event has been approved.'));
        } else {
            $this->Flash->error(__('The event could not be approved. Please, try again.'));
        }


        return $this->redirect(['action' => 'index']);
    }
      public function isAuthorized($user)
      {
        $this->loadModel('Users');
        $user = $this->Users->get($user['id'], ['contain'=>['Groups']]);
        $is_admin = $user['groups'][0]->name == 'Admin';

        if (in_array($this->request->action, ['add','index','view'])) {
          return true;
        }

        if(in_array($this->request->action, ['edit','delete']))
        {
          $id = $this->request->getParam('pass.0');
          $event = $this->Events->get($id);
          if($event->user_id == $user['id'] || $is_admin)
            return true;
        }
        if(in_array($this->request->action, ['indexAdmin', 'approve'])){
            if($is_admin)
                return true;
            else
                return false;
        }
        return parent::isAuthorized($user);
      }

}
