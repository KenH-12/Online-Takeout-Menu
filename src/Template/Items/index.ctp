<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item[]|\Cake\Collection\CollectionInterface $items
 */
?>
<div class="items index large-9 medium-8 columns content">

    <h2><?= __('Taste of Bombay') ?></h2>
    <h3><?= __('Online Takeout Menu') ?></h3>

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
            <?= $this->Form->hidden('id', ['value' => $item->id]) ?>
            <h5 class='title'><?= h($item->title) ?></h5>
            <p class='price'><?= $this->Number->currency($item->price) ?></p>
            <p class='btn-add'><i class="far fa-plus"></i></p>
        </div>

        <p class='description'><?= h($item->description ? $item->description . "." : "") ?></p>

        <div class='qty-controls hidden'>
            <button class='btn-subtract-qty btn-plus-minus' type='button' disabled>-</button>
            <input class='txt-qty' type='number' min='1' value='1' />
            <button class='btn-add-qty btn-plus-minus' type='button'>+</button>
            <button class='btn-add-to-cart' type='button'>Add to Cart</button>
        </div>
        
    </div>
    <?php endforeach; ?>
</div>

<div id='order-details'>
    <div class='table'>
        <div class='table-row'>
            <div class='table-cell'></div>
            <div class='table-cell table-heading'>Item</div>
            <div class='table-cell table-heading'>Price</div>
        </div>
        <div class='table-row' id='no-items'>
            <div class='table-cell'>No items in cart</div>
        </div>

        <div class='table-row hidden'>
            <div class='table-cell'></div>
            <div class='table-cell'></div>
            <div class='table-cell sub-heading'>Sub Total:</div>
            <div class='table-cell' id='sub-total'></div>
        </div>

        <div class='table-row hidden'>
            <div class='table-cell'></div>
            <div class='table-cell'></div>
            <div class='table-cell'>Taxes:</div>
            <div class='table-cell' id='taxes'></div>
        </div>

        <div class='table-row hidden'>
            <div class='table-cell'></div>
            <div class='table-cell'></div>
            <div class='table-cell sub-heading'>Total:</div>
            <div class='table-cell sub-heading' id='total'></div>
        </div>
    </div>
    
    <a id='btn-checkout'>Proceed to Checkout</a>
</div>