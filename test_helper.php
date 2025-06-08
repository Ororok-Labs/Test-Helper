<?php

/**
 * Mini librería de debugging visual creada para entornos web. Ideal para pruebas, alertas y trazas con estilo.
 * @author Uriel Olivares <urielenoc@gmail.com>
 * @version 1.0.0
 * @license MIT
 */
class Test
{
    public function __construct()
    {
        $this->defaultTextoAnterior     = "";
        $this->defaultArreglo           = null;
        $this->dafaultVarDump           = false;
        $this->defaultTextoPosterior    = "";
        $this->defaultEstilo            = "";
        $this->defaultTamano            = 14;
        $this->defaultColor             = "black";
        $this->defaultParar             = "";
    }

    private function procesarFormato($estilo, $tamano, $color)
    {
        $formato = array(
            "b"     => array(0 => "", 1 => ""),
            "i"     => array(0 => "", 1 => ""),
            "u"     => array(0 => "", 1 => ""),
            "size"  => $this->defaultTamano,
            "color" => $this->defaultColor,
        );

        $bold       = stripos($estilo, "b");
        $italic     = stripos($estilo, "i");
        $underline  = stripos($estilo, "u");

        if ($bold !== false) { //stripos puede retornar 0, por eso no usamos '== true' sino '!== false'
            $formato["b"][0] = "<b>";
            $formato["b"][1] = "</b>";
        }
        if ($italic !== false) { //stripos puede retornar 0, por eso no usamos '== true' sino '!== false'
            $formato["i"][0] = "<i>";
            $formato["i"][1] = "</i>";
        }
        if ($underline !== false) { //stripos puede retornar 0, por eso no usamos '== true' sino '!== false'
            $formato["u"][0] = "<u>";
            $formato["u"][1] = "</u>";
        }

        if (intval($tamano) == true) $formato["size"] = $tamano;

        if ($color != null && $color != "") $formato["color"] = $color;


        return $formato;
    }

    private function imprimirDeBajoNivel($texto_anterior = "", $arreglo = null, $var_dump = false, $texto_posterior = "", $estilo = "", $tamano = "12", $color = "black", $parar = "")
    {
        $formato = $this->procesarFormato($estilo, $tamano, $color);

        echo "<pre style='color: {$formato['color']}; font-size: {$formato['size']}px;'>";
        echo "{$formato['b'][0]}{$formato['i'][0]}{$formato['u'][0]}";

        if ($texto_anterior !== null)                  print($texto_anterior);
        if ($arreglo !== null && $var_dump === false)  print_r($arreglo);
        if ($arreglo !== null && $var_dump === true)   var_dump($arreglo);
        if ($texto_posterior !== null)                 print($texto_posterior);

        echo "{$formato['u'][1]}{$formato['i'][1]}{$formato['b'][1]}";
        echo "</pre>";

        $this->finalizarTest($parar);
    }

    private function finalizarTest($intruccion)
    {
        if ($intruccion == "die" || $intruccion == "exit") die();
    }


    /**
     * Imprime texto y da la posibilidad de darle formato.
     * @param string $texto_anterior Texto a mostrar.
     * @param string $parar Si el código debe detenerse o no. Escribir "die" o "exit" para detenerlo.
     * @param string $estilo Estilo del texto. Coloque 'b' para texto en negrita, 'i' para texto en cursiva y 'u' para texto subrayado. Ej: "b", "ui", "iu", "biu" "bi".
     * @param int $tamano Tamaño en px del texto.
     * @param string $color Color HTML, puede ser en formato hexagecimal o con nombre de color.
     * @return void
     */
    public static function imprimir($texto, $parar = null, $estilo = null, $tamano = null, $color = null)
    {
        $t = new Test();
        $t->imprimirDeBajoNivel($texto, null, false, null, $estilo, $tamano, $color, $parar);
    }

    /**
     * Imprime un arreglo con detalle y da la posibilidad de darle formato.
     * @param array|mixed $arreglo Arreglo a imprimir con detalle. También se puede pasar una variable normal.
     * @param string $parar Si el código debe detenerse o no. Escribir "die" o "exit" para detenerlo.
     * @param string $estilo Estilo del texto. Coloque 'b' para texto en negrita, 'i' para texto en cursiva y 'u' para texto subrayado. Ej: "b", "ui", "iu", "biu" "bi".
     * @param int $tamano Tamaño en px del texto.
     * @param string $color Color HTML, puede ser en formato hexagecimal o con nombre de color.
     * @return void
     */
    public static function imprimirArreglo($arreglo, $parar = null, $estilo = null, $tamano = null, $color = null)
    {
        $t = new Test();
        $t->imprimirDeBajoNivel(null, $arreglo, false, null, $estilo, $tamano, $color, $parar);
    }

