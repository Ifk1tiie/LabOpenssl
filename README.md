# 🔐 Laboratorio OpenSSL y Sodium en PHP

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.3.28-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/OpenSSL-3.5.1-721412?style=for-the-badge&logo=openssl&logoColor=white" alt="OpenSSL">
  <img src="https://img.shields.io/badge/Sodium-Cryptography-4B6F44?style=for-the-badge" alt="Sodium">
  <img src="https://img.shields.io/badge/Server-WampServer-8A2BE2?style=for-the-badge" alt="WampServer">
</p>

<p align="center">
  **Implementación y documentación de funciones criptográficas mediante PHP, OpenSSL y Sodium.**
</p>

---

## 📌 1. Descripción del proyecto

Este repositorio contiene el desarrollo del laboratorio de implementación y documentación de funciones criptográficas utilizando PHP, OpenSSL y Sodium.

Durante esta actividad se realizaron diferentes procedimientos relacionados con la seguridad de la información, incluyendo cifrado y descifrado de mensajes, generación y verificación de firmas digitales, creación de certificados digitales y utilización de funciones criptográficas de Sodium.

El proyecto fue desarrollado en un entorno local mediante WampServer, utilizando PHP como lenguaje de programación.

## 🎯 2. Objetivos

**Objetivo general**

Implementar y comprobar diferentes funciones criptográficas mediante PHP, utilizando las bibliotecas OpenSSL y Sodium para comprender su aplicación en la protección de la información.

**Objetivos específicos**

- Implementar procesos de cifrado y descifrado.
- Generar y verificar firmas digitales.
- Crear certificados digitales utilizando OpenSSL.
- Comprender el funcionamiento de las claves públicas y privadas.
- Aplicar funciones de cifrado autenticado mediante Sodium.
- Documentar los procedimientos y resultados obtenidos.

## 🛠️ 3. Tecnologías utilizadas

| Tecnología | Función |
|---|---|
| PHP 8.3.28 | Lenguaje de programación |
| OpenSSL 3.5.1 | Operaciones criptográficas |
| Sodium | Cifrado autenticado |
| WampServer | Servidor local |
| Apache 2.4.65 | Servidor web |
| Visual Studio Code | Editor de código |

## 📂 4. Estructura del proyecto

```text
openssl_lab/
│
├── Encriptacion.php
├── firma7.php
├── firmaOtra.php
├── FirmarMensaje.php
├── sodium.php
├── Informacion.php
│
├── keys/
│   └── Archivos de claves locales
│
├── keysCert/
│   └── Certificados y claves locales
│
├── imagenes/
│   ├── figura1-encriptacion.png
│   ├── figura2-firma7.png
│   ├── figura3-certificado-formulario.png
│   ├── figura4-certificado-generado.png
│   ├── figura5-firmar-mensaje.png
│   ├── figura6-sodium.png
│   └── figura7-informacion-php.png
│
├── .gitignore
└── README.md
```

> **Nota de seguridad:** Las claves privadas no se incluyen en el repositorio público. Los archivos sensibles se excluyen mediante `.gitignore`.

## ⚙️ 5. Instalación y configuración

### Requisitos

- WampServer instalado.
- PHP con las extensiones OpenSSL y Sodium habilitadas.
- Apache funcionando correctamente.
- Navegador web.

### Preparación del entorno

1. Iniciar WampServer.
2. Verificar que el servicio Apache esté funcionando.
3. Ubicar la carpeta `www` de WampServer.
4. Crear la carpeta `openssl_lab`.
5. Colocar los archivos PHP dentro de ella.
6. Abrir el navegador para ejecutar los ejemplos.

**Ruta del proyecto:**

```text
C:\wamp64\www\openssl_lab
```

### Direcciones de ejecución

| Archivo | Dirección local |
|---|---|
| Encriptacion.php | `http://localhost/openssl_lab/Encriptacion.php` |
| firma7.php | `http://localhost/openssl_lab/firma7.php` |
| firmaOtra.php | `http://localhost/openssl_lab/firmaOtra.php` |
| FirmarMensaje.php | `http://localhost/openssl_lab/FirmarMensaje.php` |
| sodium.php | `http://localhost/openssl_lab/sodium.php` |
| Informacion.php | `http://localhost/openssl_lab/Informacion.php` |

---

# 🧪 6. Desarrollo y evidencias del laboratorio

## 6.1. Cifrado y descifrado con OpenSSL

**Archivo:** `Encriptacion.php`

Se implementó un formulario para introducir un mensaje y realizar un proceso de cifrado y descifrado mediante OpenSSL.

