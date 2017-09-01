<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Postcontents Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Posts
 *
 * @method \App\Model\Entity\Postcontent get($primaryKey, $options = [])
 * @method \App\Model\Entity\Postcontent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Postcontent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Postcontent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Postcontent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Postcontent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Postcontent findOrCreate($search, callable $callback = null, $options = [])
 */
class PostcontentsTable extends Table
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

        $this->setTable('post_contents');
        $this->setDisplayField('title');
        $this->setPrimaryKey(array('post_id', 'language'));

        $this->belongsTo('Posts', [
            'foreignKey' => 'post_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('VolunteamsPosts', [
            'foreignKey' => 'post_id',
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
        $rules->add($rules->existsIn(['post_id'], 'Posts'));

        return $rules;
    }
}
