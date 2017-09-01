<?php
namespace App\Model\Table;

use Aura\Intl\Exception;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * MessageGroups Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $MessageGroupMembers
 * @property \Cake\ORM\Association\HasMany $Messages
 *
 * @method \App\Model\Entity\MessageGroup get($primaryKey, $options = [])
 * @method \App\Model\Entity\MessageGroup newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MessageGroup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MessageGroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MessageGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MessageGroup[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MessageGroup findOrCreate($search, callable $callback = null, $options = [])
 */
class MessageGroupsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('message_groups');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'creator_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('MessageGroupMembers', [
            'foreignKey' => 'message_group_id'
        ]);
        $this->hasMany('Messages', [
            'foreignKey' => 'message_group_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

        $validator
            ->integer('is_private')
            ->requirePresence('is_private', 'create')
            ->notEmpty('is_private');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['creator_id'], 'Users'));

        return $rules;
    }

    public function getGroupBetweenTwo($creatorId, $userId) {
        $ids = [$creatorId, $userId];
        sort($ids);
        $ids = implode($ids, ',');

        $group = $this->find()
            ->select([
                'id' => 'message_group_id',
                'user_ids' => 'group_concat(user_id ORDER BY user_id)'
            ])
            ->where(['is_private'=>true])
            ->innerJoin('message_group_members', ['message_group_id = id'])
            ->group('message_group_id')
            ->having(['user_ids'=>$ids])
            ->first();

        return $group == NULL ? NULL : $group->id;
    }

    public function createGroupBetweenTwo($creatorId, $userId) {

        return $this->getConnection()->transactional(function() use ($creatorId, $userId) {
            $msgGroup = $this->newEntity();
            $msgGroup->creator_id = $creatorId;

            if(! $this->save($msgGroup)){
                throw new Exception(_('Could not be saved.'));
            }

            $members = [$creatorId, $userId];
            $memberTable = TableRegistry::get("MessageGroupMembers");

            foreach ($members as $memberId) {
                $member = $memberTable->newEntity(
                    ['message_group_id' => $msgGroup->id,
                        'user_id' => $memberId
                    ]
                );

                if(! $memberTable->save($member, ['atomic'=>false])){
                    throw new Exception(_('Could not be saved.'));
                }
            }
            return $msgGroup->id;
        });
    }
}
