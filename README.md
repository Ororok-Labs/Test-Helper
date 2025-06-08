# 🧪 TestHelper by Uriel Olivares

Una mini-librería PHP para facilitar pruebas de salida en consola y HTML durante el desarrollo.
Permite imprimir textos, arreglos, `var_dump`s y mensajes personalizados con formato visual y control de flujo (die/exit).

## 📦 Características principales

-   Impresión en HTML con estilos (`b`, `i`, `u`, tamaño, color)
-   `print_r()` y `var_dump()` con formato personalizado
-   Console logs estilizados desde PHP (log, warn, error, table...)
-   Alertas JS activables desde PHP
-   Caritas rápidas (`=)`, `:c`, `:O`...) para debuggers expresivos
-   Función `🚩 imprimirBandera()` para detener ejecución y mostrar ubicación exacta
-   Saltos de línea, pausas de ejecución, y más

## 🚀 Instalación

Solo incluye el archivo en tu proyecto:

```php
require_once 'TestHelper.php';
```

## 🛠️ Ejemplos de uso

```php
Test::imprimir("Texto en negrita rojo", null, "b", 16, "red");

Test::imprimirArreglo($miArray, null, "iu", 12, "#333");

Test::console("warn", true, "¡Algo sospechoso aquí!", true, "orange", "b", 18, true);

Test::imprimirBandera(); // Detiene el script mostrando archivo y línea actual
```

## 🧙‍♂️ Autor

**Uriel Olivares**
Desarrollador Fullstack apasionado por herramientas simples y efectivas para el debugging.

## 🧾 Licencia

Este código se entrega con licencia MIT. Si quieres usarlo o compartirlo, hazlo con respeto y cariño 💛

---

> _“Las mejores herramientas no son las más complejas, sino las que te salvan cuando el caos acecha.”_
> — Ororok
