<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MessageGroup Entity
 *
 * @property int $id
 * @property int $creator_id
 * @property string $name
 * @property int $is_private
 *
 * @property \App\Model\Entity\Creator $creator
 * @property \App\Model\Entity\MessageGroupMember[] $message_group_members
 * @property \App\Model\Entity\Message[] $messages
 */
class MessageGroup extends Entity
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
        '*' => true,
        'id' => false
    ];
}
