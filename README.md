<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

### Acerca de GB App

La aplicación busca poder visualizar reportes de PowerBI de una manera más óptima y
gestionable por medio la API de Microsoft

Algunas de las características de la aplicación son:

* Creación y administración de usuarios, roles y permisos
* Creación, administración y asignación de reportes
* Recuperación de contraseñas
* Autenticación de 2 factores

Tecnologías usadas: 
* PHP v8.2
* Laravel Framework v10.14
* NodeJS v18.16 LTS
* VueJS v3.2

### Instalación

Si se va a usar un entorno de produccion en Docker:

* Descargar y descomprimir el proyecto
* Copiar el archivo .env.example (Variables de entorno) `cp .env.example .env`
* Construir el contenedor `docker-compose build`
* Iniciar el contenedor `docker-compose up -d`
* Instalar dependencias de PHP `docker-compose exec app composer install`
* Instalar dependencias de NodeJS `docker-compose exec app npm i`
* Se debe modificar el archivo `.env` teniendo en cuenta los siguientes parámetros:
  ````
    DB_CONNECTION=mysql       (tipo de base de datos mysql o sqlsrv)
    DB_HOST=0.0.0.0           (IP del servidor de base de datos)
    DB_PORT=3306              (Puerto del servidor de base de datos)
    DB_DATABASE=gb-app        (Nombre de la base de datos)
    DB_USERNAME=root          (Usuario de base de datos)
    DB_PASSWORD=password      (Contraseña de base de datos)
  ````

  ````
    POWERBI_USER_ID=       (ID de la aplicacion de Azure AD)
    POWERBI_GRANT_TYPE=    (Tipo de autenticacion por defecto usar: client_credentials)
    POWERBI_CLIENT_SECRET= (Token de acceso, generado en Azure AD)
    POWERBI_CLIENT_ID=     (ID Del cliente, se obtiene en Azure AD en la aplicacion registrada)
    POWERBI_RESOURCE=      (Punto de acceso para nuestra conexion con la API de PowerBI
  ````
* Eliminar cache de la aplicación: `docker-compose exec app php artisan optimize`(este paso se debe hacer cada vez
  que se modifique algun valor en el archivo `.env`)
* Crear la base de datos y el usuario super administrador
  principal: `docker-compose exec app php artisan migrate --seed`
* Compilar archivos JS: `docker-compose exec app npm run prod`

### Accesos

* El contenedor sirve por el puerto `9300`pero puede ser modificado por uno de su preferencia en el
  archivo `docker-compose.yml`
* Acceso a la aplicación `http://{IP_SERVIDOR|LOCALHOST}:{PUERTO}`


