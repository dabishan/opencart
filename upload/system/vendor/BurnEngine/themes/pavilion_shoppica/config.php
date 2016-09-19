<?php

return array(
    'oc_image_dimensions' => array(
        'thumb_width'       => 700,
        'thumb_height'      => 800,
        'popup_width'       => 1050,
        'popup_height'      => 1200,
        'additional_width'  => 70,
        'additional_height' => 70,
        'compare_width'     => 90,
        'compare_height'    => 90,
        'wishlist_width'    => 50,
        'wishlist_height'   => 50,
        'cart_width'        => 50,
        'cart_height'       => 50,
        'location_width'    => 250,
        'location_height'   => 50,
        'category_width'    => 150,
        'category_height'   => 150,
        'product_width'     => 220,
        'product_height'    => 220,
        'related_width'     => 80,
        'related_height'    => 80
    ),
    'colors' => array(
        'inherit_menu' => array(
            1 => array(
                'inherit_key' => 'theme:main.secondary'
            )
        ),
        'theme' => array(
            'main' => array(
                'secondary' => array(
                    'label'       => 'Secondary',
                    'elements'    => '
                        .tb_secondary_color,
                        .tb_hover_secondary_color:hover
                    ',
                    'property'      => 'color',
                    'color'         => '#f12b63',
                    'important'     => 1,
                    'force_print'   => 0,
                    'can_inherit'   => 0,
                    'inherit'       => 0,
                    'inherit_key'   => '',
                    'render_before' => 'text',
                ),
            ),
            'product_listing' => array(
                'product_price_bg' => array(
                    'label'       => 'Price bg',
                    'elements'    => '
                        :not(.tb_item_info_hover) .product-thumb .price-regular
                    ',
                    'property'    => 'background-color',
                    'color'       => '#4cb1ca',
                    'important'   => 0,
                    'force_print' => 1,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'main.accent'
                ),
                'product_promo_price_bg' => array(
                    'label'       => 'Promo price bg',
                    'elements'    => '
                        :not(.tb_item_info_hover) .product-thumb .price .price-new
                    ',
                    'property'    => 'background-color',
                    'color'       => '#f12b63',
                    'important'   => 0,
                    'force_print' => 1,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'main.secondary'
                ),
                'product_price_compact_hidden_color' => array(
                    'label'       => 'Price bg',
                    'elements'    => '
                        .tb_compact_view .product-thumb .price-regular
                    ',
                    'property'    => 'color',
                    'color'       => '#4cb1ca',
                    'important'   => 0,
                    'force_print' => 1,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'product_listing.product_price_bg'
                ),
                'product_promo_price_compact_hidden_color' => array(
                    'label'       => 'Promo price bg',
                    'elements'    => '
                        .tb_compact_view .product-thumb .price .price-new
                    ',
                    'property'    => 'color',
                    'color'       => '#f12b63',
                    'important'   => 0,
                    'force_print' => 1,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'product_listing.product_promo_price_bg'
                )
            ),
            'product_listing_hover' => array(
                'product_price_bg' => array(
                    'label'       => 'Price bg',
                    'elements'    => '
                        .tb_item_info_hover .product-thumb .price-regular
                    ',
                    'property'    => 'background-color',
                    'color'       => '#4cb1ca',
                    'important'   => 0,
                    'force_print' => 0,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'product_listing.product_price_bg'
                ),
                'product_promo_price_bg' => array(
                    'label'       => 'Promo price bg',
                    'elements'    => '
                        .tb_item_info_hover .product-thumb .price .price-new
                    ',
                    'property'    => 'background-color',
                    'color'       => '#f12b63',
                    'important'   => 0,
                    'force_print' => 0,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'product_listing.product_promo_price_bg'
                )
            ),
        ),
        'products_system_widget' => array(
            'product_listing' => array(
                'product_price_bg' => array(
                    'label'       => 'Price bg',
                    'elements'    => '
                        :not(.tb_item_info_hover) .product-thumb .price-regular
                    ',
                    'property'    => 'background-color',
                    'color'       => '#4cb1ca',
                    'important'   => 0,
                    'force_print' => 0,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'theme:product_listing.product_price_bg'
                ),
                'product_promo_price_bg' => array(
                    'label'       => 'Promo price bg',
                    'elements'    => '
                        :not(.tb_item_info_hover) .product-thumb .price .price-new
                    ',
                    'property'    => 'background-color',
                    'color'       => '#f12b63',
                    'important'   => 0,
                    'force_print' => 0,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'theme:product_listing.product_promo_price_bg'
                ),
                'product_price_compact_hidden_color' => array(
                    'label'       => 'Price bg',
                    'elements'    => '
                        .tb_compact_view .product-thumb .price-regular
                    ',
                    'property'    => 'color',
                    'color'       => '#4cb1ca',
                    'important'   => 0,
                    'force_print' => 1,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'product_listing.product_price_bg'
                ),
                'product_promo_price_compact_hidden_color' => array(
                    'label'       => 'Promo price bg',
                    'elements'    => '
                        .tb_compact_view .product-thumb .price .price-new
                    ',
                    'property'    => 'color',
                    'color'       => '#f12b63',
                    'important'   => 0,
                    'force_print' => 1,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'product_listing.product_promo_price_bg'
                )
            ),
            'product_listing_hover' => array(
                'product_price_bg' => array(
                    'label'       => 'Price bg',
                    'elements'    => '
                        .tb_item_info_hover .product-thumb .price-regular
                    ',
                    'property'    => 'background-color',
                    'color'       => '#4cb1ca',
                    'important'   => 0,
                    'force_print' => 0,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'theme:product_listing_hover.product_price_bg'
                ),
                'product_promo_price_bg' => array(
                    'label'       => 'Promo price bg',
                    'elements'    => '
                        .tb_item_info_hover .product-thumb .price .price-new
                    ',
                    'property'    => 'background-color',
                    'color'       => '#f12b63',
                    'important'   => 0,
                    'force_print' => 0,
                    'can_inherit' => 1,
                    'inherit'     => 1,
                    'inherit_key' => 'theme:product_listing_hover.product_promo_price_bg'
                )
            ),
        ),
        'presets' => array(
            'products' => array(
                'product_listing' => array(
                    'product_price_bg' => array(
                        'label'       => 'Price bg',
                        'elements'    => '
                            :not(.tb_item_info_hover) .product-thumb .price-regular
                        ',
                        'property'    => 'background-color',
                        'color'       => '#4cb1ca',
                        'important'   => 0,
                        'force_print' => 0,
                        'can_inherit' => 1,
                        'inherit'     => 1,
                        'inherit_key' => 'theme:product_listing.product_price_bg'
                    ),
                    'product_promo_price_bg' => array(
                        'label'       => 'Promo price bg',
                        'elements'    => '
                            :not(.tb_item_info_hover) .product-thumb .price .price-new
                        ',
                        'property'    => 'background-color',
                        'color'       => '#f12b63',
                        'important'   => 0,
                        'force_print' => 0,
                        'can_inherit' => 1,
                        'inherit'     => 1,
                        'inherit_key' => 'theme:product_listing.product_promo_price_bg'
                    ),
                    'product_price_compact_hidden_color' => array(
                        'label'       => 'Price bg',
                        'elements'    => '
                            .tb_compact_view .product-thumb .price-regular
                        ',
                        'property'    => 'color',
                        'color'       => '#4cb1ca',
                        'important'   => 0,
                        'force_print' => 1,
                        'can_inherit' => 1,
                        'inherit'     => 1,
                        'inherit_key' => 'product_listing.product_price_bg'
                    ),
                    'product_promo_price_compact_hidden_color' => array(
                        'label'       => 'Promo price bg',
                        'elements'    => '
                            .tb_compact_view .product-thumb .price .price-new
                        ',
                        'property'    => 'color',
                        'color'       => '#f12b63',
                        'important'   => 0,
                        'force_print' => 1,
                        'can_inherit' => 1,
                        'inherit'     => 1,
                        'inherit_key' => 'product_listing.product_promo_price_bg'
                    )
                ),
                'product_listing_hover' => array(
                    'product_price_bg' => array(
                        'label'       => 'Price bg',
                        'elements'    => '
                            .tb_item_info_hover .product-thumb .price-regular
                        ',
                        'property'    => 'background-color',
                        'color'       => '#4cb1ca',
                        'important'   => 0,
                        'force_print' => 0,
                        'can_inherit' => 1,
                        'inherit'     => 1,
                        'inherit_key' => 'theme:product_listing_hover.product_price_bg'
                    ),
                    'product_promo_price_bg' => array(
                        'label'       => 'Promo price bg',
                        'elements'    => '
                            .tb_item_info_hover .product-thumb .price .price-new
                        ',
                        'property'    => 'background-color',
                        'color'       => '#f12b63',
                        'important'   => 0,
                        'force_print' => 0,
                        'can_inherit' => 1,
                        'inherit'     => 1,
                        'inherit_key' => 'theme:product_listing_hover.product_promo_price_bg'
                    )
                ),
            )
        )
    ),
    'copyright' => '&copy; Copyright 2014-' . date('Y') . '. Powered by <a href="http://www.opencart.com">Open Cart</a>.</span> <br /> <a class="tb_main_color" href="http://www.pavilion-theme.com">Pavilion theme</a> made by <a href="http://www.themeburn.com">ThemeBurn.com</a>'
);