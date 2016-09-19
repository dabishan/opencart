<?php

class Theme_Catalog_TbController extends TB_CatalogController
{
    protected $cart_data;

    public function getProductPrice()
    {
        $product_id = (int) $this->getArrayKey('product_id', $this->request->post, 0);

        if (!$product = $this->getOcModel('catalog/product')->getProduct($product_id)) {
            $this->response->setOutput(json_encode(array('error' => 'Invalid product id#' . $product_id)));

            return;
        }

        $this->saveCartData();

        $cart = $this->engine->getOcCart();
        $cart->clear();

        $quantity     = (int) $this->getArrayKey('quantity', $this->request->post, 1);
        $recurring_id = (int) $this->getArrayKey($this->engine->gteOc2() ? 'recurring_id' : 'profile_id', $this->request->post, 0);
        $option       = array_filter($this->getArrayKey('option', $this->request->post, array()));

        $cart->add($product['product_id'], $quantity, $option, $recurring_id);

        $price = $product['special'] ? $this->tax->calculate($cart->getSubTotal() + ($product['price'] - $product['special']), $product['tax_class_id'], $this->config->get('config_tax')) : $cart->getTotal();

        $result = array(
            'price'    => $this->themeData->priceFormat($this->engine->getOcCurrency()->format($price, $this->themeData->currency_code)),
            'special'  => $this->themeData->priceFormat($this->engine->getOcCurrency()->format($cart->getTotal(), $this->themeData->currency_code)),
            'subtotal' => $this->engine->getOcCurrency()->format($cart->getSubTotal(), $this->themeData->currency_code)
        );

        $cart->clear();
        $this->restoreCartData();

        $this->response->setOutput(json_encode($result));
    }

    protected function saveCartData()
    {
        if (version_compare(VERSION, '2.1.0.0') >= 0) {
            $cart_data = array();

            foreach ($this->engine->getOcCart()->getProducts() as $product) {
                $cart_data[] = array(
                    'product_id'   => $product['product_id'],
                    'quantity'     => $product['quantity'],
                    'option'       => array_column($product['option'], 'product_option_value_id', 'product_option_id'),
                    'recurring_id' => $product['recurring']['recurring_id']
                );
            }
            $this->cart_data = $cart_data;
        } else {
            if (isset($this->session->data['cart'])) {
                $this->cart_data = $this->session->data['cart'];
            }
        }
    }

    protected function restoreCartData()
    {
        if (!$this->cart_data) {
            return;
        }

        if (version_compare(VERSION, '2.1.0.0') >= 0) {
            foreach ($this->cart_data as $data) {
                $this->engine->getOcCart()->add($data['product_id'], $data['quantity'], $data['option'], $data['recurring_id']);
            }
        } else {
            $this->session->data['cart'] = $this->cart_data;
        }
    }

    public function getAreaCss()
    {
        $this->response->setOutput($this->themeData->theme_css_text);
    }
}