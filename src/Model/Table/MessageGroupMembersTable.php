<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MessageGroupMembers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $MessageGroups
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\MessageGroupMember get($primaryKey, $options = [])
 * @method \App\Model\Entity\MessageGroupMember newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MessageGroupMember[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MessageGroupMember|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MessageGroupMember patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MessageGroupMember[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MessageGroupMember findOrCreate($search, callable $callback = null, $options = [])
 */
class MessageGroupMembersTable extends Table
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

        $this->setTable('message_group_members');
        $this->setPrimaryKey(['message_group_id', 'user_id']);

        $this->belongsTo('MessageGroups', [
            'foreignKey' => 'message_group_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['message_group_id'], 'MessageGroups'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
