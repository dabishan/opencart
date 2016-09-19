<?php
$slide    = reset($slider['slides']);
$viewport = !empty($slide['viewport']) ? $slide['viewport'] : $slider['viewport'];
$viewport = $viewport == 'fill'    ? 'cover'     : $viewport;
$viewport = $viewport == 'fit'     ? 'contain'   : $viewport;
$viewport = $viewport == 'stretch' ? '100% 100%' : $viewport;
$viewport = $viewport == 'center'  ? 'auto'      : $viewport;
?>

<?php // LOADING BACKGROUND ?>

#<?php echo $uid; ?> .mightySlider.tbLoading {
  background: <?php echo (!empty($slide['bg_color']) ? $slide['bg_color'] : ''); ?> url('<?php echo $slide['cover']; ?>') <?php echo $slide['background_repeat'] ? 'repeat' : 'no-repeat'; ?> center / <?php echo $viewport; ?>;
}

<?php // FIXED WIDTH RESPONSIVE ?>

<?php if ($slider['layout'] == 'fixed' && $slider['autoscale']): ?>
#<?php echo $uid; ?> .mightySlider {
  padding-top: <?php echo $slider['height'] / $slider['width'] * 100; ?>%;
}
#<?php echo $uid; ?> .mightySlider .frame {
  margin-top: -<?php echo $slider['height'] / $slider['width'] * 100; ?>%;
}
<?php endif; ?>

<?php // FIXED WIDTH STATIC ?>

<?php if ($slider['layout'] == 'fixed' && !$slider['autoscale']): ?>
#<?php echo $uid; ?> .mightySlider,
#<?php echo $uid; ?> .mightySlider .frame
{
  height: <?php echo $slider['height']; ?>px;
}
<?php endif; ?>

<?php // FULLWIDTH SLIDER ?>

<?php if ($slider['layout'] == 'fullwidth'): ?>
#<?php echo $uid; ?> {
  max-width: <?php echo $slider['responsive_width']; ?>px;
}
#<?php echo $uid; ?> .mightySlider.fullwidth + .tb_placeholder {
  max-height: <?php echo $slider['height']; ?>px;
  padding-top: <?php echo ($slider['height'] / $slider['responsive_width']) * 100; ?>%;
}
#<?php echo $uid; ?> .mightySlider.fullwidth:not(.scaled) .frame,
#<?php echo $uid; ?> .mightySlider.fullwidth:not(.scaled) + .tb_placeholder
{
  height: <?php echo $slider['height']; ?>px;
}
<?php endif; ?>

<?php // FULLSCREEN SLIDER ?>

<?php if ($slider['layout'] == 'fullscreen'): ?>
#<?php echo $uid; ?> .mightySlider .ms_scene {
  top: 50%;
  left: 50%;
  bottom: auto;
  right: auto;
  width: <?php echo $slider['responsive_width']; ?>px;
  height: <?php echo $slider['responsive_height']; ?>px;
  margin: -<?php echo $slider['responsive_height'] * 0.5; ?>px 0 0 -<?php echo $slider['responsive_width'] * 0.5; ?>px;
}
#<?php echo $uid; ?> {
  <?php if (!empty($slider['min_height'])): ?>
  min-height: <?php echo $slider['min_height']; ?>px;
  <?php endif; ?>
  <?php if (!empty($slider['max_height'])): ?>
  max-height: <?php echo $slider['max_height']; ?>px;
  <?php endif; ?>
}
<?php endif; ?>

<?php // MANUAL SCALING ?>

<?php foreach ($slider['sizes'] as $size): ?>
@media only screen and (max-width: <?php echo $size['max_width']; ?>px) {
  #<?php echo $uid; ?> .mightySlider,
  #<?php echo $uid; ?> .mightySlider .frame
  {
    height: <?php echo $size['height']; ?>px;
  }
}
<?php endforeach; ?>

<?php // SLIDES STYLES ?>

<?php $slide_num = 1; foreach ($slider['slides'] as $slide): ?>
<?php if(!empty($slide['bg_color'])): ?>
#<?php echo $uid . '_slide_' . $slide_num; ?> {
  background-color: <?php echo $slide['bg_color']; ?>;
}
<?php endif; ?>
<?php if (!empty($slide['background_repeat'])): ?>
#<?php echo $uid . '_slide_' . $slide_num; ?> .mSCover {
  background-repeat: repeat;
}
<?php endif; ?>
<?php $layer_num = 1; foreach ($slide['layers'] as $layer): ?>
<?php if ($layer['css_styles']): ?>
#<?php echo $uid . '_slide_' . $slide_num . '_layer_' . $layer_num; ?> {
  <?php if (!$layer['html_width']) echo ' width: auto !important;'; ?>
  <?php echo $layer['css_styles']; ?>
}
#<?php echo $uid . '_slide_' . $slide_num . '_layer_' . $layer_num; ?> * {
  opacity: 1;
}
<?php endif; ?>
<?php $layer_num ++; endforeach; ?>
<?php $slide_num ++; endforeach; ?>

<?php echo $slider['custom_css']; ?>
