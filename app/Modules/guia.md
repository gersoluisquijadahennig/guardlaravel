## Guia para contrucción de módulos

### Introducción
La estructura de modulos se basa en la estructura de un proyecto de laravel, con la diferencia de que los módulos se encuentran en la carpeta app/Modules en el directorio raíz del proyecto.

basicamente un módulo es un conjunto de archivos que se encargan de realizar una tarea específica, por ejemplo un módulo de usuarios se encargará de gestionar todo lo relacionado con los usuarios, como crear, editar, eliminar, listar, etc.

### Convenciones de nombres
- Los nombres de los módulos deben ser en CamelCase. es decir la primera letra de cada palabra debe ser mayúscula.


### Modelos
- Los nombres de los modelos deben ser en CamelCase y deben de tener el mismo nombre de la tabla de la blase de datos sin el esquema al que pertenece. Ejemplo: la tabla BIBLIOTECA_VIRTUAL.SOLICITA_DOCUMETO, el modelo debe llamarse SolicitaDocumento.


### Controladores
- Los nombres de los controladores deben ser en CamelCase y terminar con la palabra Controller. Ejemplo: UserController.
- Los controladores deben estar en la carpeta Controllers del módulo.
### Vistas
- Las vistas deben estar en la carpeta Views del módulo.
- Las vistas se subdividen en carpetas según el recurso que se esté gestionando, por ejemplo si se está gestionando usuarios, se debe crear una carpeta llamada Users dentro de la carpeta Views.
- Las vistas deben tener el mismo nombre que el método del controlador que las renderiza.
- No se deben de crear layouts en las vistas, los layouts deben estar en la carpeta resources/views/layouts del directorio principal de la app es decir en resources/views/layouts.
- Las vistas deben de extender de un layout que se encuentre en la carpeta resources/views/layouts del directorio principal de la app.
- Las vistas deben de tener la extensión .blade.php.
- Para las vistas de componentes Livewire, se debe crear una carpeta llamda Livewire dentro de la carpeta Views del módulo, se subdivide en carpetas según el recurso que se esté gestionando, por ejemplo si se está gestionando usuarios, se debe crear una carpeta llamada Users dentro de la carpeta Views/Livewire.
- Las vistas de componentes Livewire deben tener la extensión .blade.php.
- Las vistas de componentes Livewire deben de tener el mismo nombre de metodo .
-- formato de nombre de vista de componente livewire: nombre_metodo.blade.php

Cuando hablamos de un **create** estamos hablando de un formulario de creación, cuando hablamos de un **edit** estamos hablando de un formulario de edición, cuando hablamos de un **show** estamos hablando de una vista de detalle, cuando hablamos de un **index** estamos hablando de una vista de listado.

entonces si estamos creando un módulo de usuarios, la estructura de la carpeta Views sería la siguiente:

```bash
cd Views
mkdir Users
cd Users
touch create.blade.php
touch edit.blade.php
touch show.blade.php
touch index.blade.php
```
el mismo caso para los componentes livewire

```bash
cd Views
mkdir Livewire
cd Livewire
mkdir Users
cd Users
touch create-livewire.blade.php
touch edit-livewire.blade.php
touch show-livewire.blade.php
touch index-livewire.blade.php
```
dependiendo de la necesidad del p


### Rutas
- Las rutas deben estar en la carpeta Routes del módulo.
- deberia de existir un archivo de rutas llamado web.php, api.php, etc. dependiendo del tipo de rutas que se estén creando, en su mayoria se crean rutas web.

### Livewire


### Migraciones

### Correos/Mails

### Providers
aqui tenemos que entender que es un provider en laravel, un provider es un archivo que se encarga de registrar servicios en la aplicación, por ejemplo un provider de rutas, un provider de vistas, un provider de migraciones, etc.

entonces .



### Crear un módulo
1. Crear una carpeta con el nombre del módulo en la carpeta Modules. dentro del direrctorio raíz del proyecto en /app.

```bash
cd app
mkdir Modules/nombre_modulo
```
2. Crear un archivo con el nombre del módulo.md en la carpeta Modules. en este archivo se escribirá la documentación del módulo.
    
```bash
cd Modules
touch nombre_modulo.md
```
3. la estructura de la carpeta del módulo debe ser la siguiente:
```bash
cd nombre_modulo
mkdir Controllers
mkdir Models
mkdir Views
Mkdir Routes
Mkdir Livewire
Mkdir Migration
Mkdir Mail
```
//representar la estructura de la carpeta del módulo en texto plano, 



