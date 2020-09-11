"use strict";

export default class MenuItem
{
    constructor($menuItem)
    {
        this.$container = $menuItem;
        this.$btnAddItem = $menuItem.find(".btnAdd");

        this.$btnAddItem.click(() => this.toggleQuantitySelector());
    }

    toggleQuantitySelector()
    {
        if (this.$qtySelector)
            return this.hideQuantitySelector();
        
        this.showQuantitySelector();
    }

    showQuantitySelector()
    {
        const { $btnAddItem, $container } = this,
            $qtySelector = $(`<div class='qty-selector'></div>`).appendTo($container);

        $btnAddItem.html("-");

        this.$btnSubtractQty = $(`<button class='btn-subtract btn-plus-minus' type='button' disabled>-</button>`).appendTo($qtySelector);
        this.$txtQty = $(`<input class='txt-qty' type='number' min='1' value='1' />`).appendTo($qtySelector);
        this.$btnAddQty = $(`<button class='btn-add btn-plus-minus' type='button'>+</button>`).appendTo($qtySelector);
        this.$btnAddToCart = $(`<button class='btn-add-to-cart' type='button'>Add to Cart</div>`).appendTo($qtySelector);
        
        this.$qtySelector = $qtySelector;

        this.bindQuantityControlEventListeners();
    }

    hideQuantitySelector()
    {
        const $qs = this.$qtySelector;
        
        this.$qtySelector = false;
        this.$btnAddToCart.add($qs).remove();

        this.$btnAddItem.html("+");
    }

    bindQuantityControlEventListeners()
    {
        const {
                $txtQty,    
                $btnAddQty,
                $btnSubtractQty
            } = this,
            getCurrentQuantity = () => parseInt($txtQty.val() || 0),
            manageBtnSubtractDisabledAttr = (qty) => $btnSubtractQty.prop("disabled", (qty || getCurrentQuantity()) === 1);;
        
        $txtQty.off("keyup").keyup(() => manageBtnSubtractDisabledAttr());

        $btnAddQty.off("click")
            .click(() =>
            {
                $txtQty.val(getCurrentQuantity() + 1);
                $btnSubtractQty.prop("disabled", false);
            });
        
        $btnSubtractQty.off("click")
            .click(() =>
            {
                const minQty = 1;
                let qty = getCurrentQuantity();

                if (qty === minQty)
                    return false;
                
                if (--qty < 1)
                    qty = 1;
                
                $txtQty.val(qty);

                manageBtnSubtractDisabledAttr(qty);
            });
    }
}