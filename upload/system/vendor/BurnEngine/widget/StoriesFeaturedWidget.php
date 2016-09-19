<?php

class Theme_StoriesFeaturedWidget extends TB_Widget
{
    protected $areas = array('footer', 'intro', 'content', 'column_left', 'column_right');

    public function onFilter(array &$settings)
    {
        $langVars = array(
            'is_active'        => 1,
            'title'            => 'Featured Stories',
            'title_icon'       => '',
            'title_icon_size'  => 100,
            'title_align'      => 'left'
        );
        $settings = array_replace($settings, $this->initLangVars($langVars, $settings));

        $default_vars = array(
            'filter_randomize'    => 0,
            'show_thumb'          => 1,
            'show_text'           => 1,
            'show_tags'           => 1,
            'show_date'           => 1,
            'show_comments'       => 1,
            'image_size_x'        => 80,
            'image_size_y'        => 80,
            'text_limit'          => 100,
            'slider'              => 0,
            'slider_step'         => 1,
            'slider_speed'        => 500,
            'slider_pagination'   => 0,
            'slider_nav_position' => 'top',
            'slider_autoplay'     => 0,
            'slider_loop'         => 0,
            'story_ids' => array()
        );
        $settings = array_replace($settings, $this->initFlatVars($default_vars, $settings));
    }

    public function onEdit(array &$settings)
    {
        $settings['tags_names'] = array();
        $tags = $this->getOcModel('stories/tag')->getAll();

        $tags_names = array();
        foreach ($tags as $tag) {
            $tags_names[] = $tag['name'];
        }

        if ($tags_names) {
            $settings['tags_names'] = '"' . implode('","', $tags_names) . '"';
        }
    }

    public function hasArea($name)
    {
        if (!$this->engine->getOcConfig('stories_settings')) {
            return false;
        }

        return parent::hasArea($name);
    }

    public function isActive()
    {
        if (!$this->engine->getOcConfig('stories_settings')) {
            return false;
        }

        return parent::isActive();
    }

    public function initFrontend()
    {
        $this->engine->getEventDispatcher()->connect('core:assignAssets', array($this, 'assignAssets'));
    }

