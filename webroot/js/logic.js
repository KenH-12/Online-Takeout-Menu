"use strict";

import MenuItem from "./menuItem.js";

function instantiateMenuItems()
{
    $(".menu-item").each(function()
    {
        new MenuItem($(this));
    });
}

$(function()
{
    instantiateMenuItems();
});