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

        this.loadOrderFromSessionStorage();
    }

    loadOrderFromSessionStorage()
    {
        const sessionOrder = sessionStorage.getItem("order");

        if (sessionOrder === "{}")
        {
            this.items = {};
            return false;
        }
        
        this.items = JSON.parse(sessionOrder);
        
        for (let itemId in this.items)
            this.appendRow(itemId, this.items[itemId].quantity);
        
        this.updateTotal();
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

        this.setSessionStorageItems();
        this.appendRow(itemId, qtyToAdd);
        this.updateTotal();
    }

    removeItem($itemRow)
    {
        const itemId = $itemRow.data("item-id"),
            item = this.items[itemId];
        
        $itemRow.remove();

        if (--item.quantity < 1)
        {
            delete this.items[itemId];
            this.setSessionStorageItems();
            
            if (Object.keys(this.items).length === 0)
            {
                this.$container.find(".table-row").not(":first-of-type").addClass("hidden");
                this.$placeholder.removeClass("hidden");
                return false;
            }
        }
        
        this.updateTotal();
    }

    appendRow(itemId, qtyToAdd)
    {
        const { title, price } = this.items[itemId];
        
        let $newRow;
        for (let i = 0; i < qtyToAdd; i++)
        {
            $newRow = this.newRow(itemId, [`<i class="far fa-trash-alt"></i>`, title, toCurrency(price)])
                .insertBefore(this.$subTotal.parent());
            
            this.bindTrashClickEventListener($newRow);
        }
    }

    newRow(itemId, cellTextArr)
    {
        const $newRow = $(`<div class='table-row' data-item-id='${itemId}'></div>`);

        for (let cellText of cellTextArr)
            $newRow.append(`<div class='table-cell'>${cellText}</div>`);
        
        return $newRow;
    }

    bindTrashClickEventListener($row)
    {
        const self = this;

        $row.find(".fa-trash-alt")
            .off("click")
            .click(() => self.removeItem($row));
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

    setSessionStorageItems()
    {
        sessionStorage.setItem("order", JSON.stringify(this.items));
    } 
}

function toCurrency(n)
{
    return `$${n.toFixed(2)}`;
}