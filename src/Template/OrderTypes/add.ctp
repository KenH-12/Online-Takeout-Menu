<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $orderType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Order Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="orderTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($orderType) ?>
    <fieldset>
        <legend><?= __('Add Order Type') ?></legend>
        <?php
            echo $this->Form->control('description');
            echo $this->Form->control('fee');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
