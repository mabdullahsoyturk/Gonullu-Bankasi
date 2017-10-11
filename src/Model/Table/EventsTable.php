<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Event get($primaryKey, $options = [])
 * @method \App\Model\Entity\Event newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Event[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Event|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Event patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Event[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Event findOrCreate($search, callable $callback = null, $options = [])
 */
class EventsTable extends Table
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

        $this->setTable('events');
        $this->setDisplayField('title');
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

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }
    public function renameUploadedPhoto($data, $settings)
     {
        exit;
         $ext = substr(strrchr($data['name'], '.'), 1);
         return Text::uuid() . '.' . $ext;
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
                'title',
                    [
                    'minLength' => [
                        'rule' => ['minLength', 5],
                        'message' => 'Title must contain at least 5 character'
                    ],
                    'maxLength' => [
                        'rule' => ['maxLength', 75],
                        'message' => 'Titles cannot be longer than 75 characters.'
                        ]
                    ]
                )
            ->requirePresence('title', 'create')
            ->notEmpty('title');

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
            ->requirePresence('image', 'create')
            ->notEmpty('image');

        $validator
            ->requirePresence('volunteer_count', 'create')
            ->notEmpty('volunteer_count');

        $validator
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->dateTime('deadline')
            ->requirePresence('deadline', 'create')
            ->notEmpty('deadline');

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

        return $rules;
    }
}
