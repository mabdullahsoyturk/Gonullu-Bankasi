<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $activation_code
 * @property string $forgotten_password_code
 * @property int $forgotten_password_time
 * @property string $remember_code
 * @property \Cake\I18n\FrozenTime $created_on
 * @property bool $active
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $university
 * @property string $department
 * @property string $about
 * @property string $image
 *
 * @property \App\Model\Entity\Group[] $groups
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => false,
        'email' => true,
        'password' => true,
        'username' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }
}
