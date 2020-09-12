"use strict";

export default class MenuItem
{
    constructor($menuItem)
    {
        this.$container = $menuItem;
        this.$btnAddItem = $menuItem.find(".btn-add");
        this.$qtyControls = $menuItem.find(".qty-controls");
        this.$txtQty = $menuItem.find(".txt-qty");
        this.$btnSubtractQty = $menuItem.find(".btn-subtract-qty");
        this.$btnAddQty = $menuItem.find(".btn-add-qty");
        this.$btnAddToCart = $menuItem.find(".btn-add-to-cart");

        this.$btnAddItem.click(() => this.toggleQuantityControls());
    }

    toggleQuantityControls()
    {
        if (this.$qtyControls.hasClass("hidden"))
            return this.showQuantityControls();
        
        this.hideQuantityControls();    
    }

    showQuantityControls()
    {
        const { $btnAddItem, $qtyControls } = this;
        
        $btnAddItem.html("-");
        $qtyControls.removeClass("hidden");

        this.bindQuantityControlEventListeners();
    }

    hideQuantityControls()
    {
        const { $qtyControls, $btnAddItem } = this;

        $qtyControls.addClass("hidden");
        $btnAddItem.html("+");
    }

    bindQuantityControlEventListeners()
    {
        const {
                $txtQty,    
                $btnAddQty,
                $btnSubtractQty
            } = this,
            manageBtnSubtractDisabledAttr = (qty) => $btnSubtractQty.prop("disabled", (qty || this.getCurrentQuantity()) === 1);
        
        $txtQty.off("keyup").keyup(() => manageBtnSubtractDisabledAttr());

        $btnAddQty.off("click")
            .click(() =>
            {
                $txtQty.val(this.getCurrentQuantity() + 1);
                $btnSubtractQty.prop("disabled", false);
            });
        
        $btnSubtractQty.off("click")
            .click(() =>
            {
                const minQty = 1;
                let qty = this.getCurrentQuantity();

                if (qty === minQty)
                    return false;
                
                if (--qty < 1)
                    qty = 1;
                
                $txtQty.val(qty);

                manageBtnSubtractDisabledAttr(qty);
            });
    }

    getCurrentQuantity()
    {
        return parseInt(this.$txtQty.val() || 0);
    }
}