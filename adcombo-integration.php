<?php

/**
 * Plugin Name: AdCombo Integration for WooCommerce - POSTMAN
 * Plugin URI: https://naturista.express/
 * Description: Integra WooCommerce con la API de AdCombo.
 * Version: 1.0.3
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
    function adcombo_admin_notice__error() {
        $class = 'notice notice-error';
        $message = 'La constante ADCOMBO_API_KEY no está definida. Por favor, define esta constante en tu archivo wp-config.php para que el plugin de AdCombo funcione correctamente.';
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }
    add_action('admin_notices', 'adcombo_admin_notice__error');
    return; // Termina la ejecución del plugin si la constante no está definida
}

// Verificar si la constante ADCOMBO_TEST_MODE está definida y es verdadera
if (defined('ADCOMBO_TEST_MODE') && ADCOMBO_TEST_MODE) {
    function adcombo_admin_notice__test_mode() {
        $class = 'notice notice-warning'; // Cambiado a 'notice-warning' para que sea una notificación amarilla (advertencia) en lugar de roja (error)
        $message = 'Estás trabajando en un entorno de pruebas para la integración de AdCombo. No se enviarán datos reales a la API de AdCombo.';
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }
    add_action('admin_notices', 'adcombo_admin_notice__test_mode');
}

// Incluir los archivos con las funciones
include plugin_dir_path( __FILE__ ) . 'inc/api-functions.php';
include plugin_dir_path( __FILE__ ) . 'inc/order-data-functions.php';
include plugin_dir_path( __FILE__ ) . 'inc/order-processing.php';
