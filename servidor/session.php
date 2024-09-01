<?php

const PASS_PHRASE = 'i-amnt-the-best--------------';
function setSessionCookie($id) {
    $id = makeup_data($id);
    $expiracion = time() + (86400 * 30); // La cookie expirará en 30 días
    setcookie('session', $id, $expiracion, "/"); // Crear la cookie*/
};

function makeup_data($data) {
    $method = 'aes-256-cbc'; // Método de cifrado
    $key = hash('sha256', PASS_PHRASE, true); // Derivar una clave de la frase de contraseña
    $iv = openssl_random_pseudo_bytes(16); // Generar un IV aleatorio
    $encrypted = openssl_encrypt($data, $method, $key, 0, $iv); // Cifrar los datos
    return base64_encode($iv . $encrypted); // Combinar IV y texto cifrado, luego codificar en base64
}
function get_data($encryptedData) {
    $method = 'aes-256-cbc'; // Método de cifrado
    $key = hash('sha256', PASS_PHRASE, true); // Derivar la misma clave de la frase de contraseña
    $data = base64_decode($encryptedData); // Decodificar desde base64
    $iv = substr($data, 0, 16); // Extraer el IV de los primeros 16 bytes
    $encrypted = substr($data, 16); // Extraer el texto cifrado
    return openssl_decrypt($encrypted, $method, $key, 0, $iv); // Descifrar los datos
}



