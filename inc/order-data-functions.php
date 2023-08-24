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

    // Obtener el valor del campo personalizado offer_id_adcombo del producto
    $offer_id = get_post_meta( $product->get_id(), 'offer_id_adcombo', true );

    // Obtener el código del país del campo billing_country del pedido
    $country_code = $order->get_billing_country();

    // URL del sitio web
    $base_url = get_site_url();

    // Precio del producto (precio de oferta si existe, de lo contrario precio normal)
    $price = $product->get_sale_price() ? $product->get_sale_price() : $product->get_regular_price();

    // URL pública del producto en la tienda
    $referrer = get_permalink( $product->get_id() );

    // IP del usuario
    $ip = $_SERVER['REMOTE_ADDR'];

    // Construir la dirección en el formato que AdCombo espera
    $address = array(
        'street'        => $order->get_billing_address_1(),
        'street_2'      => $order->get_billing_address_2(),
        'city'          => $order->get_billing_city(),
        'state'         => $order->get_billing_state(),
        'postcode'      => $order->get_billing_postcode(),
    );

    return array(
        // Requiered parameters:
        'api_key'       => ADCOMBO_API_KEY,
        'name'          => $order->get_billing_first_name() . ' ' . $order->get_billing_last_name(),
        'phone'         => $order->get_billing_phone(),
        'offer_id'      => $offer_id,
        'country_code'  => $country_code,
        'base_url'      => $base_url,
        'price'         => $price,
        'referrer'      => $referrer,
        'ip'            => $ip,
        // Extra parameters:
        'ext_in_id'     => $order->get_id(),
        'address'       => json_encode($address), // Codificar la dirección como JSON
        'email'         => $order->get_billing_email(),
        'quantity'      => $item->get_quantity(),
        // Envío de prueba
        'test'          => defined('ADCOMBO_TEST_MODE') && ADCOMBO_TEST_MODE ? 'true' : 'false',
    );
}
