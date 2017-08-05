<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\ORM\TableRegistry;
/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 * @property \App\Model\Table\PostContentsTable $PostContents
 *
 * @method \App\Model\Entity\Post[] paginate($object = null, array $settings = [])
 */
class PostsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {

        $this->paginate = [
            'contain' => ['Users']
        ];
        $posts = $this->paginate($this->Posts);

        $this->set(compact('posts'));
        $this->set('_serialize', ['posts']);
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, ['contain'=>['Users', 'PostContents']]);
        /*
find()
            ->select('id')
            ->innerJoinWith('post_contents')
            ->where(['post_id' => 'posts.id', 'posts.id' => $id]
        */

        $this->set('post', $post);
        $this->set('_serialize', ['post']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('PostContents');

        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $this->Auth->user('id');

            $post = $this->Posts->patchEntity($post, $data);
            $result = $this->Posts->save($post);

            if ($result) {
                $postId = $result->id;
                foreach(array('en', 'tr') as $language) {
                    $postContent = $this->PostContents->patchEntity(
                                $this->PostContents->newEntity(),
                                array(
                                    'post_id' => $postId,
                                    'language'=> $language,
                                    'title' => $data['title_'.$language],
                                    'description' => $data['description_'.$language]
                                    )
                        );
                    $result = $this->PostContents->save($postContent);
                    if(! $result) {
                        $this->Flash->error(__('The post content could not be saved. Please, try again.'));
                    }

                }

                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('PostContents');

        $post = $this->Posts->get($id, [
            'contain' => ['PostContents']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['user_id'] = $this->Auth->user('id');

            $post = $this->Posts->patchEntity($post, $data);
            $result = $this->Posts->save($post);

            if ($result) {
                $postId = $result->id;
                foreach(array('en', 'tr') as $language) {
                    $postContent = $this->PostContents->patchEntity(
                                $this->PostContents->newEntity(),
                                array(
                                    'post_id' => $postId,
                                    'language'=> $language,
                                    'title' => $data['title_'.$language],
                                    'description' => $data['description_'.$language]
                                    )
                        );
                    $result = $this->PostContents->save($postContent);
                    if(! $result) {
                        $this->Flash->error(__('The post content could not be saved. Please, try again.'));
                    }

                }

                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user) { 
        return true;
    }
}
