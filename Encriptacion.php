<?php
$mensaje = "";
$cifrado = "";
$descifrado = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mensaje = $_POST["mensaje"] ?? "";

    if (!empty($mensaje)) {

        $metodo = "AES-128-CBC";
        $clave = "clave123456789012";

        $iv = openssl_random_pseudo_bytes(
            openssl_cipher_iv_length($metodo)
        );

        $cifrado = openssl_encrypt(
            $mensaje,
            $metodo,
            $clave,
            0,
            $iv
        );

        $descifrado = openssl_decrypt(
            $cifrado,
            $metodo,
            $clave,
            0,
            $iv
        );
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Encriptación con OpenSSL</title>
</head>
<body>

<h2>Encriptación y desencriptación con OpenSSL</h2>

<form method="POST">
    <label>Escribe el mensaje:</label><br>
    <textarea name="mensaje" required></textarea><br><br>

    <button type="submit">Encriptar mensaje</button>
</form>

<?php if ($cifrado !== ""): ?>

    <h3>Resultado del cifrado:</h3>
    <p><?php echo htmlspecialchars($cifrado); ?></p>

    <h3>Resultado del descifrado:</h3>
    <p><?php echo htmlspecialchars($descifrado); ?></p>

<?php endif; ?>

</body>
</html>


