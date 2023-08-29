<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

// Elimina la opción 'adcombo_test_mode' de la base de datos
delete_option('adcombo_test_mode');

// Elimina la opción 'adcombo_api_url' de la base de datos (si la tienes)
delete_option('adcombo_api_url');