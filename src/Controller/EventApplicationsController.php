<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
/**
 * EventApplications Controller
 *
 * @property \App\Model\Table\EventApplicationsTable $EventApplications
 *
 * @method \App\Model\Entity\EventApplication[] paginate($object = null, array $settings = [])
 */
class EventApplicationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($eventId)
    {
        $eventApplications = $this->EventApplications->find('all', array('conditions' => array('event_id' => $eventId)));

        $this->paginate = [
            'contain' => ['Users', 'Events']
        ];
        $eventApplications = $this->paginate($eventApplications);

        $this->set(compact('eventApplications'));
        $this->set('_serialize', ['eventApplications']);
    }

    /**
     * View method
     *
     * @param string|null $id Event Application id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventApplication = $this->EventApplications->get($id, [
            'contain' => ['Users', 'Events']
        ]);
        if($eventApplication->event->user_id == $this->Auth->user('id'))
        {
          $eventApplication->master = 1;
        }
        else {
          $eventApplication->master = 0;
        }
        $this->set('eventApplication', $eventApplication);
        $this->set('_serialize', ['eventApplication']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eventApplication = $this->EventApplications->newEntity();

        if ($this->request->is('ajax')) {
            $eventApplication = $this->EventApplications->patchEntity($eventApplication, $this->request->getData());
            $eventApplication->user_id = $this->Auth->user('id');

            $user_id = $this->Auth->user('id');
            $event_id = $eventApplication->event_id;

            $count = $this->EventApplications->find()->where(['user_id'=>$user_id,'event_id'=>$event_id])->count();
            $data = [];

            if ($count == 0 && $this->EventApplications->save($eventApplication)) {
              $data['success'] = true;
              $eventApplication = $this->EventApplications->get($eventApplication->id, [
                  'contain' => ['Users', 'Events']
              ]);

              $this->Notifier->notify(
                ['users' => [$eventApplication->event->user_id],
                'template' => 'new_application',
                'vars'=>
              ['user' => $eventApplication->event->user_id,
                    'event_id' => $eventApplication->event->id,
                    'event_title' => h($eventApplication->event->title),
                    'event_link' =>  Router::url(['controller'=>'EventApplications', 'action' => 'view', $eventApplication->id])
                    ]]);

            } else {
              $data['success'] = false;
              //debug($eventApplication->errors());
            }
            $this->set(compact('data'));
            $this->set('_serialize', 'data');
            return;
        }


    }

    /**
     * Edit method
     *
     * @param string|null $id Event Application id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventApplication = $this->EventApplications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventApplication = $this->EventApplications->patchEntity($eventApplication, $this->request->getData());
            if ($this->EventApplications->save($eventApplication)) {
                $this->Flash->success(__('The event application has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event application could not be saved. Please, try again.'));
        }
        $users = $this->EventApplications->Users->find('list', ['limit' => 200]);
        $events = $this->EventApplications->Events->find('list', ['limit' => 200]);
        $this->set(compact('eventApplication', 'users', 'events'));
        $this->set('_serialize', ['eventApplication']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event Application id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventApplication = $this->EventApplications->get($id);
        if ($this->EventApplications->delete($eventApplication)) {
            $this->Flash->success(__('The event application has been deleted.'));
        } else {
            $this->Flash->error(__('The event application could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function validate($id = null)
    {
      $this->request->allowMethod(['post', 'validate']);
      $application = $this->EventApplications->find()->where(['user_id'=>$this->Auth->user('id'), 'event_id' => $id])->first();
      $application->status = 0;
      $this->EventApplications->save($application);
      return $this->redirect($this->referer());
    }

    public function approve($id = null)
    {
      $eventApp = $this->EventApplications->get($id);
      $eventApp->status = 1;
      if($this->EventApplications->save($eventApp))
      {
        $this->Flash->success(__('You have successfully approved the application'));
      }
      else {
        $this->Flash->success(__('The application could not be approved. Please, try again.'));
      }
      return  $this->redirect($this->referer());
    }

    public function isAuthorized($user)
    {
      if ($this->request->action == 'index') {
        $event_id =  $this->request->getParam('pass.0');
        $eventsTable = TableRegistry::get('Events');
        $event = $eventsTable->get($event_id);

        if($event->user_id == $this->Auth->user('id'))
          return true;
      }

      else if($this->request->action == 'view')
      {
        $application_id =  $this->request->getParam('pass.0');
        $application = $this->EventApplications->get($application_id);
        $event_id = $application->event_id;
        $EventsTable = TableRegistry::get("Events");
        $event = $EventsTable->get($event_id);

        if($application->user_id == $this->Auth->user('id') || $event->user_id == $this->Auth->user('id'))
          return true;
      }
      else if($this->request->action == 'approve')
      {
        $application_id =  $this->request->getParam('pass.0');
        $application = $this->EventApplications->get($application_id);
        $event_id = $application->event_id;
        $EventsTable = TableRegistry::get("Events");
        $event = $EventsTable->get($event_id);
        if($event->user_id == $this->Auth->user('id'))
          return true;
      }
      else if($this->request->action == 'validate'){
        $event_id =  $this->request->getParam('pass.0');
        return $this->EventApplications->find()->where(['event_id'=>$event_id, 'user_id' => $this->Auth->user('id')])->count() == 1;
      }
      else if($this->request->action == 'add')
      {
        return true;
      }



      return parent::isAuthorized($user);
    }
}
