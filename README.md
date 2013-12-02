coinbase-api-expressionengine-module
====================================

## Example using Stash module

`
{exp:stash:set
    name="cart_items_info"
    parse_tags="yes"
}
    {exp:cartthrob:cart_items_info}-{title}-{/exp:cartthrob:cart_items_info}
{/exp:stash:set}

{exp:stash:set
    name="cart_total"
    parse_tags="yes"
}
    {exp:cartthrob:cart_total prefix=""}
{/exp:stash:set}

{exp:coinbase_api:display_buy_button
  cart_items="{exp:stash:get name='cart_items_info'}"
  cart_total="{exp:stash:get name='cart_total'}"
  parse="inward"
}`