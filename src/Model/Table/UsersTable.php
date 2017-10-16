<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $EventApplications
 * @property \Cake\ORM\Association\HasMany $Events
 * @property \Cake\ORM\Association\BelongsToMany $Groups
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Josegonzalez/Upload.Upload', [
           'image' => [
            'nameCallback' => function(array $data, array $settings) {
                  $ext = pathinfo($data['name'], PATHINFO_EXTENSION);
                  $filename = pathinfo($data['name'], PATHINFO_FILENAME );
                  return substr(preg_replace( '/[^a-z0-9]+/', '-', strtolower( $filename) ), 0, 30).'-'.uniqid().'.'.$ext;
              },
            ],
        ]);
        $this->belongsToMany('Groups', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'group_id',
            'joinTable' => 'users_groups'
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
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->add(
                'password',
                [
                    'compare' => [
                        'rule' => ['compareWith', 'confirm_password'],
                        'message' => 'Passwords did not match'
                    ],
                    'minLength' => [
                        'rule' => ['minLength', 6],
                        'message' => 'Password must contain at least 6 character'
                    ],
                    'maxLength' => [
                        'rule' => ['maxLength', 25],
                        'message' => 'Passwords cannot be longer than 25 characters.'
                    ]
                ]
            )
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->requirePresence('confirm_password', 'create')
            ->notEmpty('confirm_password');    

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->allowEmpty('activation_code');

        $validator
            ->allowEmpty('forgotten_password_code');

        $validator
            ->integer('forgotten_password_time')
            ->allowEmpty('forgotten_password_time');

        $validator
            ->allowEmpty('remember_code');

        $validator
            ->boolean('active')
            ->allowEmpty('active');

        $validator
            ->notEmpty('first_name');

        $validator
            ->notEmpty('last_name');

        $validator
            ->allowEmpty('phone');

        $validator
            ->allowEmpty('university');

        $validator
            ->allowEmpty('department');

        $validator
            ->allowEmpty('about');

        $validator
            ->allowEmpty('image');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */


    public function findAuth(\Cake\ORM\Query $query, array $options)
    {
        $query
            ->select(['id', 'email', 'password'])
            ->where(['Users.active' => 1]);

        return $query;
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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