Se utilizó el algoritmo AES-128-CBC. El mensaje original se transforma en una cadena cifrada representada en Base64. Posteriormente, se realiza el descifrado para recuperar el contenido original.

**Resultado obtenido:**

- Mensaje original: `Mensaje secreto`.
- Se generó una cadena cifrada en Base64.
- El mensaje original se recuperó correctamente.

**📷 Evidencia – Figura 1**

![Figura 1 - Cifrado y descifrado con OpenSSL](imagenes/figura1-encriptacion.png)

<sub>Figura 1. Ejecución del proceso de cifrado y descifrado mediante OpenSSL utilizando AES-128-CBC.</sub>

---

## 6.2. Generación y verificación de firmas digitales

**Archivo:** `firma7.php`

Se implementó un procedimiento para generar y verificar firmas digitales utilizando RSA y SHA-256.

Primero se generó un par de claves criptográficas. La clave privada se utilizó para firmar el mensaje y la clave pública permitió comprobar la validez de la firma.

**Resultado obtenido:**

Se generó la firma digital y se verificó correctamente mediante la clave pública.

**📷 Evidencia – Figura 2**

![Figura 2 - Firma digital RSA](imagenes/figura2-firma7.png)

<sub>Figura 2. Generación y verificación de una firma digital mediante RSA y SHA-256.</sub>

---

## 6.3. Generación de certificados digitales

**Archivo:** `firmaOtra.php`

Se desarrolló un procedimiento para generar un certificado digital mediante OpenSSL.

El proceso incluye la generación de un par de claves, la creación de una solicitud de firma de certificado (CSR) y la generación del certificado digital.

Entre los archivos generados se encuentran:

| Archivo | Descripción |
|---|---|
| `certout.pem` | Certificado digital |
| `certout.csr` | Solicitud de firma del certificado |
| `privkey.pem` | Clave privada |
| `publickey.pem` | Clave pública |

**Resultado obtenido:**

Se generó correctamente el certificado digital y se crearon los archivos correspondientes.

**📷 Evidencia – Figura 3**

![Figura 3 - Formulario del certificado](imagenes/figura3-certificado-formulario.png)

<sub>Figura 3. Formulario utilizado para ingresar los datos necesarios para generar el certificado digital.</sub>

**📷 Evidencia – Figura 4**

![Figura 4 - Certificado generado](imagenes/figura4-certificado-generado.png)

<sub>Figura 4. Resultado de la generación del certificado digital y archivos creados.</sub>

---

## 6.4. Firma y verificación de mensajes mediante certificados

**Archivo:** `FirmarMensaje.php`

Se implementó un formulario para firmar digitalmente un mensaje utilizando la clave privada generada previamente.

La firma se realizó mediante SHA-256 y se representó en Base64 para facilitar su visualización.

Posteriormente, se utilizó la clave pública asociada al certificado para verificar la firma.

**Resultado obtenido:**

La verificación confirmó que la firma era válida y que el mensaje era auténtico.

```text
La firma es válida. El mensaje es auténtico.
```

**📷 Evidencia – Figura 5**

![Figura 5 - Firma y verificación del mensaje](imagenes/figura5-firmar-mensaje.png)

<sub>Figura 5. Ejecución del proceso de firma digital y verificación del mensaje mediante OpenSSL.</sub>

---

## 6.5. Cifrado y descifrado mediante Sodium

**Archivo:** `sodium.php`

Se utilizó la biblioteca Sodium para realizar operaciones de cifrado y descifrado de mensajes.

Se generó una clave secreta aleatoria y un nonce, necesarios para utilizar la función `sodium_crypto_secretbox()`.

Posteriormente, se utilizó `sodium_crypto_secretbox_open()` para descifrar el contenido y recuperar el mensaje original.

**Resultado obtenido:**

El mensaje fue cifrado correctamente y posteriormente se recuperó su contenido original.

**📷 Evidencia – Figura 6**

![Figura 6 - Cifrado con Sodium](imagenes/figura6-sodium.png)

<sub>Figura 6. Ejecución del proceso de cifrado y descifrado mediante la biblioteca Sodium.</sub>

---

## 6.6. Información de PHP y OpenSSL

**Archivo:** `Informacion.php`

Se utilizó la función `phpinfo()` para visualizar información relacionada con la configuración del entorno PHP.

La información permite identificar la versión de PHP, las extensiones habilitadas y los datos relacionados con OpenSSL.

**Resultado obtenido:**

Se visualizó correctamente la información de configuración de PHP y OpenSSL.

**📷 Evidencia – Figura 7**

