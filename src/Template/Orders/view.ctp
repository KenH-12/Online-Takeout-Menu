<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(__('Delete Order'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'adminIndex']) ?> </li>
        <li><?= $this->Html->link(__('List Order Types'), ['controller' => 'OrderTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Type'), ['controller' => 'OrderTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orders view large-9 medium-8 columns content">
    <h3><?= h("Order #{$order->id}") ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Order Type') ?></th>
            <td><?= $order->has('order_type') ? $this->Html->link($order->order_type->description, ['controller' => 'OrderTypes', 'action' => 'view', $order->order_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Date') ?></th>
            <td><?= h($order->order_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Time') ?></th>
            <td><?= h($order->order_time->i18nFormat("hh:mm")) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Items') ?></h4>
        <?php if (!empty($order->items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Item') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Price/Unit') ?></th>
            </tr>
            <?php foreach ($order->items as $items): ?>
            <tr>
                <td><?= h($items->title) ?></td>
                <td><?= h($items->description) ?></td>
                <td><?= h($items->_joinData->quantity) ?></td>
                <td><?= $this->Number->currency($items->price) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <table class="vertical-table">   
        <tr>
            <th scope="row"><?= __('Sub Total') ?></th>
            <td>
                <?php
                    $subTotal = 0;
                    foreach ($order->items as $item)
                        $subTotal += $item->price;
                    
                    echo $this->Number->currency($subTotal);
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Taxes') ?></th>
            <td>
                <?php
                    $taxes = $subTotal * 0.13;
                    echo $this->Number->currency($taxes);
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total') ?></th>
            <td><?= $this->Number->currency($subTotal + $taxes) ?></td>
        </tr>
    </table>
</div>
