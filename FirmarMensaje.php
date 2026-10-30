<?php

$mensaje = "";
$firmaBase64 = "";
$resultado = "";
$error = "";

$rutaPrivada = __DIR__ . "/keysCert/privkey.pem";
$rutaCertificado = __DIR__ . "/keysCert/certout.pem";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mensaje = trim($_POST["mensaje"] ?? "");

    if ($mensaje === "") {

        $error = "Debes escribir un mensaje.";

    } elseif (!file_exists($rutaPrivada) || !file_exists($rutaCertificado)) {

        $error = "Primero ejecuta firmaOtra.php para generar el certificado.";

    } else {

        // Leer archivos
        $privadaPem = file_get_contents($rutaPrivada);
        $certPem = file_get_contents($rutaCertificado);

        // Cargar clave privada
        $clavePrivada = openssl_pkey_get_private($privadaPem);

        // Cargar certificado
        $certificado = openssl_x509_read($certPem);

        if ($certificado !== false) {
            $clavePublica = openssl_pkey_get_public($certificado);
        } else {
            $clavePublica = false;
        }

        if ($clavePrivada === false || $clavePublica === false) {

            $error = "No se pudieron cargar las claves.<br>";

            while ($e = openssl_error_string()) {
                $error .= htmlspecialchars($e) . "<br>";
            }

        } else {

            // Firmar mensaje
            if (openssl_sign($mensaje, $firma, $clavePrivada, OPENSSL_ALGO_SHA256)) {

                $firmaBase64 = base64_encode($firma);

                // Verificar firma
                $verificacion = openssl_verify(
                    $mensaje,
                    $firma,
                    $clavePublica,
                    OPENSSL_ALGO_SHA256
                );

                if ($verificacion === 1) {
                    $resultado = "La firma es válida. El mensaje es auténtico.";
                } elseif ($verificacion === 0) {
                    $resultado = "La firma no es válida.";
                } else {
                    $resultado = "Error durante la verificación.";
                }

            } else {

                $error = "No se pudo generar la firma.<br>";

                while ($e = openssl_error_string()) {
                    $error .= htmlspecialchars($e) . "<br>";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Firma de Mensajes</title>
</head>
<body>

<h2>Firma y verificación de mensajes</h2>

<form method="POST">

    <label>Escribe el mensaje:</label><br>

    <textarea name="mensaje" rows="4" cols="60" required><?php echo htmlspecialchars($mensaje); ?></textarea><br><br>

    <button type="submit">Firmar mensaje</button>

</form>

<?php if ($error !== ""): ?>

    <h3>Error</h3>
    <p><?php echo $error; ?></p>

<?php endif; ?>

<?php if ($firmaBase64 !== ""): ?>

    <h3>Mensaje original</h3>
    <p><?php echo htmlspecialchars($mensaje); ?></p>

    <h3>Firma digital (Base64)</h3>
    <p><?php echo htmlspecialchars($firmaBase64); ?></p>

    <h3>Resultado de la verificación</h3>
    <p><?php echo htmlspecialchars($resultado); ?></p>

<?php endif; ?>

</body>
</html>