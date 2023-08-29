<?php

/**
 * Recopila los datos del pedido que se enviarán a la API para un producto específico.
 *
 * @param WC_Order $order Objeto del pedido.
 * @param WC_Order_Item_Product $item Elemento del pedido.
 * @return array Datos del pedido.
 */
function get_order_data_for_adcombo( $order, $item ) {
    $product = $item->get_product();

    $offer_id = get_post_meta( $product->get_id(), 'offer_id_adcombo', true );
    $country_code = $order->get_billing_country();
    $base_url = get_site_url();
    $price = $product->get_sale_price() ? $product->get_sale_price() : $product->get_regular_price();
    $referrer = get_permalink( $product->get_id() );
    $ip = $_SERVER['REMOTE_ADDR'];

    // Construir la dirección en el formato que AdCombo espera
    $address = array(
        'street'        => $order->get_billing_address_1(),
        'street_2'      => $order->get_billing_address_2(),
        'city'          => $order->get_billing_city(),
        'state'         => $order->get_billing_state(),
        'postcode'      => $order->get_billing_postcode(),
    );

    $adcombo_test_mode = get_option('adcombo_test_mode', '0');
    return array(
        'api_key'       => ADCOMBO_API_KEY,
        'name'          => $order->get_billing_first_name() . ' ' . $order->get_billing_last_name(),
        'phone'         => $order->get_billing_phone(),
        'offer_id'      => $offer_id,
        'country_code'  => $country_code,
        'base_url'      => $base_url,
        'price'         => $price,
        'referrer'      => $referrer,
        'ip'            => $ip,
        'ext_in_id'     => $order->get_id(),
        'address'       => json_encode($address),
        'email'         => $order->get_billing_email(),
        'quantity'      => $item->get_quantity(),
        'test'          => $adcombo_test_mode === '1' ? 'false' : 'true',
    );
}
