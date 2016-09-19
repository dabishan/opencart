<?php

return array(
    'oc_image_dimensions' => array(
        'config_image_category_width'  => 150,
        'config_image_category_height' => 150,
        'config_image_thumb_width'     => 525,
        'config_image_thumb_height'    => 600,
        'config_image_popup_width'     => 875,
        'config_image_popup_height'    => 1200
    ),
    'builder_defaults'      => array(
        'content' => array(
            'rows' => array(
                0 => array(
                    'columns' => array(
                        0 => array(
                            'grid_proportion' => '1_1',
                            'widgets' => array(
                                0 => array(
                                    'label'    => 'Breadcrumbs',
                                    'slot'     => 'breadcrumbs',
                                    'class'    => 'Theme_BreadcrumbsSystemWidget',
                                    'settings' => array()
                                ),
                                1 => array(
                                    'label'    => 'Page Title',
                                    'slot'     => 'page_title',
                                    'class'    => 'Theme_PageTitleSystemWidget',
                                    'settings' => array()
                                )
                            )
                        )
                    ),
                    'settings' => array()
                ),
                1 => array(
                    'columns' => array(
                        0 => array(
                            'grid_proportion' => '1_1',
                            'widgets' => array(
                                0 => array(
                                    'label'    => 'Page Content',
                                    'slot'     => 'page_content',
                                    'settings' => array()
                                )
                            )
                        )
                    ),
                    'settings' => array(
                        'layout'     => array(
                            'margin_bottom'  => 0,
                        )
                    )
                )
            )
        )
    ),
    'colors' => array(
        'area'  => array(
            'area_content' => array(
                'body' => array(
                    'page_title' => array(
                        'label'       => 'Page title',
                        'elements'    => '
                            .tb_system_page_title > h1
                        ',
                        'property'      => 'color',
                        'color'         => '#333333',
                        'important'     => 0,
                        'force_print'   => 0,
                        'can_inherit'   => 1,
                        'inherit'       => 1,
                        'inherit_key'   => 'area:body.titles',
                    ),
                    'breadcrumbs_text' => array(
                        'label'       => 'Breadcrumbs text',
                        'elements'    => '
                            .tb_system_breadcrumbs
                        ',
                        'property'      => 'color',
                        'color'         => '#333333',
                        'important'     => 0,
                        'force_print'   => 0,
                        'can_inherit'   => 1,
                        'inherit'       => 1,
                        'inherit_key'   => 'area:body.text',
                    ),
                    'breadcrumbs_links' => array(
                        'label'       => 'Breadcrumbs links ',
                        'elements'    => '
                            .tb_system_breadcrumbs a:not(:hover)
                        ',
                        'property'      => 'color',
                        'color'         => '#333333',
                        'important'     => 0,
                        'force_print'   => 0,
                        'can_inherit'   => 1,
                        'inherit'       => 1,
                        'inherit_key'   => 'area:body.links',
                    ),
                    'breadcrumbs_links_hover' => array(
                        'label'       => 'Breadcrumbs links (hover)',
                        'elements'    => '
                            .tb_system_page_title a:hover
                        ',
                        'property'      => 'color',
                        'color'         => '#b92616',
                        'important'     => 0,
                        'force_print'   => 0,
                        'can_inherit'   => 1,
                        'inherit'       => 1,
                        'inherit_key'   => 'area:body.links_hover',
                    ),
                ),
            ),
        )
    ),
    'copyright' => '&copy; Copyright 2014-' . date('Y') . '. Powered by <a href="http://www.opencart.com">Open Cart</a>.</span> <br /> <a class="tb_main_color" href="http://www.pavilion-theme.com">Pavilion theme</a> made by <a href="http://www.themeburn.com">ThemeBurn.com</a>'
);