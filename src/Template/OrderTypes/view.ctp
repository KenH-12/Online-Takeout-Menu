<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $orderType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Order Type'), ['action' => 'edit', $orderType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order Type'), ['action' => 'delete', $orderType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Order Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Type'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orderTypes view large-9 medium-8 columns content">
    <h3><?= h("Order Type") ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($orderType->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fee') ?></th>
            <td><?= $this->Number->currency($orderType->fee) ?></td>
        </tr>
    </table>
</div>
