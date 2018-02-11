<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Http\CallbackStream;

class MessagesController extends AppController
{
    protected $_model;
    public function initialize()
    {
        parent::initialize();
        // Add logout to the allowed actions list.
        $this->loadModel('Messages');
        $this->loadComponent('Notifier');
    }
    public function index()
    {
        $userId = $this->Auth->user('id');
        $msgGroupMembersTable = TableRegistry::get('MessageGroupMembers');
        $msgTable = TableRegistry::get('Messages');

        $msgGroups = $msgGroupMembersTable->find()
                    ->select(['group_id' => 'm1.message_group_id',
                        'name'=>'CONCAT(users.first_name, " ", users.last_name)',
                        'message'=>'m1.message',
                        'otherUserId'=>'mgm1.user_id',
                        'otherUserImage' => 'image',
                        'message_user_id' => 'm1.user_id'])
                    ->innerJoin(['m1'=>'messages'], [
                                'm1.message_group_id = MessageGroupMembers.message_group_id'
                                ])
                    ->leftJoin(['m2'=>'messages'], [
                                'm2.message_group_id = MessageGroupMembers.message_group_id',
                                'm1.id < m2.id'
                    ])
                    ->innerJoin(['mgm1' =>'message_group_members'], [
                                'MessageGroupMembers.message_group_id = mgm1.message_group_id',
                                'mgm1.user_id !='=>$userId
                    ])
                    ->innerJoin('users', ['users.id=mgm1.user_id'])
                    ->where(['MessageGroupMembers.user_id'=>$userId, 'm2.id IS NULL']);

        $this->set('userId', $userId);
        $this->set('msgGroups', $msgGroups);
    }

    public function with($otherUserId) {
        $userId = $this->Auth->user('id');
        $this->loadModel("Users");

        if($userId == $otherUserId || ! $this->Users->exists(['id'=>$otherUserId])) {
            exit;
        }
        $msgGroupTable = TableRegistry::get('MessageGroups');
        $groupId = $msgGroupTable->getGroupBetweenTwo($userId, $otherUserId);

        if($groupId == NULL) {
            $groupId = $msgGroupTable->createGroupBetweenTwo($userId, $otherUserId);
        }
        $this->loadModel("Users");
        $this->set('user', $this->Users->get($userId));
        $this->set('groupId', $groupId);
        $this->set('otherUser', $this->Users->get($otherUserId));
        $this->set('otherUserId', $otherUserId);
    }

    private function isUserAMember($userId, $groupId) {
        $groupMembersTable = TableRegistry::get('MessageGroupMembers');

        return $groupMembersTable->find()->where(['message_group_id' => $groupId,
                'user_id' => $userId])->count() > 0;

    }

    public function getPrivateMessages($otherUserId) {
        $msgGroups = TableRegistry::get('MessageGroups');
        $userId = $this->Auth->user('id');
        if($userId == $otherUserId) {
            return false;
        }

        $msgGroupId = $msgGroups->getGroupBetweenTwo($userId, $otherUserId);
        if($msgGroupId == NULL) {
           return $this->sendAsJSON(array());
        }

        $msgTable = TableRegistry::get('Messages');
        $messages = $msgTable->find()
                            ->select(['id'=>'Messages.id',
                                      'user_id',
                                      'message',
                                      'userImage' => 'image',
                                      'username' => 'CONCAT(users.first_name, " ", users.last_name)',])
                            ->innerJoin('users', ['user_id=users.id'])
                            ->where(['message_group_id' => $msgGroupId])
                            ->toArray();

        foreach($messages as &$message) {
            $message->me = $this->Auth->user('id') == $message->user_id;
        }

        $this->sendAsJSON($messages);
    }

    private function sendAsJSON($object) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->getBody()->write(json_encode($object));

        return $this->response;
    }

    public function save()
    {
        $msgTable = TableRegistry::get('Messages');
        $groupMembersTable = TableRegistry::get('MessageGroupMembers');

        $userId = $this->Auth->user('id');
        $msgContent = $this->request->getData('message');
        $msgGroupId = $this->request->getData('groupId');

        $result = array('success' => false);

        if($this->isUserAMember($userId, $msgGroupId)) {
            $message = $msgTable->newEntity([
                'user_id' => $userId,
                'message_group_id' => (int) $msgGroupId,
                'message' => $msgContent
            ]);
            if (!empty ($msgContent)) {
                $result['success'] = $msgTable->save($message)? true: false;
            };

        }

        return $this->sendAsJSON($result);
    }

    public function isAuthorized($user)
    {
        return true;
    }
}
