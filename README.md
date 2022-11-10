## Instalación

1. Clonar el proyecto
   ```sh
   git clone https://github.com/adonisventocilla/excercise-api.git excercise-api
   ```
2. Crear un base de datos `exercise-api` en PostgreSQL
3. Por tema de seguridad crear un squema `exercise-api` y no utilizar el `public`
4. Verificar que en el archivo php.ini se encuentre habilitado las extensiones `pdo_pgsql` y `pgsql`

5. Ingresa al proyecto y realizar los comandos de ejecucion Laravel (`php 8.0 o superior`)
   ```sh
   cd excercise-api // Ubicarnos dentro del directorio base del proyecto
   cp .env.example .env // crear archivo de variables de entorno y actualizar variables de BD
   ```
6. Ejecuta el comando de instalación de Laravel
   ```sh
   composer install
   //generar la clave de aplicación
   php artisan key:generate
   //generar las tablas y migraciones
   php artisan migrate --seed
   
   //ejecutar servidor
   php artisan serve
   ```
7. Una vez se habilite el navegador (`http://127.0.0.1:8000/`) ingrese a:

> `http://127.0.0.1:8000/api/documentation` para revisar las API's

UPDATE

8. Se actualizó la columna `items` por `articles`, para aplicar los cambios realizar:
```sh
    //verificar si están todas las migraciones
    php artisan migrate:status
    //realizar la actualización
    php artisan migrate
```
9. Si se muestra el siguiente error al ejecutar la migración:
> Class 'Doctrine\DBAL\Driver\AbstractPostgreSQLDriver' not found

Se debe ejecutar los siguientes comando:
```sh
    //reinstalar el paquete de pgsql
    composer remove doctrine/dbal
    composer require doctrine/dbal
    //realizar la migración
    php artisan migrate
```
