<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Ejemplo de recogida de datos con comprobación (Resultado).
    Recogida de datos. Ejemplos.
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Ejemplo de recogida de datos con comprobación (Resultado)</h1>

<?php
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
    }
    return $tmp;
}

$nombre = recoge("nombre");
$edad   = recoge("edad");
$acepto = recoge("acepto");

$nombreOk = false;
$edadOk   = false;
$aceptoOk = false;

if ($nombre == "") {
    print "  <p class=\"aviso\">No ha escrito su nombre.</p>\n";
    print "\n";
} else {
    $nombreOk = true;
}

if ($edad == "") {
    print "  <p class=\"aviso\">No ha escrito su edad.</p>\n";
    print "\n";
} elseif (!is_numeric($edad)) {
    print "  <p class=\"aviso\">No ha escrito la edad como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($edad)) {
    print "  <p class=\"aviso\">No ha escrito la edad como número entero positivo.</p>\n";
    print "\n";
} elseif ($edad < 1 || $edad > 120) {
    print "  <p class=\"aviso\">La edad no está entre 1 y 120 años.</p>\n";
    print "\n";
} else {
    $edadOk = true;
}

if ($acepto == "") {
    print "  <p class=\"aviso\">No ha indicado si acepta las condiciones.</p>\n";
    print "\n";
} elseif ($acepto != "Sí" && $acepto != "No") {
    print "  <p class=\"aviso\">Por favor, indique si acepta o no las condiciones.</p>\n";
    print "\n";
} else {
    $aceptoOk = true;
}

if ($nombreOk && $edadOk && $aceptoOk) {
    print "  <p>Su nombre es <strong>$nombre</strong>.</p>\n";
    print "\n";
    print "  <p>Su edad es <strong>$edad</strong> años.</p>\n";
    print "\n";
    print "  <p><strong>$acepto</strong> acepta las condiciones.</p>\n";
    print "\n";
}

?>
  <p><a href="ejemplo-recogida-datos-2-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-10-21">21 de octubre de 2019</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="https://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="https://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
