<li id="menu_html_<?php echo $menu_item['data']['id']; ?>" class="tb_menu_html_<?php echo $menu_item['data']['id']; ?><?php if ($menu_item['data']['settings']['dropdown_width_metric'] == '%') echo ' tb_full_menu'; ?> dropdown">
  <span class="tb_toggle tb_bg_str_2"></span>
  <?php if (!empty($menu_item['data']['settings']['url'])): ?>
  <a href="<?php echo $menu_item['data']['settings']['url']; ?>"<?php if (!empty($menu_item['data']['settings']['url_title'])): ?> title="<?php echo $menu_item['data']['settings']['url_title']; ?>"<?php endif; ?> target="<?php echo $menu_item['data']['settings']['target']; ?>">
    <span class="tb_text"><?php echo $menu_icon; ?><?php echo $menu_item['data']['settings']['label']; ?></span>
    <?php if (!empty($menu_item['data']['settings']['accent_text'])): ?>
    <span class="tb_accent_label" style="color: <?php echo $menu_item['data']['settings']['accent_color']; ?>; background-color: <?php echo $menu_item['data']['settings']['accent_bg']; ?>;"><?php echo $menu_item['data']['settings']['accent_text']; ?></span>
    <?php endif; ?>
  </a>
  <?php else: ?>
  <a href="javascript:;">
    <span class="tb_text"><?php echo $menu_icon; ?><?php echo $menu_item['data']['settings']['label']; ?></span>
    <?php echo $accent_label; ?>
  </a>
  <?php endif; ?>
  <div class="dropdown-menu" style="width: <?php echo $menu_item['data']['settings']['dropdown_width']; ?><?php echo $menu_item['data']['settings']['dropdown_width_metric']; ?>">
    <?php echo $menu_item['data']['settings']['html_text']; ?>
  </div>
</li>