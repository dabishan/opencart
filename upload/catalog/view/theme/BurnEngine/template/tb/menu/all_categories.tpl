<?php // Categories --------------------------------------------------- ?>

<?php $tbData->slotStart('menu_all_categories.categories'); ?>
<ul<?php echo $wrapper_classes; ?>>
  <?php foreach ($categories as $category): ?>
  <?php
  $current_menu_classes  = $level_1_menu_classes;
  $current_menu_classes .= !$is_megamenu && !empty($category['submenu']) ? ' dropdown' : '';
  $current_menu_classes  = !empty($current_menu_classes)  ? ' class="' . trim($current_menu_classes)  . '"' : '';
  ?>
  <li<?php echo $current_menu_classes; ?>>
    <?php if (!empty($category['submenu'])): ?>
    <span class="tb_toggle tb_bg_str_2"></span>
    <?php endif; ?>
    <a<?php echo $level_1_label_classes; ?> href="<?php echo $category['url']; ?>">
      <span class="tb_text"><?php echo $category['name']; ?></span>
    </a>
    <?php if ($settings['category_thumb'] && $is_megamenu): ?>
    <span class="thumbnail">
      <img src="<?php echo $toolImage->resizeImage($category['image'] ? $category['image'] : 'no_image.jpg', $settings['cat_image_size_x'], $settings['cat_image_size_y']); ?>" width="<?php echo $settings['cat_image_size_x']; ?>" height="<?php echo $settings['cat_image_size_y']; ?>" alt="<?php echo $category['name']; ?>" />
    </span>
    <?php endif; ?>
    <?php if (!empty($category['submenu'])): ?>
    <?php echo $category['submenu']; ?>
    <?php endif; ?>
  </li>
  <?php endforeach; ?>
</ul>
<?php $tbData->slotStop(); ?>

<?php // Echo slots -------------------------------------------------- ?>

<li id="menu_all_categories_<?php echo $menu_item_id; ?>"<?php echo $menu_classes; ?>>
  <span class="tb_toggle tb_bg_str_2"></span>
  <a<?php echo $label_classes; ?> href="javascript:;">
    <span class="tb_text"><?php echo $menu_icon; ?><?php echo $settings['label']; ?></span>
    <?php echo $accent_label; ?>
  </a>
  <?php if ($is_megamenu): ?>
  <div class="dropdown-menu">
    <div class="row tb_separate_columns tb_ip_20">
      <div class="col col-xs-12 col-sm-fill">
        <div class="tb_subcategories"><?php $tbData->slotEcho('menu_all_categories.categories'); ?></div>
        <?php if(!empty($manufacturers) && $settings['manufacturers_position'] == 'below'): ?>
        <span class="clear border tb_mt_20 tb_mb_20 tb_ml_-20 tb_mr_-20"></span>
        <?php echo $category_manufacturers; ?>
        <?php endif; ?>
      </div>
      <?php if(!empty($manufacturers) && $settings['manufacturers_position'] == 'column'): ?>
      <div class="col col-xs-12 col-sm-1-5">
        <?php echo $category_manufacturers; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php else: ?>
  <?php $tbData->slotEcho('menu_all_categories.categories'); ?>
  <?php endif; ?>
</li>

<?php if ($is_megamenu): ?>
<?php if ($settings['subcategory_hover_thumb']): ?>
<script>
$("#menu_all_categories_<?php echo $menu_item_id; ?>")
.on("mouseenter", "li[data-thumb]", function() {
    var $image = $(this).closest('li[class~="tb_menu_category"]').find("> .thumbnail img");

    if (!$image.is("[original_src]")) {
      $image.attr("original_src", $image.attr("src"));
    }
    $image.attr("src", $(this).attr("data-thumb"));
})
.on("mouseleave", "li[data-thumb]", function() {
    var $image = $(this).closest('li[class~="tb_menu_category"]').find("> .thumbnail img");

    $image.attr("src", $image.attr("original_src"));
});
</script>
<?php endif; ?>
<script type="text/javascript" data-critical="1">
adjustItemSize('#menu_all_categories_<?php echo $menu_item_id; ?> .tb_subcategories');
</script>
<?php endif; ?>