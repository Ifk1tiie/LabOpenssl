<?php

$configPath = "C:/wamp64/bin/apache/apache2.4.65/conf/openssl.cnf";

// Indicarle a PHP dónde está la configuración de OpenSSL
putenv("OPENSSL_CONF=" . $configPath);

$mensajeResultado = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"] ?? "");
    $organizacion = trim($_POST["organizacion"] ?? "");
    $pais = strtoupper(trim($_POST["pais"] ?? "PA"));
    $localidad = trim($_POST["localidad"] ?? "");
    $correo = trim($_POST["correo"] ?? "");

    if (!is_file($configPath)) {

        $error = "No se encuentra el archivo openssl.cnf.";

    } elseif ($nombre === "" || $organizacion === "" || $correo === "") {

        $error = "Completa los campos obligatorios.";

    } elseif (strlen($pais) !== 2) {

        $error = "El país debe tener dos letras.";

    } else {

        $config = [
            "config" => $configPath,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
            "private_key_bits" => 2048
        ];

        $datos = [
            "countryName" => $pais,
            "localityName" => $localidad,
            "organizationName" => $organizacion,
            "commonName" => $nombre,
            "emailAddress" => $correo
        ];

        $clavePrivada = openssl_pkey_new($config);

        if ($clavePrivada === false) {

            $error = "Error al generar la clave privada.";

        } else {

            $csr = openssl_csr_new($datos, $clavePrivada, $config);

            if ($csr === false) {

                $error = "Error al generar la solicitud CSR.";

            } else {

                $certificado = openssl_csr_sign(
                    $csr,
                    null,
                    $clavePrivada,
                    365,
                    $config
                );

                if ($certificado === false) {

                    $error = "Error al generar el certificado.";

                } else {

                    $carpeta = __DIR__ . "/keysCert";

                    if (!is_dir($carpeta)) {
                        mkdir($carpeta, 0700, true);
                    }

                    $certOK = openssl_x509_export($certificado, $certPem);

                    $csrOK = openssl_csr_export($csr, $csrPem);

                    $privOK = openssl_pkey_export(
                        $clavePrivada,
                        $privPem,
                        null,
                        $config
                    );

                    $detalles = openssl_pkey_get_details($clavePrivada);

                    if (
                        !$certOK ||
                        !$csrOK ||
                        !$privOK ||
                        !isset($detalles["key"])
                    ) {

                        $error = "No se pudieron exportar los archivos.";

                    } else {

                        file_put_contents($carpeta . "/certout.pem", $certPem);
                        file_put_contents($carpeta . "/certout.csr", $csrPem);
                        file_put_contents($carpeta . "/privkey.pem", $privPem);
                        file_put_contents($carpeta . "/publickey.pem", $detalles["key"]);

                        @chmod($carpeta . "/privkey.pem", 0600);

                        $mensajeResultado = "Certificado generado correctamente. Los archivos fueron guardados en keysCert.";
                    }
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
    <title>Generación de certificado digital</title>
</head>
<body>

<h2>Generación de certificado digital</h2>

<form method="POST">

    <label>Nombre común:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Organización:</label><br>
    <input type="text" name="organizacion" required><br><br>

    <label>País:</label><br>
    <input type="text" name="pais" value="PA" maxlength="2" required><br><br>

    <label>Localidad:</label><br>
    <input type="text" name="localidad"><br><br>

    <label>Correo electrónico:</label><br>
    <input type="email" name="correo" required><br><br>

    <button type="submit">Generar certificado</button>

</form>

<?php if ($error !== ""): ?>
    <h3>Error:</h3>
    <p><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<?php if ($mensajeResultado !== ""): ?>
    <h3><?php echo htmlspecialchars($mensajeResultado); ?></h3>
<?php endif; ?>

</body>
</html>
