/*  -----------------------------------------------------------------------------------------
    H E A D E R
-----------------------------------------------------------------------------------------  */

.tbSticky {
  -webkit-box-shadow:
    0 1px 0 rgba(0, 0, 0, 0.05),
    0 0 10px rgba(0, 0, 0, 0.15);
  box-shadow:
    0 1px 0 rgba(0, 0, 0, 0.05),
    0 0 10px rgba(0, 0, 0, 0.15);
}

/*  -----------------------------------------------------------------------------------------
    B U T T O N S
-----------------------------------------------------------------------------------------  */

.btn,
.btn:hover
{
  border-radius: 0;
  -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
          box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
}

/*  -----------------------------------------------------------------------------------------
    P R O D U C T S
-----------------------------------------------------------------------------------------  */

.tb_subcategories.tb_grid_view:before,
.tb_subcategories.tb_grid_view:after
{
  content: none;
}

/*  -----------------------------------------------------------------------------------------
    D E C O R A T I O N
-----------------------------------------------------------------------------------------  */

.buttons:before,
.mini-cart-total:before,
.content:not(.ui-widget-content) + h2:before,
fieldset + fieldset legend:before,
.tb_listing:not([class*="tb_style_"]) + .pagination:before,
[class*="table"] + .pagination:before,
.tb_listing > .tb_review:not(:first-child):before,
.account-account .tb_system_page_content .list-unstyled + h2:before,
.affiliate-account .tb_system_page_content .list-unstyled + h2:before
{
  opacity: 0.3;
}
.tb_system_page_content .buttons:before,
.tb_system_page_content .mini-cart-total:before,
.tb_system_page_content .content:not(.ui-widget-content) + h2:before,
.tb_system_page_content fieldset + fieldset legend:before,
.tb_system_page_content .tb_listing:not([class*="tb_style_"]) + .pagination:before,
.tb_system_page_content [class*="table"] + .pagination:before,
.tb_system_page_content .tb_listing > .tb_review:not(:first-child):before,
.tb_system_page_content .account-account .tb_system_page_content .list-unstyled + h2:before,
.tb_system_page_content .affiliate-account .tb_system_page_content .list-unstyled + h2:before
{
  opacity: 0.2;
}
