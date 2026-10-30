
<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mensaje = $_POST["mensaje"] ?? "";

    if ($mensaje !== "") {

        // Generar clave y nonce
        $clave = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

        // Cifrar mensaje
        $cifrado = sodium_crypto_secretbox($mensaje, $nonce, $clave);

        // Descifrar mensaje
        $descifrado = sodium_crypto_secretbox_open(
            $cifrado,
            $nonce,
            $clave
        );
    }
}
?>

<h2>Ejemplo de cifrado con Sodium</h2>

<form method="POST">
    <label>Escribe un mensaje:</label>
    <input type="text" name="mensaje" required>
    <button type="submit">Cifrar mensaje</button>
</form>

<?php if (isset($cifrado)): ?>

    <h3>Mensaje original:</h3>
    <p><?= htmlspecialchars($mensaje) ?></p>

    <h3>Mensaje cifrado:</h3>
    <p><?= base64_encode($cifrado) ?></p>

    <h3>Mensaje descifrado:</h3>
    <p><?= htmlspecialchars($descifrado) ?></p>

<?php endif; ?>
