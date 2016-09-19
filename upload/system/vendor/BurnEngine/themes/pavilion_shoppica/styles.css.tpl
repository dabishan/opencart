/*  -----------------------------------------------------------------------------------------
    B U T T O N S
-----------------------------------------------------------------------------------------  */

.btn,
.button,
button,
input[type=button]
{
  line-height:   <?php echo $form_control_height - 6; ?>px;
  border-radius: 0 !important;
  border-width: 3px;
  border-style: solid;
  border-color: transparent !important;
  -webkit-box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.25);
  box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.25);
}
.btn:hover,
.button:hover,
button:hover,
input[type=button]:hover
{
  -webkit-box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.35);
  box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.35);
}
.btn-xs,
.btn-sm,
.btn-group-xs > .btn,
.btn-group-sm > .btn,
.options .option input[type=button]
{
  border-width: 2px;
}

/*** Button Sizes ***/

.btn.btn-xs,
.btn-group-xs > .btn,
.input-group-xs > .input-group-btn > .btn
{
  line-height:   <?php echo $form_control_height_xs - 4; ?>px;
}
.btn.btn-sm,
.btn-group-sm > .btn,
.input-group-sm > .input-group-btn > .btn
{
  line-height:   <?php echo $form_control_height_sm - 4; ?>px;
}
.btn.btn-lg,
.btn-group-lg > .btn,
.input-group-lg > .input-group-btn > .btn
{
  line-height:   <?php echo $form_control_height_lg - 6; ?>px;
}
.btn.btn-xl,
.btn-group-xl > .btn,
.input-group-xl > .input-group-btn > .btn
{
  line-height:   <?php echo $form_control_height_xl - 6; ?>px;
}
.btn.btn-xxl,
.btn-group-xxl > .btn,
.input-group-xxl > .input-group-btn > .btn
{
  line-height:   <?php echo $form_control_height_xxl - 6; ?>px;
}
.buttons .btn:not(.btn-xs):not(.btn-sm):not(.btn-lg):not(.btn-xl):not(.btn-xxl),
.buttons .button,
.buttons button,
.buttons [type=button],
.buttons [type=submit],
#button-cart,
#product_buy_quantity,
#product_buy #input-quantity
{
  line-height:   <?php echo $submit_button_height - 6; ?>px !important;
}
.noty_message .noty_close.noty_close {
  margin: 0 !important;
  line-height: 16px !important;
}

/*  -----------------------------------------------------------------------------------------
    P R O D U C T   L I S T I N G
-----------------------------------------------------------------------------------------  */

.tb_listing:not(.tb_compact_view) .product-thumb .price,
.tb_listing:not(.tb_compact_view) .product-thumb .price > :not(.price-old)
{
  position: absolute;
  <?php if ($lang_dir == 'ltr'): ?>
  right: 0;
  <?php else: ?>
  left: 0;
  <?php endif; ?>
  display: block;
  width: 60px;
  height: 60px;
  margin: 0;
  padding: 0;
  text-align: center;
}
.tb_listing:not(.tb_compact_view) .product-thumb .price {
  z-index: 3;
  top: -30px;
}
.tb_listing:not(.tb_compact_view) .product-thumb .price > :not(.price-old) {
  top: 0;
  line-height: 60px;
  border-radius: 50%;
}
.tb_listing:not(.tb_compact_view) .product-thumb .price > :not(.price-old) > * {
  position: relative;
  z-index: 3;
}
.tb_listing:not(.tb_compact_view) .product-thumb .price > .price-old {
  position: relative;
  z-index: 3;
  top: 2px;
  display: inline-block;
  margin: 0;
  padding: 0;
  vertical-align: top;
  font-size: 65%;
  opacity: 0.8;
}
.tb_listing:not(.tb_compact_view) .product-thumb .price > .price-old:before {
  opacity: 0.5;
}
.tb_listing:not(.tb_compact_view) .product-thumb .price > .price-old .tb_currency {
  display: none;
}
.tb_listing:not(.tb_compact_view) .product-thumb .price > .price-old .tb_decimal_point {
  display: inline;
}
.tb_listing:not(.tb_compact_view) .product-thumb .price > .price-old .tb_decimal {
  position: static;
  font-size: inherit;
}
.tb_listing:not(.tb_compact_view) .product-thumb .price:after {
  content: '';
  position: absolute;
  z-index: 2;
  top: 3px;
  right: 3px;
  bottom: 3px;
  left: 3px;
  display: block;
  border: 1px solid rgba(255, 255, 255, 0.4);
  border-radius: 50%;
}
.tb_listing .tb_item_hovered .product-thumb .price:after {
  z-index: 100;
}

/*  List view  --------------------------------------------------------------------------- */

.tb_listing.tb_list_view .product-thumb .price {
  top: 0;
  text-align: center;
}
.tb_listing.tb_list_view .product-thumb .description,
.tb_listing.tb_list_view .product-thumb .tb_review > p
{
  <?php if ($lang_dir == 'ltr'): ?>
  padding-right: 80px;
  <?php else: ?>
  padding-left: 80px;
  <?php endif; ?>
}

/*  Grid view  --------------------------------------------------------------------------- */

.tb_listing.tb_grid_view .product-thumb .price {
  top: -80px;
}
.tb_grid_view.tb_product_p_5.tb_exclude_thumb  .product-thumb .price { top: -55px; }
.tb_grid_view.tb_product_p_10.tb_exclude_thumb .product-thumb .price { top: -50px; }
.tb_grid_view.tb_product_p_15.tb_exclude_thumb .product-thumb .price { top: -45px; }
.tb_grid_view.tb_product_p_20.tb_exclude_thumb .product-thumb .price { top: -40px; }
.tb_grid_view.tb_product_p_25.tb_exclude_thumb .product-thumb .price { top: -35px; }
.tb_grid_view.tb_product_p_30.tb_exclude_thumb .product-thumb .price { top: -30px; }
.tb_grid_view.tb_product_p_35.tb_exclude_thumb .product-thumb .price { top: -25px; }
.tb_grid_view.tb_product_p_40.tb_exclude_thumb .product-thumb .price { top:   0px; }
.tb_grid_view.tb_product_p_45.tb_exclude_thumb .product-thumb .price { top:   0px; }
.tb_grid_view.tb_product_p_50.tb_exclude_thumb .product-thumb .price { top:   0px; }

/*  Compact view  ------------------------------------------------------------------------ */

.tb_compact_view .product-thumb .price-regular,
.tb_compact_view .product-thumb .price-new,
.tb_compact_view .product-thumb .price-old
{
  background-color: transparent !important;
}
.tb_compact_view .product-thumb .price-old {
  opacity: 0.5;
}

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