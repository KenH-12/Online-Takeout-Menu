"use strict";

import MenuItem from "./menuItem.js";
import OrderPanel from "./OrderPanel.js";

function instantiateMenuItems()
{
    const orderPanel = new OrderPanel($("#order-details"));

    $(".menu-item").each(function()
    {
        new MenuItem($(this), orderPanel);
    });
}

$(function()
{
    instantiateMenuItems();
});