<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PostContents Controller
 *
 * @property \App\Model\Table\PostContentsTable $PostContents
 *
 * @method \App\Model\Entity\PostContent[] paginate($object = null, array $settings = [])
 */
class PostContentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Posts']
        ];
        $postContents = $this->paginate($this->PostContents);

        $this->set(compact('postContents'));
        $this->set('_serialize', ['postContents']);
    }

    /**
     * View method
     *
     * @param string|null $id Post Content id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $postContent = $this->PostContents->get($id, [
            'contain' => ['Posts']
        ]);

        $this->set('postContent', $postContent);
        $this->set('_serialize', ['postContent']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $postContent = $this->PostContents->newEntity();
        if ($this->request->is('post')) {
            $postContent = $this->PostContents->patchEntity($postContent, $this->request->getData());
            if ($this->PostContents->save($postContent)) {
                $this->Flash->success(__('The post content has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post content could not be saved. Please, try again.'));
        }
        $posts = $this->PostContents->Posts->find('list', ['limit' => 200]);
        $this->set(compact('postContent', 'posts'));
        $this->set('_serialize', ['postContent']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post Content id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $postContent = $this->PostContents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postContent = $this->PostContents->patchEntity($postContent, $this->request->getData());
            if ($this->PostContents->save($postContent)) {
                $this->Flash->success(__('The post content has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post content could not be saved. Please, try again.'));
        }
        $posts = $this->PostContents->Posts->find('list', ['limit' => 200]);
        $this->set(compact('postContent', 'posts'));
        $this->set('_serialize', ['postContent']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post Content id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $postContent = $this->PostContents->get($id);
        if ($this->PostContents->delete($postContent)) {
            $this->Flash->success(__('The post content has been deleted.'));
        } else {
            $this->Flash->error(__('The post content could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