![Figura 7 - Información de PHP y OpenSSL](imagenes/figura7-informacion-php.png)

<sub>Figura 7. Información de configuración de PHP y OpenSSL mediante phpinfo().</sub>

---

# 🔑 7. Funciones criptográficas utilizadas

| Función | Propósito | Parámetros principales | Retorno |
|---|---|---|---|
| `openssl_encrypt()` | Cifrar información. | Datos, algoritmo, clave, opciones e IV. | Cadena cifrada o FALSE. |
| `openssl_decrypt()` | Descifrar información. | Datos cifrados, algoritmo, clave, opciones e IV. | Texto original o FALSE. |
| `openssl_pkey_new()` | Generar claves criptográficas. | Configuración de claves. | Objeto de clave o FALSE. |
| `openssl_sign()` | Crear una firma digital. | Datos, firma, clave privada y algoritmo. | TRUE o FALSE. |
| `openssl_verify()` | Verificar una firma digital. | Datos, firma, clave pública y algoritmo. | 1, 0 o -1. |
| `openssl_csr_new()` | Crear una solicitud CSR. | Datos de identificación, clave y configuración. | Solicitud CSR o FALSE. |
| `openssl_csr_sign()` | Generar un certificado. | CSR, certificado emisor, clave privada y días. | Certificado o FALSE. |
| `openssl_pkey_export()` | Exportar una clave privada. | Clave, variable de salida y contraseña opcional. | TRUE o FALSE. |
| `sodium_crypto_secretbox()` | Cifrar y autenticar mensajes. | Mensaje, nonce y clave secreta. | Mensaje cifrado. |
| `sodium_crypto_secretbox_open()` | Descifrar y verificar mensajes. | Mensaje cifrado, nonce y clave secreta. | Mensaje original o FALSE. |

# 🛡️ 8. Investigación: Biblioteca Sodium

Sodium es una biblioteca criptográfica moderna que proporciona herramientas para proteger información mediante diferentes mecanismos de seguridad.

En PHP se encuentra disponible mediante la extensión Sodium.

Entre sus principales características se encuentran:

- Cifrado autenticado.
- Generación de claves criptográficas.
- Protección de la confidencialidad.
- Verificación de autenticidad e integridad.
- Operaciones criptográficas de clave pública.

Durante este laboratorio se utilizó `sodium_crypto_secretbox()` para cifrar y autenticar un mensaje, y `sodium_crypto_secretbox_open()` para recuperar su contenido.

# ⚖️ 9. Comparación entre OpenSSL y Sodium

| Característica | OpenSSL | Sodium |
|---|---|---|
| Cifrado y descifrado | Sí | Sí |
| Firmas digitales | Sí | Sí, mediante otras funciones |
| Certificados digitales X.509 | Sí | No es su función principal |
| Cifrado autenticado | Sí, según el algoritmo | Sí |
| Uso en PHP | Extensión OpenSSL | Extensión Sodium |

OpenSSL permite trabajar con certificados digitales, claves y firmas criptográficas. Por otro lado, Sodium ofrece funciones modernas y sencillas para realizar operaciones como el cifrado autenticado.

# 🔒 10. Medidas de seguridad

Durante el desarrollo se utilizaron claves públicas y privadas para realizar operaciones criptográficas.

Las claves privadas deben mantenerse protegidas, ya que permiten realizar operaciones que deben permanecer bajo el control exclusivo de su propietario.

Por esta razón:

- No se publican claves privadas en GitHub.
- Se utiliza `.gitignore` para excluir archivos sensibles.
- Las claves privadas se mantienen en el entorno local.
- No se comparten credenciales ni información sensible.

# 📝 11. Conclusiones

La realización de este laboratorio permitió comprender la aplicación de diferentes mecanismos criptográficos mediante PHP, utilizando las bibliotecas OpenSSL y Sodium.

Se logró implementar el cifrado y descifrado de mensajes, generar y verificar firmas digitales y crear certificados digitales. También se comprobó el funcionamiento de Sodium mediante el cifrado autenticado de información.

Las pruebas realizadas permitieron observar cómo estas herramientas contribuyen a proteger la información, mantener su integridad y comprobar su autenticidad.

Finalmente, la actividad permitió reforzar los conocimientos sobre claves públicas y privadas, certificados digitales y funciones criptográficas dentro del desarrollo de aplicaciones web.

---

<p align="center">
  **Laboratorio de Desarrollo Web | Ciberseguridad**
  
  *Implementación de funciones criptográficas con PHP, OpenSSL y Sodium.*
</p>
