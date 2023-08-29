<?php

/**
 * Plugin Name: AdCombo Integration for WooCommerce
 * Plugin URI: https://naturista.express/
 * Description: Integra WooCommerce con la API de AdCombo.
 * Version: 1.0.4
 * Author: Naturista Express Developers
 * Author URI: https://naturista.express/
 * License: GPL2
 */

// Avoid direct calls to this file
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Verificar si la constante ADCOMBO_API_KEY está definida
if (!defined('ADCOMBO_API_KEY')) {
    add_action('admin_notices', function() {
        $class = 'notice notice-error';
        $message = 'La constante ADCOMBO_API_KEY no está definida. Por favor, define esta constante en tu archivo wp-config.php para que el plugin de AdCombo funcione correctamente.';
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    });
    return; // Termina la ejecución del plugin si la constante no está definida
}

// Activar modo de pruebas por defecto
function adcombo_activate_plugin() {
    add_option('adcombo_test_mode', '0');
}
register_activation_hook(__FILE__, 'adcombo_activate_plugin');

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
        handle_adcombo_api_response( $response, $order, wc_get_product($product_id) );

        // Marcar este producto como procesado
        $processed_products[ $product_id ] = true;
    }
}
add_action( 'woocommerce_order_status_processing', 'process_order_for_adcombo' );

// Incluir los archivos con las funciones
include plugin_dir_path( __FILE__ ) . 'admin/page-admin.php';
include plugin_dir_path( __FILE__ ) . 'inc/get-order-data.php';
include plugin_dir_path( __FILE__ ) . 'inc/send-data.php';