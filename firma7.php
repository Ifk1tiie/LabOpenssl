<?php

$mensaje = "";
$firmaBase64 = "";
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mensaje = $_POST["mensaje"] ?? "";

    if (!empty($mensaje)) {

        // Generar un par de claves RSA de 2048 bits
        $config = [
    "config" => "C:/wamp64/bin/apache/apache2.4.65/conf/openssl.cnf",
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
    "private_key_bits" => 2048
];

$clavePrivada = openssl_pkey_new($config);

if ($clavePrivada === false) {
    echo "<h3>Error de OpenSSL:</h3>";

    while ($error = openssl_error_string()) {
        echo htmlspecialchars($error) . "<br>";
    }

    die("No se pudieron generar las claves RSA.");
}

        $clavePrivada = openssl_pkey_new($config);

        if ($clavePrivada === false) {
            die("Error al generar las claves RSA.");
        }

        // Obtener la clave pública
        $detalles = openssl_pkey_get_details($clavePrivada);
        $clavePublica = $detalles["key"];

        // Firmar el mensaje utilizando SHA-256
        openssl_sign(
            $mensaje,
            $firma,
            $clavePrivada,
            OPENSSL_ALGO_SHA256
        );

        // Convertir la firma a Base64
        $firmaBase64 = base64_encode($firma);

        // Verificar la firma digital
        $verificacion = openssl_verify(
            $mensaje,
            $firma,
            $clavePublica,
            OPENSSL_ALGO_SHA256
        );

        if ($verificacion === 1) {
            $resultado = "La firma es válida y los datos son confiables.";
        } else {
            $resultado = "La firma no es válida.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Firma digital con OpenSSL</title>
</head>
<body>

<h2>Generación y verificación de firma digital</h2>

<form method="POST">

    <label>Escribe el mensaje que deseas firmar:</label><br>

    <textarea name="mensaje" required></textarea><br><br>

    <button type="submit">Generar firma digital</button>

</form>

<?php if ($firmaBase64 !== ""): ?>

    <h3>Mensaje original:</h3>
    <p><?php echo htmlspecialchars($mensaje); ?></p>

    <h3>Firma digital (Base64):</h3>
    <p><?php echo htmlspecialchars($firmaBase64); ?></p>

    <h3>Resultado de la verificación:</h3>
    <p><?php echo htmlspecialchars($resultado); ?></p>

<?php endif; ?>

</body>
</html>
