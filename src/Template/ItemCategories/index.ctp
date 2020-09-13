<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemCategory[]|\Cake\Collection\CollectionInterface $itemCategories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item Category'), ['controller' => 'ItemCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'adminIndex']) ?></li>
    </ul>
</nav>
<div class="itemCategories index large-9 medium-8 columns content">
    <h3><?= __('Item Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <?php foreach ($itemCategories as $itemCategory): ?>
            <tr>
                <td><?= h($itemCategory->title) ?></td>
                <td><?= h($itemCategory->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemCategory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemCategory->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
