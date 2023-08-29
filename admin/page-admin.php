<?php

/**
 * Página de configuración
 */
function adcombo_register_settings() {
    // Registra las configuraciones
    register_setting('adcombo_settings_group', 'adcombo_api_url');
    register_setting('adcombo_settings_group', 'adcombo_test_mode');

    // Añade la sección
    add_settings_section('adcombo_settings_section', 'Configuración de AdCombo', 'adcombo_settings_section_callback', 'adcombo-settings');

    // Añade los campos
    add_settings_field('adcombo_api_url_field', 'URL de la API de AdCombo', 'adcombo_api_url_field_callback', 'adcombo-settings', 'adcombo_settings_section');
    add_settings_field('adcombo_test_mode_field', 'Modo de Prueba', 'adcombo_test_mode_field_callback', 'adcombo-settings', 'adcombo_settings_section');
}

// Callbacks para la sección y campos
function adcombo_settings_section_callback() {
    echo 'Configura los ajustes de AdCombo a continuación:';
}

// Callback para el campo de la URL
function adcombo_api_url_field_callback() {
    $adcombo_api_url = esc_attr(get_option('adcombo_api_url', ''));
    echo "<input type='url' name='adcombo_api_url' value='$adcombo_api_url' class='regular-text' />";
}

function adcombo_test_mode_field_callback() {
    $adcombo_test_mode = get_option('adcombo_test_mode', '1');  // Usa '1' como valor predeterminado
    $checked = $adcombo_test_mode === '1' ? 'checked' : '';
    echo "<label><input type='checkbox' name='adcombo_test_mode' value='1' $checked /> Activar modo de prueba</label>";
}

// Función para añadir la página de ajustes al menú
function adcombo_create_settings_page() {
    add_options_page('Ajustes de AdCombo', 'AdCombo', 'manage_options', 'adcombo-settings', 'adcombo_settings_page_content');
}

// Contenido de la página de ajustes
function adcombo_settings_page_content() {
    ?>
    <div class="wrap">
        <h1>Ajustes de AdCombo</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('adcombo_settings_group');
            do_settings_sections('adcombo-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Engancha las funciones al cargar WordPress
add_action('admin_init', 'adcombo_register_settings');
add_action('admin_menu', 'adcombo_create_settings_page');

/**
 * Notificación: Entorno de pruebas activado
 */
if (get_option('adcombo_test_mode', '0') === '1') {
    add_action('admin_notices', function() {
        $class = 'notice notice-warning';
        $message = 'Estás trabajando en un entorno de pruebas para la integración de AdCombo. Se indicará a AdCombo que los leads que reciba son de prueba.';
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    });
}