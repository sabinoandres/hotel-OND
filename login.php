<?php
// Ruta al archivo XML donde se almacenarán los datos
$archivo = 'usuarios.xml';

// Verificamos si el archivo XML existe
if (file_exists($archivo)) {
    // Si existe, lo cargamos en un objeto SimpleXMLElement
    $xml = simplexml_load_file($archivo);
} else {
    // Si no existe, creamos el nodo raíz <usuarios>
    $xml = new SimpleXMLElement('<usuarios/>');
}

// Añadimos un nuevo usuario con los datos del formulario
$usuario = $xml->addChild('usuario');
$usuario->addChild('nombre_completo', $_POST['nombre_completo']);
$usuario->addChild('correo', $_POST['correo']);
$usuario->addChild('nombre_usuario', $_POST['nombre_usuario']);
$usuario->addChild('contrasena', $_POST['contrasena']);  // **No recomendado** almacenar contraseñas en texto plano

// Convertimos el objeto SimpleXMLElement a un objeto DOMDocument para formatearlo correctamente
$dom = new DOMDocument('1.0');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;

// Guardamos los datos del XML con formato bonito
$dom->loadXML($xml->asXML());
$dom->save($archivo);

// Mostramos un mensaje indicando que el registro fue exitoso
echo "<p>Usuario registrado correctamente. <a href='usuarios.xml'>Ver usuarios registrados</a></p>";
?>
