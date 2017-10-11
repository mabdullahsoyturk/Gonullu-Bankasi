<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventApplications Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Events
 *
 * @method \App\Model\Entity\EventApplication get($primaryKey, $options = [])
 * @method \App\Model\Entity\EventApplication newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EventApplication[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EventApplication|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventApplication patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EventApplication[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EventApplication findOrCreate($search, callable $callback = null, $options = [])
 */
class EventApplicationsTable extends Table
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

        $this->setTable('event_applications');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
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

        $validator
            ->add(
                'description',
                    [
                    'minLength' => [
                        'rule' => ['minLength', 6],
                        'message' => 'Description must contain at least 5 character'
                        ]
                    ]
                )
            ->requirePresence('description', 'create')
            ->notEmpty('description');
        $validator
            ->requirePresence('event_id', 'create')
            ->notEmpty('event_id');
        $validator
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['event_id'], 'Events'));

        return $rules;
    }
}
