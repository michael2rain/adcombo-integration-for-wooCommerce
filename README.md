# WooCommerce AdCombo Integration Plugin

## Descripción 📌

Este plugin permite una integración fluida entre WooCommerce y la API de AdCombo. Con él, los datos de los pedidos se envían automáticamente a AdCombo tan pronto como un pedido cambie su estado a "Procesando". Además, el plugin se encarga de interpretar y actuar según las respuestas de la API de AdCombo, proporcionando actualizaciones de estado y notas detalladas en los pedidos.

## Características 🌟

- **Envío Automatizado a AdCombo**: Los pedidos se sincronizan con AdCombo automáticamente cuando su estado se actualiza a "Procesando".
- **Gestión Inteligente de Respuestas**: El plugin interpreta las respuestas, ya sean exitosas o contengan errores, y actúa en consecuencia.
- **Notas Detalladas en Pedidos**: Cada respuesta de la API se refleja en las notas del pedido, incluyendo mensajes de éxito, errores y advertencias.
- **Soporte para Pedidos Múltiples**: Si un pedido contiene varios productos, el plugin realiza múltiples llamadas a la API, asegurando que cada producto se procese adecuadamente.

## Instalación 🔧

1. **Descarga y Ubicación**: Clona o descarga este repositorio en tu directorio `wp-content/plugins/` de WordPress.
2. **Activación**: Desde el panel de administración de WordPress, busca el plugin y actívalo.
3. **Configuración**: Define las variables de entorno en tu archivo `wp-config.php`.

### Configuración en `wp-config.php`:

```php
define( 'ADCOMBO_API_URL', '[URL DE LA API]' ); // Ejemplo: "https://api.adcombo.com/api/v2/"
define( 'ADCOMBO_API_KEY', '[TU API KEY]' );
define( 'ADCOMBO_TEST_MODE', true ); // Establece en "true" para modo de prueba, "false" para producción.
```

## Uso 🚀

Después de la instalación y configuración, el plugin se pone en marcha automáticamente. Detectará cambios de estado en los pedidos de WooCommerce y actuará en consecuencia, sin necesidad de intervención manual.

## Contribuciones 🤝

¡Tu ayuda es bienvenida! Si encuentras errores o tienes sugerencias, por favor, crea un "issue". Si estás dispuesto a contribuir con código, considera hacer un "pull request".

## Licencia 📜

Este plugin está bajo la licencia GPL v2 o posterior.