    /**
     * Imprime un texto y luego un arreglo con detalle y da la posibilidad de darle formato.
     * @param string $texto_anterior Texto a mostrar.
     * @param array|mixed $arreglo Arreglo a imprimir con detalle. También se puede pasar una variable normal.
     * @param string $parar Si el código debe detenerse o no. Escribir "die" o "exit" para detenerlo.
     * @param string $estilo Estilo del texto. Coloque 'b' para texto en negrita, 'i' para texto en cursiva y 'u' para texto subrayado. Ej: "b", "ui", "iu", "biu" "bi".
     * @param int $tamano Tamaño en px del texto.
     * @param string $color Color HTML, puede ser en formato hexagecimal o con nombre de color.
     * @return void
     */
    public static function imprimirArregloDespuesDeTexto($texto_anterior, $arreglo, $parar = null, $estilo = null, $tamano = null, $color = null)
    {
        $t = new Test();
        $t->imprimirDeBajoNivel($texto_anterior, $arreglo, false, null, $estilo, $tamano, $color, $parar);
    }

    /**
     * Imprime el detalle de un arreglo entre medio de texto y da la posibilidad de darle formato.
     * @param string $texto_anterior Texto a mostrar.
     * @param array|mixed $arreglo Arreglo a imprimir con detalle. También se puede pasar una variable normal.
     * @param string $texto_posterior Texto a mostrar luego de detallar el arreglo.
     * @param string $parar Si el código debe detenerse o no. Escribir "die" o "exit" para detenerlo.
     * @param string $estilo Estilo del texto. Coloque 'b' para texto en negrita, 'i' para texto en cursiva y 'u' para texto subrayado. Ej: "b", "ui", "iu", "biu" "bi".
     * @param int $tamano Tamaño en px del texto.
     * @param string $color Color HTML, puede ser en formato hexagecimal o con nombre de color.
     * @return void
     */
    public static function imprimirArregloEntreTexto($texto_anterior, $arreglo, $texto_posterior = null, $parar = null, $estilo = null, $tamano = null, $color = null)
    {
        $t = new Test();
        $t->imprimirDeBajoNivel($texto_anterior, $arreglo, false, $texto_posterior, $estilo, $tamano, $color, $parar);
    }

    /**
     * Imprime el detalle de un arreglo y luego texto y da la posibilidad de darle formato.
     * @param array|mixed $arreglo Arreglo a imprimir con detalle. También se puede pasar una variable normal.
     * @param string $texto_posterior Texto a mostrar luego de detallar el arreglo.
     * @param string $parar Si el código debe detenerse o no. Escribir "die" o "exit" para detenerlo.
     * @param string $estilo Estilo del texto. Coloque 'b' para texto en negrita, 'i' para texto en cursiva y 'u' para texto subrayado. Ej: "b", "ui", "iu", "biu" "bi".
     * @param int $tamano Tamaño en px del texto.
     * @param string $color Color HTML, puede ser en formato hexagecimal o con nombre de color.
     * @return void
     */
    public static function imprimirArregloLuegoTexto($arreglo, $texto_posterior, $parar = null, $estilo = null, $tamano = null, $color = null)
    {
        $t = new Test();
        $t->imprimirDeBajoNivel(null, $arreglo, false, $texto_posterior, $estilo, $tamano, $color, $parar);
    }

    /**
     * Imprime var_dump y da la posibilidad de darle formato.
     * @param mixed $variable Variable o arreglo a detallarse con var_dump.
     * @param string $parar Si el código debe detenerse o no. Escribir "die" o "exit" para detenerlo.
     * @param string $estilo Estilo del texto. Coloque 'b' para texto en negrita, 'i' para texto en cursiva y 'u' para texto subrayado. Ej: "b", "ui", "iu", "biu" "bi".
     * @param int $tamano Tamaño en px del texto.
     * @param string $color Color HTML, puede ser en formato hexagecimal o con nombre de color.
     * @return void
     */
    public static function imprimirVarDump($variable, $parar = null, $estilo = null, $tamano = null, $color = null)
    {
        $t = new Test();
        $t->imprimirDeBajoNivel(null, $variable, true, null, $estilo, $tamano, $color, $parar);
    }

    /**
     * Imprime una carita (índice del 1 al 5) y da la posibilidad de darle formato.
     * @param mixed $tipo Tipo de carita: 1 o "feliz", 2 o "alegre", 3 o "triste", 4 o "enojada", 5 o "sorprendida"... sino se pasa estos números o textos (o se pasa null) imprime ">_<".
     * @param int $tamano Tamaño en px del texto.
     * @param string $color Color HTML, puede ser en formato hexagecimal o con nombre de color.
     * @return void
     */
    public static function imprimirCarita($tipo = null, $color = "black", $tamano = 14)
    {
        echo "<pre style='color: {$color}; font-size: {$tamano}px;''>";
        switch ($tipo) {
            case 'feliz':
            case 1:
                print("=)");
                break;
            case 'alegre':
            case 2:
                print(":D");
                break;
            case 'triste':
            case 3:
                print(":c");
                break;
            case 'enojada':
            case 4:
                print(">:c");
                break;
            case 'sorprendida':
            case 5:
                print(":O");
                break;
            default:
                print(">_<");
                break;
        }
        echo "</pre>";
    }