    public function assignAssets()
    {
        $main_settings = $this->engine->getOcConfig()->get('stories_settings');

        if ($this->settings['slider']) {
            $this->themeData->registerJavascriptResource('javascript/swiper.min.js');
        }

        if ($this->settings['show_comments'] && $main_settings['comments'] == 'disqus') {
            $this->engine->getThemeExtension()->addJsContents('<script type="text/javascript">
            var disqus_shortname = \'' . $main_settings['disqus_shortname'] . '\';
            (function () {
            var s = document.createElement(\'script\'); s.async = true;
            s.type = \'text/javascript\';
            s.src = \'//\' + disqus_shortname + \'.disqus.com/count.js\';
            (document.getElementsByTagName(\'HEAD\')[0] || document.getElementsByTagName(\'BODY\')[0]).appendChild(s);
            }());
            </script>', 'disqus_show_comments');
        }
    }

    public function render(array $view_data = array())
    {
        if (empty($this->settings['story_ids'])) {
            return '';
        }

        $view_data['main_settings'] = $this->engine->getOcConfig()->get('stories_settings');
        $view_data['slider']        = $this->settings['slider'];
        $view_data['slider_step']   = $this->settings['slider_step'];
        $view_data['stories']       = $this->getStoryListing();

        return parent::render($view_data);
    }

    public function getStoryIds()
    {
        return $this->settings['story_ids'];
    }

    protected function getStoryListing()
    {
        $stories = $this->getOcModel('stories/index')->getStories(array(
            'filter_story_ids'    => $this->settings['story_ids'],
            'filter_sticky_first' => true
        ));

        foreach ($stories as &$story) {
            if (!empty($story['teaser'])) {
                $description = strip_tags(html_entity_decode($story['teaser'], ENT_COMPAT, 'UTF-8'));
                $description = strlen($description) > $this->settings['text_limit'] ? substr($description, 0, $this->settings['text_limit']) . '...' : $description;
            } else {
                $description = strip_tags(html_entity_decode($story['description'], ENT_COMPAT, 'UTF-8'));
                $description = strlen($description) > $this->settings['text_limit'] ? substr($description, 0, $this->settings['text_limit']) . '...' : $description;
            }
            $story['description'] = $description;

            $story['thumb'] = '';
            if ($story['image']) {
                $story['thumb'] = $this->getOcModel('stories/index')->resizeImageAdvanced($story['image'], $this->settings['image_size_x'], $this->settings['image_size_y'], 'crop');
                $story['thumb_width'] = $this->settings['image_size_x'];
                $story['thumb_height'] = $this->settings['image_size_y'];
            }

            $tags = array();
            if (trim($story['tags'])) {
                foreach (explode('!*!', $story['tags']) as $tag) {
                    list($name, $tag_id) = explode('<=>', $tag);
                    $tags[] = array(
                        'name' => $name,
                        'url'   => $this->engine->getOcUrl()->link('stories/tag', 'story_tag_id=' . $tag_id)
                    );
                }
            }

            $default_lang = $this->engine->loadOcTranslation();

            $story['date_added'] = date($default_lang['date_format_short'], strtotime($story['date_added']));
            $story['date_month'] = date('M');
            $story['date_year']  = date('Y');
            $story['date_day']   = date('d');
            $story['tags']       = $tags;
            $story['url']        = $this->engine->getOcUrl()->link('stories/show', 'story_id=' . $story['story_id']);
        }

        if ($this->settings['filter_randomize']) {
            shuffle($stories);
        }

        return $stories;
    }

    protected function getBoxClasses()
    {
        $classes = parent::getBoxClasses();
        $slider  = $this->settings['slider'];

        $classes .= !$this->getLangTitle() ? ' no_title' : '';
        $classes .= $slider ? ' has_slider' : '';
        $classes .= $slider && $this->settings['slider_nav_position'] != 'side' ? ' tb_top_nav'  : '';
        $classes .= $slider && $this->settings['slider_nav_position'] == 'side' ? ' tb_side_nav' : '';

        return $classes;
    }

    public function buildStyles(TB_StyleBuilder $styleBuilder)
    {
        $position     = $this->themeData['language_direction'] == 'ltr' ? 'left'  : 'right';
        $position_inv = $this->themeData['language_direction'] == 'ltr' ? 'right' : 'left' ;
        $font_size    = $this->themeData->fonts['body']['size'];
        $font_base    = $this->themeData->fonts['body']['line-height'];
        $title_size   = $this->settings['box_styles']['font'][$this->language_code]['article_title']['size'];
        $title_height = $this->themeData->calculateLineHeight($title_size, $font_base);
        $settings     = $this->settings;
        $css          = '';

        if ($title_size > $font_size + 1) {
            $css .= '#' . $this->getDomId() . ' .tb_compact_view h4 {';
            $css .= '  margin-bottom: '  . ($font_base * 0.5) . 'px;';
            $css .= '}';
        }
        if ($settings['image_size_x'] > 150 && $settings['image_size_x'] < 400) {
            $css .= '#' . $this->getDomId() . ' .tb_compact_view .tb_item_info {';
            $css .= '  margin-' . $position . ': '  . $font_base . 'px;';
            $css .= '}';
        }

        $styleBuilder->addCss($css);
    }

    public function getDefaultBoxFonts()
    {
        return array(
            'article_title' => array(
                'section_name'      => 'Article Title',
                'elements'          => '.tb_item h4',
                'type'              => '',
                'family'            => 'inherit',
                'subsets'           => '',
                'variant'           => '',
                'size'              => 13,
                'line-height'       => 20,
                'letter-spacing'    => '',
                'word-spacing'      => '',
                'transform'         => '',
                'has_size'          => true,
                'has_line_height'   => true,
                'has_spacing'       => false,
                'has_effects'       => false,
                'show_built_styles' => false,
                'multiple_variants' => true,
                'built-in'          => true,
                'can_inherit'       => true,
                'css_weight'        => '',
                'css_style'         => ''
            ),
        );
    }

    public function getDefaultBoxColors()
    {
        $default_colors = array(
            'body' => array(
                '_label' => 'Articles',
                'links' => array(
                    'label'       => 'Article title',
                    'elements'    => 'h4 a:not(:hover)',
                    'property'    => 'color',
                    'color'       => '#333333',
                    'important'   => 0,
                    'force_print' => 0,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'column:body.links'
                ),
                'links_hover' => array(
                    'label'       => 'Article title (hover)',
                    'elements'    => 'h4 a:hover',
                    'property'    => 'color',
                    'color'       => '#b92616',
                    'important'   => 0,
                    'force_print' => 1,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'column:body.links_hover'
                ),
                'text' => array(
                    'label'       => 'Summary',
                    'elements'    => '.tb_description',
                    'property'    => 'color',
                    'color'       => '#333333',
                    'important'   => 0,
                    'force_print' => 0,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'column:body.text'
                ),
                'meta_text' => array(
                    'label'       => 'Meta text',
                    'elements'    => '.tb_meta',
                    'property'    => 'color',
                    'color'       => '#333333',
                    'important'   => 0,
                    'force_print' => 0,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'column:body.text'
                ),
                'meta_links' => array(
                    'label'       => 'Meta links',
                    'elements'    => '.tb_meta a:not(:hover)',
                    'property'    => 'color',
                    'color'       => '#333333',
                    'important'   => 0,
                    'force_print' => 0,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'column:body.links'
                ),
                'meta_links_hover' => array(
                    'label'       => 'Meta links (hover)',
                    'elements'    => '.tb_meta a:hover',
                    'property'    => 'color',
                    'color'       => '#b92616',
                    'important'   => 0,
                    'force_print' => 0,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'column:body.links_hover'
                ),
                'meta_icons' => array(
                    'label'       => 'Meta icons',
                    'elements'    => '.tb_meta .fa',
                    'property'    => 'color',
                    'color'       => '#cccccc',
                    'important'   => 0,
                    'force_print' => 0,
                    'can_inherit' => 0,
                    'inherit'     => 0,
                    'inherit_key' => ''
                )
            )
        );

        return $default_colors;
    }

}