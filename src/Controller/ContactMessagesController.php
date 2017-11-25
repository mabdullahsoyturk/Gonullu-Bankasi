<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContactMessages Controller
 *
 * @property \App\Model\Table\ContactMessagesTable $ContactMessages
 *
 * @method \App\Model\Entity\ContactMessage[] paginate($object = null, array $settings = [])
 */
class ContactMessagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $contactMessages = $this->paginate($this->ContactMessages);

        $this->set(compact('contactMessages'));
        $this->set('_serialize', ['contactMessages']);
    }

    /**
     * View method
     *
     * @param string|null $id Contact Message id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactMessage = $this->ContactMessages->get($id, [
            'contain' => []
        ]);

        $this->set('contactMessage', $contactMessage);
        $this->set('_serialize', ['contactMessage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactMessage = $this->ContactMessages->newEntity();
        if ($this->request->is('post')) {
            $contactMessage = $this->ContactMessages->patchEntity($contactMessage, $this->request->getData());
            if ($this->ContactMessages->save($contactMessage)) {
                $this->Flash->success(__('Your message has been delivered.'));

                return $this->redirect(['controller' => 'pages' ,'action' => 'contact']);
            }
            $this->Flash->error(__('The contact message could not be saved. Please, try again.'));
        }
        $this->set(compact('contactMessage'));
        $this->set('_serialize', ['contactMessage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact Message id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactMessage = $this->ContactMessages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactMessage = $this->ContactMessages->patchEntity($contactMessage, $this->request->getData());
            if ($this->ContactMessages->save($contactMessage)) {
                $this->Flash->success(__('The contact message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact message could not be saved. Please, try again.'));
        }
        $this->set(compact('contactMessage'));
        $this->set('_serialize', ['contactMessage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactMessage = $this->ContactMessages->get($id);
        if ($this->ContactMessages->delete($contactMessage)) {
            $this->Flash->success(__('The contact message has been deleted.'));
        } else {
            $this->Flash->error(__('The contact message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
   {
     return true;
   }
}