    /**
     * Imprime una bandera roja con información del archivo y línea de código donde se coloca, deteniendo la ejecución del código.
     * @return void
     */
    public static function imprimirBandera()
    {
        $backtrace = debug_backtrace();
        $caller = $backtrace[0];

        $file = isset($caller['file']) ? $caller['file'] : 'N/A';
        $line = isset($caller['line']) ? $caller['line'] : 'N/A';

        print("🚩 ");
        die("en el archivo <b>" . $file . "</b>, línea <b>" . $line . "</b>");
    }


    /**
     * Imprime alert con un texto por defecto, sin tener que andar escribiendo las etiquetas. Además ofrece la posibildidad de activarlo o desactivarlo.
     * @param boolean $activar True: muestra el alert, False: ya no lo muestra.
     * @param string $texto Texto a mostrar. null = ¡Alerta!
     * @param boolean $etiquetas True: encierra el alert dentro de etiquetas script, False: no muestra las etiquetas.
     * @return void
     */
    public static function alert($activar = true, $texto = null, $etiquetas = false)
    {
        if ($activar) {
            if ($texto == null) $texto = "¡Alerta!";
            if ($etiquetas) {
                print "<script>alert(`{$texto}`);</script>";
            } else {
                print "alert(`{$texto}`);";
            }
        }
    }

    /**
     * Imprime console.log() con un texto por defecto, sin tener que andar escribiendo las etiquetas. Además ofrece la posibildidad de activarlo o desactivarlo y darle formato.
     * @param string $tipo Tipo de console: log, info, warn, error, table y clear funcionando.
     * @param boolean $activar True: muestra el console.log, False: ya no lo muestra.
     * @param string $texto Texto a mostrar. null = 🚩. En caso de table, el arreglo debe estar entre comillas de texto.
     * @param boolean $etiquetas True: encierra el console.log dentro de etiquetas script, False: no muestra las etiquetas.
     * @param string $estilo Estilo del texto. Coloque 'b' para texto en negrita, 'i' para texto en cursiva y 'u' para texto subrayado. Ej: "b", "ui", "iu", "biu" "bi".
     * @param int $tamano Tamaño en px del texto.
     * @param string $color Color, puede ser en formato hexagecimal o nombre de color HTML.
     * @param boolean $icono True: muestra ícono de bandera, False: no muestra bandera.
     * @return void
     */
    public static function console($tipo = "log", $activar = true, $texto = null, $etiquetas = false, $color = null, $estilo = null, $tamano = null, $icono = false)
    {
        if ($activar) {
            if (
                $tipo != "log" &&
                $tipo != "info" &&
                $tipo != "warn" &&
                $tipo != "error" &&
                $tipo != "debug" &&
                $tipo != "trace" &&
                $tipo != "group" &&
                $tipo != "groupCollapsed" &&
                $tipo != "groupEnd" &&
                $tipo != "table" &&
                $tipo != "time" &&
                $tipo != "timeEnd" &&
                $tipo != "assert" &&
                $tipo != "clear"
            ) {
                $tipo = "log";
            }

            if ($texto === null) {
                $texto  = "🚩";
                $tamano = "30px";
            }

            $color      !== null  ? $color     = "color: {$color};"             : $color = "";
            $tamano     !== null  ? $tamano    = "font-size: {$tamano}px;"      : $tamano = "";
            $icono      !== false ? $icono     = "🚩"                           : $icono = "";

            $bold       = stripos($estilo, "b");
            $italic     = stripos($estilo, "i");
            $underline  = stripos($estilo, "u");

            $bold       !== false ? $bold       = "font-weight: bold;"          : $bold = "";
            $italic     !== false ? $italic     = "font-style: italic;"         : $italic = "";
            $underline  !== false ? $underline  = "text-decoration: underline;" : $underline = "";

            $css = "{$color} {$tamano} {$bold} {$italic} {$underline}";

            if ($tipo == "clear") {
                if ($etiquetas) print "<script>console.clear();</script>";
                else print "console.clear();";
            } elseif ($tipo == "table") {
                if ($etiquetas) print "<script>console.table({$texto});</script>";
                else print "console.table({$texto});";
            } else {
                if ($etiquetas) print "<script>console.{$tipo}(`%c{$icono} {$texto}`,`{$css}`);</script>";
                else print "console.{$tipo}(`%c{$icono} {$texto}`,`{$css}`);";
            }
        }
    }

    /**
     * Imprime saltos de línea.
     * @param int $cantidad Cantidad de saltos de línea a imprimir.
     * @return void
     */
    public static function imprimirSaltosDeLinea($cantidad)
    {
        for ($i = 0; $i < $cantidad; $i++) {
            echo "<br>";
        }
    }

    /**
     * Detiene la ejecución del código. Equivale a die() o exit()
     * @param string $texto Texto a mostrar cuando se detenga la ejecución.
     * @return void
     */
    public static function parar($texto = null)
    {
        die($texto);
    }
}
