Asistente Educación
===========================
## Descripción
Este módulo permite gestionar las solicitudes de ingreso de asistentes de educacion, en los establecimiento que se encuentran en la base de datos del sistema.

## modelos
### Proceso de solicitud de ingreso de establecimiento o director

El proceso de solicitud de ingreso de establecimiento o director se realiza de la siguiente manera:

en principio se determina si es necesario ingresar un establecimiento

si el establecimiento existe entonces se determina si no tiene solicitudes activas o ingresadas.

si el establecimiento no tiene solicitudes activas, puede siginificar que se requiere de un ingreso de nuevo director.

si el establecimiento no existe entonces se procede a ingresar un nuevo establecimiento con los datos del director respectivo.

este proceso tiene las siguientes modelos:

-MvSolicituEstab -> modelo de solicitud de ingreso de establecimiento
-MvSolicitudCambioDirector -> modelo de solicitud de cambio de director

## Funcionalidades
- Determinar por medio de un formulario si se requiere ingresar un nuevo establecimiento o un nuevo director.
- Ingresar los datos de solicitud de ingreso establecimiento y del director respectivo.
- Ingresar los datos de solicitud de ingreso de director.

## Roles
- externo - usuario que ingresa la solicitud de ingreso de establecimiento o director. validado mediante un token de acceso de clave unica.

## Controlladores
- cada modelo tiene su controlador respectivo el cual tiene los metodos de creacion, edicion, eliminacion y listado, que son los metodos basicos de un CRUD, en laravel tiene la siguiente estructura:

ademas de estos metodos se pueden agrear metodos de servicios, que se traducen en metodos que realizan acciones especificas, como por ejemplo determinar si un establecimiento tiene solicitudes activas o ingresadas, por lo generar derivan del analisis de los datos de la base de datos o de datos que entregan los mismos metodos del controlador.

```php
public function index()
{
    $data = MvSolicituEstab::all();
    return response()->json($data);
}

public function create()
{
    //datos del formulario de creacion
    //retorna la vista de creacion y los datos necesatios para crear el formulario, 

    //ejemplo datos modelo relacioando
    $data['establecimientos'] = MvEstablecimiento::all();
    $data['directores'] = MvDirector::all(); 
    
    //
    return view('create', compact('data'));
    ó
    return response()->json($data);

}

public function store(Request $request)
{
    $data = $request->all();
    $data = MvSolicituEstab::create($data);
    return response()->json($data);
}

public function show($id)
{
    $data = MvSolicituEstab::find($id);
    return response()->json($data);
}

public function update(Request $request, $id)
{
    $data = MvSolicituEstab::find($id);
    $data->update($request->all());
    return response()->json($data);
}

public function destroy($id)
{
    $data = MvSolicituEstab::find($id);
    $data->delete();
    return response()->json($data);
}
```
## Controladores de Acciones/Componentes Livewire de Acciones

- Un control de acciones es un controlador que se encarga de realizar una accion especifica, en este caso se tiene un componente de accion que se encarga de realizar las acciones de determinar si se requiere ingresar un nuevo establecimiento o un nuevo director, y hace uso de los controladores de los modelos para realizar estas acciones.

como usaremos Livewire, podemos establecer que los controladores de accion son componentes de livewire, que se encargan de realizar las acciones especificas de los controladores de los modelos.

pero que en ningun caso tenda relacion con las persistencias de los datos, ya que esta tarea la realizan los controladores de los modelos. solo recibe datos como si fueran microservicios y los procesa para determinar si se requiere realizar una accion especifica.

los metodos del componente que no son predeterminados se deben de llamar como metodos de servicios, ya que realizan acciones especificas, en idioma español. por lo general devuelve acciones de vista del mismo componente o dispara eventos a otros componentes.

interactua con las vistas de los componentes de livewire, y con los controladores de los modelos. pero de los controladores solo recibe datos y puede enviar datos a los controladores de los modelos.

por lo general vamos a encontrar eventos que interactian de manera reactiva con el front de la aplicacion

```php
  public function verificarSolicitud()
    {
        $Solicitud = new MvSolicitudEstabController();
        $existeSolicitud = $Solicitud->ExisteSolicitud($this->rbd_establecimiento);
        $existeEstablecimiento = $Solicitud->ExisteEstablecimiento($this->rbd_establecimiento);
        if ($existeSolicitud) {
            $this->dispatch('EmiteAlerta', mensaje: 'Ya existe una solicitud para este establecimiento', estatus: 'error');
        } elseif (!$existeEstablecimiento && !$existeSolicitud) {
            $this->mostrarFormulario = 1;
            $this->dispatch(
                'AlertConsulta2',
                title: 'Información Importante..!',
                text: '¿Esta seguro de realizar una solicitud para agregar un nuevo establecimiento?, recuerde que esta acción es irreversible.',
            );
        } elseif ($existeEstablecimiento) {
            $this->dispatch(
                'AlertConsulta',
                title: "El establecimiento se encuetra registrado",
                text: "¿Desea realizar una solicitud de cambio de director? \n Nota: Si Ud. necesita realizar una solicitud para evaluar a su asistente de la educación, debe: \n\n\n (1) autentificarse el Director del Establecimiento o su Delegado autorizado.\n(2) seleccionar la opción “Panel - Asistente de la Educación”.",
            );

        }
    }

```
en este modulo existe un controlador de accion que no tiene relacion con los modelos, pero que se encarga de realizar una accion especifica, que es determinar si se requiere ingresar un nuevo establecimiento o un nuevo director, y hace uso de los controladores de los modelos para realizar estas acciones.

## Componentes Livewire

la idea es que los componentes tengan el mismo nombre de los controladores de los modelos, y que se encargen de interartuar con los datos de las vistas reactivas del livewire, y que se encargen de enviar los datos a los controladores de los modelos.

```php
// Existen metodos como
//validarFormulario
//enviarSolicitud
// y los por defecto que tiene livewire



```



