<?php

/**
 * Función principal que se engancha al cambio de estado del pedido a "Procesando".
 *
 * @param int $order_id ID del pedido.
 */
function process_order_for_adcombo( $order_id ) {
    $order = wc_get_order( $order_id );

    // Crear un array para rastrear los productos ya procesados
    $processed_products = array();

    foreach ( $order->get_items() as $item ) {
        $product_id = $item->get_product_id();
        $product = wc_get_product($product_id);  // Obtener el producto actual

        // Si el producto ya ha sido procesado, continúa con el siguiente producto
        if ( isset( $processed_products[ $product_id ] ) ) {
            continue;
        }

        // Obtener la cantidad total de este producto en el pedido
        $total_quantity = 0;
        foreach ( $order->get_items() as $inner_item ) {
            if ( $inner_item->get_product_id() === $product_id ) {
                $total_quantity += $inner_item->get_quantity();
            }
        }

        // Actualizar la cantidad en el item antes de enviar los datos
        $item->set_quantity( $total_quantity );

        $order_data = get_order_data_for_adcombo( $order, $item );

        // Enviar los datos a AdCombo y manejar la respuesta
        $response = send_data_to_adcombo_api( $order_data );
        handle_adcombo_api_response( $response, $order, $product );  // Pasar el producto como tercer argumento

        // Marcar este producto como procesado
        $processed_products[ $product_id ] = true;
    }
}
add_action( 'woocommerce_order_status_processing', 'process_order_for_adcombo' );
