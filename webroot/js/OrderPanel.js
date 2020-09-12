"use strict";

export default class OrderPanel
{
    constructor($container)
    {
        this.$container = $container;
        this.$placeholder = this.$container.find("#no-items");
        this.$subTotal = $container.find("#sub-total");
        this.$taxes = $container.find("#taxes");
        this.$total = $container.find("#total");

        this.items = {};
    }

    addItem(menuItem)
    {
        const { itemId, title, price } = menuItem,
            qtyToAdd = menuItem.getCurrentQuantity(),
            { items } = this;

        if (items.hasOwnProperty(itemId))
            items[itemId].quantity += qtyToAdd;
        else
            items[itemId] = {
                title,
                price: Number(price.substring(1)), // remove dollar sign
                quantity: qtyToAdd
            };

        this.appendRow(itemId, qtyToAdd);
    }

    appendRow(itemId, qtyToAdd)
    {
        const { title, price } = this.items[itemId];
        
        for (let i = 0; i < qtyToAdd; i++)
            this.newRow(itemId, [title, toCurrency(price)])
                .insertBefore(this.$subTotal.parent());
        
        this.updateTotal();
    }

    newRow(itemId, cellTextArr)
    {
        const $newRow = $(`<div class='table-row' data-item-id='${itemId}'></div>`);

        for (let cellText of cellTextArr)
            $newRow.append(`<div class='table-cell'>${cellText}</div>`);
        
        return $newRow;
    }

    updateTotal()
    {
        const {
            $subTotal,
            $taxes,
            $total,
            $container,
            $placeholder
        } = this,
            subTotal = this.calculateSubTotal(),
            taxes = subTotal * 0.13,
            total = subTotal + taxes;

        $subTotal.html(toCurrency(subTotal));
        $taxes.html(toCurrency(taxes));
        $total.html(toCurrency(total));

        $container.find(".table-row").not($placeholder.addClass("hidden")).removeClass("hidden");
    }

    calculateSubTotal()
    {
        let { items } = this,
            item,
            subTotal = 0;

        for (let key in items)
        {
            item = items[key];
            subTotal += item.price * item.quantity;
        }
        
        return subTotal;
    }
}

function toCurrency(n)
{
    return `$${n.toFixed(2)}`;
}