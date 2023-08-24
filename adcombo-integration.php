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

// Verificar variables de entorno
include plugin_dir_path( __FILE__ ) . 'utils/notices.php';

// Incluir los archivos con las funciones
include plugin_dir_path( __FILE__ ) . 'inc/api-functions.php';
include plugin_dir_path( __FILE__ ) . 'inc/order-data-functions.php';
include plugin_dir_path( __FILE__ ) . 'inc/order-processing.php';
