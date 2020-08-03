# Store-Products

Trda.

git        versión: (2.5.3)
composer   versión: (1.0.9)
laravel    versión: (5.5)
php        versión: (7.0)
mysql      versión: (5.0.12)
apache     versión: (1.3)

## Requerimientos

- git >= 2.5.3
- composer >= 1.0.9
- Laravel framework >= 5.5
- Apache Server >= 1.3
- PHP >= 7.0
- Mysql >= 5.0.12

## Instalación

Descarga paquete.
- https://git-scm.com/downloads
- https://getcomposer.org/download/
- composer create-project --prefer-dist laravel/laravel my-project
- https://httpd.apache.org/download.cgi
- http://php.net/downloads.php
- https://dev.mysql.com/downloads/installer/

## Documentación

- https://git-scm.com/doc
- https://getcomposer.org/doc/00-intro.md
- https://styde.net/documentacion-de-laravel-en-espanol/
- https://httpd.apache.org/docs/
- http://php.net/docs.php
- https://dev.mysql.com/doc/

## Configuración

Al crear la instanciación de treda se debe parametrizar las siguientes lineas en archivo config/database.php:

Configurar arreglo de conexión a servidor y base de datos -> línea 42:
  'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'treda'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

Al igua se debe parametrizar las siguientes lineas en archivo .env:
	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=treda
	DB_USERNAME=root
	DB_PASSWORD=null

- Base de datos: treda.sql

## Versión
v1.0

## Licencia
[MIT License](LICENSE)


# Documentación

#### Instalacion y ejecución
NOTA: Ejemplo url consumo del servicio que muestra los productos asociados a una tienda: http://www.myurl.com/public/store/info?id=1
      Esquema de Base de datos para evitar correr migrate y seeders de laravel: treda.sql

1. Descargar archivos del proyecto o clonar proyecto y hacer su respectiva actualización.

2. Colocar en ubicación del equipo donde este instalado el servidor web. 

3. Configurar archivo config/database.php y .env

4. Ejecutar aplicación:
- Abrir navegador de preferencia y ejecutar url de acuerdo a configuración del servidor web instalado en el equipo.