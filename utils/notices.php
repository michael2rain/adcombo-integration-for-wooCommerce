<?php

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

if (!defined('ADCOMBO_API_URL')) {
    function adcombo_admin_notice__api_url() {
        $class = 'notice notice-error'; 
        $message = 'La variable ADCOMBO_API_URL no está definida en wp-config.php. Por favor, define esta variable para que la integración con AdCombo funcione correctamente.';
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }
    add_action('admin_notices', 'adcombo_admin_notice__api_url');
    return; // Termina la ejecución del plugin si la constante no está definida
}

// Verificar si la constante ADCOMBO_TEST_MODE está definida y es verdadera
if (defined('ADCOMBO_TEST_MODE') && ADCOMBO_TEST_MODE) {
    function adcombo_admin_notice__test_mode() {
        $class = 'notice notice-warning';
        $message = 'Estás trabajando en un entorno de pruebas para la integración de AdCombo. No se enviarán datos reales a la API de AdCombo.';
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }
    add_action('admin_notices', 'adcombo_admin_notice__test_mode');
}