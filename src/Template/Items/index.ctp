<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item[]|\Cake\Collection\CollectionInterface $items
 */
?>
<div class="items index large-9 medium-8 columns content">

    <h2><?= __('Online Takeout Menu') ?></h2>
    <?php
        $currentCategory = false;
        foreach ($items as $item):
    ?>
    <?php
        $category = $item->item_category;
        if (!$currentCategory || $category->title !== $currentCategory->title)
        {
            $currentCategory = $category;
            $description = $category->description ? "<p class='item-category-desc'>{$category->description}.</p>" : "";
            echo "<div class='item-category'>
                        <h4>{$category->title}</h4>
                        $description
                    </div>";
        }
    ?>
    <div class='menu-item'>
        <div>
            <h5 class='title'><?= h($item->title) ?></h5>
            <p class='price'><?= $this->Number->currency($item->price) ?></p>
            <p class='btnAdd'>+</p>
        </div>
        <p class='description'><?= h($item->description ? $item->description . "." : "") ?></p>
    </div>
    <?php endforeach; ?>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

<div class="large-3 medium-4 columns" >
    <div id="order-details">
        
    </div>
</div>
