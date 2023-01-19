#Aplicativo para una prueba de backen en php

El aplicativo esta creado para consumir un servicio externo el cual me devuelve información
de usuarios y transacciones.

Una vez consumido el servicio se implemento dos vistas para visualizar todos los usuarios en una tabla y en otra vista
para mostrar la información del usuario anteriormente seleccionado con sus transacciones.

Dejos la ruta para el consumos de las apis de tipo get
http://localhost:8000/api/usuarios

    En esta ruta visualizamos a todos los usuarios pero en este caso por orden de fecha creación decendente.


http://localhost:8000/api/usuarios/transacciones/3

    En esta ruta visualizamos todas las transacciones que pertenecen a un usuario ordenado por campo de fecha de creación de forma acendente.


http://localhost:8000/api/usuarios/1

    En esta ruta podemos consultar un solo usuario con el id


#Instalacción de laravel.
<p>Paso 1: clonar el repositorio.</p>
<p>Paso 2: ejecutar el comando "composer update"</p>
<p>Paso 3: Ejecutar el comando "php artisan key:generate"</p>
<p>Paso 4: Clonar el archivo .env_example y cambiar el nombre por .env
    En este archivo se encuetra dos variables nuevas una que es la ruta del servicio y la otra el token.</p>
