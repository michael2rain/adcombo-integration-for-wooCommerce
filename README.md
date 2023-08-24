# WooCommerce AdCombo Integration Plugin

## Descripción

Este plugin integra WooCommerce con la API de AdCombo, permitiendo enviar automáticamente datos de pedidos a AdCombo cuando un pedido cambia su estado a "Procesando". Además, el plugin maneja las respuestas de la API de AdCombo, actualizando el estado del pedido y añadiendo notas relevantes.

## Características

- **Envío automático de pedidos a AdCombo**: Cuando un pedido cambia su estado a "Procesando", los datos del pedido se envían automáticamente a AdCombo.
  
- **Manejo de respuestas de la API**: El plugin maneja tanto respuestas exitosas como errores de la API de AdCombo, y actualiza el estado del pedido en consecuencia.
  
- **Notas del pedido**: Se añaden notas detalladas al pedido en WooCommerce basadas en la respuesta de la API de AdCombo. Esto incluye mensajes de éxito, errores y advertencias.
  
- **Campos personalizados**: El ID del pedido de AdCombo se guarda como un campo personalizado en el pedido de WooCommerce, permitiendo una fácil referencia y seguimiento.

## Instalación

1. Clona o descarga el repositorio en tu directorio de plugins de WordPress (`wp-content/plugins/`).
2. Activa el plugin desde el panel de administración de WordPress.
3. Asegúrate de configurar las opciones necesarias, como la clave API, en la página de configuración del plugin.

## Uso

Una vez instalado y activado, el plugin trabajará automáticamente al detectar cambios de estado en los pedidos de WooCommerce. No es necesario realizar ninguna acción manual para enviar datos a AdCombo.

## Contribuciones

Las contribuciones son bienvenidas. Por favor, crea un "issue" para reportar errores o propuestas, y considera hacer un "pull request" si deseas contribuir con código.

## Licencia

Este plugin está licenciado bajo la licencia GPL v2 o posterior.
