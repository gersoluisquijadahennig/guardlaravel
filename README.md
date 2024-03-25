# Panel v4

panel v4, es un proyecto desarrollado por el departamento de tecnologia del Servicio de salud de Biobio, es un proyecto que pretende migrar las caracteristicas del sistema usado actualmente a laravel en su version 10.

el proyecto esta desarrollado en laravel 10, con una base de datos Oracle 11.2.04 y Postgres, es un proyecto monolitico, con un frontend en blade y Livewire junto con una plantilla predefinida Admindlte v3 y un backend en laravel, el proyecto esta dividido en modulos, cada modulo tiene su propio controlador, modelo, vista y rutas.

## Tabla de Contenidos
* [Comenzando](#comenzando)
* [Instalación](#instalación)
  * [Prerrequisitos](#prerrequisitos)
  * [Paso 1: Clonar el repositorio](#paso-1-clonar-el-repositorio)
  * [Paso 2: Instalar las dependencias de PHP con Composer](#paso-2-instalar-las-dependencias-de-php-con-composer)
  * [Paso 3: Copiar el archivo .env.example a .env](#paso-3-copiar-el-archivo-envexample-a-env)
  * [Paso 4: Generar la clave de la aplicación](#paso-4-generar-la-clave-de-la-aplicación)
  * [Paso 5: Configurar la base de datos en el archivo .env](#paso-5-configurar-la-base-de-datos-en-el-archivo-env)
  * [Paso 6: Ejecutar las migraciones y los seeders](#paso-6-ejecutar-las-migraciones-y-los-seeders)
  * [Paso 7: Instalar las dependencias de JavaScript con npm](#paso-7-instalar-las-dependencias-de-javascript-con-npm)
  * [Paso 8: Compilar los assets con npm](#paso-8-compilar-los-assets-con-npm)
  * [Paso 9: Iniciar el servidor de desarrollo](#paso-9-iniciar-el-servidor-de-desarrollo)

## Comenzando

Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas.

## Instalación

### Prerrequisitos

Necesitas instalar en tu maquina
* git
* composer-> creo que ya lo trae laragon
* npm-> creo que ya lo trae laragon
* Laragon
** tenemos que actualizar php para laragon en la version 8.3.2 y postgresql en la version 16.1 o superior, buscar informacion en la pagina oficial de laragon, o se realiza otro documento con los pasos a seguir.
* dbeaver

un editor de codigo
* Visual Studio Code
** se recomienda instalar las extensiones de laravel y blade para visual studio code

**Laragon** es un entorno de desarrollo local que es muy fácil de instalar y usar. Si no tienes instalado Laragon, puedes descargarlo desde [aquí](https://laragon.org/download/index.html).

**Composer** es un administrador de dependencias en PHP. Si no tienes instalado Composer, puedes descargarlo desde [aquí](https://getcomposer.org/download/).

**npm** es un administrador de paquetes para JavaScript. Si no tienes instalado npm, puedes descargarlo desde [aquí](https://www.npmjs.com/get-npm).

**git** es un sistema de control de versiones. Si no tienes instalado git, puedes descargarlo desde [aquí](https://git-scm.com/downloads).

**Visual Studio Code** es un editor de código fuente desarrollado por Microsoft. Si no tienes instalado Visual Studio Code, puedes descargarlo desde [aquí](https://code.visualstudio.com/).

//ahora que tienes todo instalado, puedes continuar con la instalacion del proyecto vamos a clonar el repositorio

### Paso 1: Clonar el repositorio, para esto abrimos la terminal de laragon nos cercioramos de estar en la carpeta www y ejecutamos el siguiente comando

```bash
git clone https://github.com/gersoluisquijadahennig/guardlaravel panelv4
```
esto clonara el repositorio en una carpeta llamada panelv4, luego nos movemos a la carpeta panelv4, laragon por defecto esta configurado para crear un host virtual con el nombre de la carpeta que contiene el proyecto, por lo que si accedemos a http://panelv4.test deberiamos ver la pagina de inicio de laravel, peor antes de eso debemos seguir con los siguientes pasos

```bash
cd panelv4
```

### Paso 2: Dentro de la carpeta Instalar las dependencias de PHP con Composer

```bash
composer install
```

### Paso 3: Copiar el archivo .env.example a .env   y configurar la base de datos, para esto ejecutamos el siguiente comando o simplemente copiamos el archivo .env.example y lo renombramos a .env

```bash
cp .env.example .env
```

### Paso 4: Generar la clave de la aplicación

```bash
php artisan key:generate
```

### Paso 5: Configurar la base de datos en el archivo .env

Solicitiar el archivo .env a un miembro del equipo de desarrollo y configurar la base de datos en el archivo .env

### Paso 6: Ejecutar las migraciones y los seeders

antes de ejecutar las migraciones y los seeders debemos configurar la base de datos en el archivo .env, luego ejecutamos el siguiente comando, laragon viene con los drivers y motor PostgreSQL, entonces tenemos que iniciar el servicio de PostgreSQL en laragon, para esto abrimos laragon y en la parte superior derecha hacemos click en icono de configuracion, luego en servicios y desactivamos Mysql que viene por defecto y activamos PostgreSQL.

ahora abrimos dbeaver y creamos una nueva conexion hacia postgres con los datos que configuramos con laragon, luego creamos una base de datos con el nombre que configuramos en el archivo .env, luego ejecutamos el siguiente comando


```bash
php artisan migrate --seed
```

### Paso 7: Instalar las dependencias de JavaScript con npm

```bash
npm install
```

### Paso 8: Compilar los assets con npm

```bash
npm run dev
```

### Paso 9: Iniciar el servidor de desarrollo, para este caso vamos a usar el servidor de laravel que viene incluido en el framework, 

```bash
php artisan serve
```
esto nos mostrara la siguiente salida

```bash
Laravel development server started: http://localhost:8000
```
## Que sigue
* Documentar como esta estructurado el proyecto
* Documentar las convenciones de nombres
* Documentar las convenciones de codificación
* Documentar las convenciones de control de versiones
* Documentar las convenciones de ramas
* Documentar las convenciones de commits
* Documentar las convenciones de pull request
* Documentar las convenciones de despliegue
* Documentar las convenciones de pruebas
* Documentar las convenciones de errores
* Documentar las convenciones de seguridad

## Documentación
* [Laravel](https://laravel.com/docs/10.x)
* [Livewire](https://livewire.laravel.com/)
* [Blade](https://laravel.com/docs/10.x/blade)
* [AdminLTE](https://adminlte.io/docs/3.1/)
* [AdminLTEv3 for Laravel](https://github.com/jeroennoten/Laravel-AdminLTE?tab=readme-ov-file)
