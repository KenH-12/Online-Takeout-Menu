<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate|null $order_date
 * @property \Cake\I18n\FrozenTime|null $order_time
 * @property int|null $order_type_id
 *
 * @property \App\Model\Entity\OrderType $order_type
 * @property \App\Model\Entity\Item[] $items
 */
class Order extends Entity
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
        'order_date' => true,
        'order_time' => true,
        'order_type_id' => true,
        'order_type' => true,
        'items' => true,
    ];
}
