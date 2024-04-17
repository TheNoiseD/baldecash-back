# Manual de Instalacion Test Evertec

### Requisitos

- PHP v8.1
- MariaDB v10.6
- Composer


### Instalación 🔧
1. Clonar el repositorio en el folder del servidor web en uso o en el de su elección, **este folder debe tener permisos para que php se pueda ejecutar por CLI y permisos de lectura y escritura para el archivo .env**.

```sh 
git clone https://github.com/TheNoiseD/laravelTest.git 
```

2. Instalar paquetes ejecutando en la raíz del folder.

```sh 
composer install
```
3. Crear BD con COLLATE 'utf8mb4_general_ci'.

```sh 
`CREATE DATABASE test_back;`
```

4. Duplique el archivo `.env.example2` incluido en uno de nombre `.env` y dentro de este ingrese los valores de las 
   variables de entorno necesarias


5. Ejecute los siguientes comandos para poner en marcha las configuraciones del sitio.

```sh
php artisan key:generate
``` 
```sh
php artisan migrate --seed
```
6. Para poner la aplicación en marcha ejecute tiene varias opciones.

- Configurar el servidor web para que apunte a la carpeta public del proyecto.

- Ejecutar el comando `php artisan serve` en la raíz del proyecto y acceder a la url.

## Autor ✒️

* **Guillermo Ordoñez** [anthmon19@gmail.com](mailto:anthmon19@gmail.com)
