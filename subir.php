<?php

// echo '<pre>';
// print_r($_FILES['archivo']);
// echo '<pre>';

$temporal = $_FILES['archivo']['tmp_name'];
$nombre = $_FILES['archivo']['name'];

// move_uploaded_file($temporal, 'imagenes/'.$nombre);


//Abrir la foto original
if ($_FILES['archivo']['type'] == 'image/jpeg') {
    $original = imagecreatefromjpeg($temporal);
} elseif ($_FILES['archivo']['type'] == 'image/png') {
    $original = imagecreatefrompng($temporal);
} else {
    die('no se pudo generar la imagen');
}

$ancho_original = imagesx($original);
$alto_original = imagesy($original);

//Crear lienzo vacio
$ancho_nuevo = 700;
$alto_nuevo = round($ancho_nuevo * $alto_original / $ancho_original);

$copia = imagecreatetruecolor($alto_nuevo, $ancho_nuevo);

//copiar original --->
imagecopyresampled($copia, $original, 0, 0, 0, 0, $alto_nuevo, $alto_nuevo, $ancho_original, $alto_original);

//exportar/guardar imagen
imagejpeg($copia, "imagenes/" . $nombre, 100);

imagedestroy($original);
imagedestroy($copia);
?>