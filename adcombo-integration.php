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
    add_option('adcombo_test_mode', '1');  // Establece el modo de prueba en verdadero por defecto
}
register_activation_hook(__FILE__, 'adcombo_activate_plugin');

// Incluir los archivos con las funciones
include plugin_dir_path( __FILE__ ) . 'admin/api-config.php';
include plugin_dir_path( __FILE__ ) . 'inc/api-functions.php';
include plugin_dir_path( __FILE__ ) . 'inc/order-data-functions.php';
include plugin_dir_path( __FILE__ ) . 'inc/order-processing.php';