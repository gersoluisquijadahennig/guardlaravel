<div class="container">
    <x-form-card title="Solicitud de ingreso de documentación al Servicio de Salud Biobío.">

        <div class="card">
            <div class="card-body">
                <p class="text-muted small">
                    Ud. como funcionario perteneciente a una institución deberá indicar datos a continuación. Al guardar dichos datos, el Servicio de Salud Biobío revisará su solicitud respecto a veracidad, completitud y aplicabilidad a la institución, notificándole dentro de las próximas 48 horas la aceptación o rechazo de la misma.
                </p>
            </div>
        </div>
        <form wire:submit.prevent="Guardar" enctype="multipart/form-data" method="POST" autocomplete="off"  novalidate>
            <x-form-card title="Datos del Establecimiento">
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted small">
                            Ud. como funcionario perteneciente a una institución deberá indicar datos a continuación. Al guardar dichos datos, el Servicio de Salud Biobío revisará su solicitud respecto a veracidad, completitud y aplicabilidad a la institución, notificándole dentro de las próximas 48 horas la aceptación o rechazo de la misma.
                        </p>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-12">
                        <x-adminlte-input name="nombre_establecimiento" wire:model.lazy="nombre_establecimiento" type="text" label="Nombre del Establecimiento :" placeholder="Nombre del Establecimiento" class="{{$this->nombreEstablecimientoValidationState}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-user text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="rut_establecimiento" wire:model.lazy="rut_establecimiento" type="text" label="Rut Establecimiento :" placeholder="9 1111 1111" class="{{$this->rutEstablecimientoValidationState}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="direccion_establecimiento" wire:model.lazy="direccion_establecimiento" type="text" label="Direccion Establecimiento :" placeholder="Direccion Establecimiento" class="{{$this->direccionEstablecimientoValidationState}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="telefono_establecimiento" wire:model.lazy="telefono_establecimiento" type="text" label="Telefono Establecimiento :" placeholder="9 1111 1111" class="{{$this->telefonoEstablecimientoValidationState}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="rbd_establecimiento" wire:model.lazy="rbd_establecimiento" type="text" label="RBD del Establecimiento :" placeholder="32132-4" class="{{$this->rbdEstablecimientoValidationState}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                    </div>
                </div>
            </x-form-card>
            <x-form-card title="Datos del Director">
                <div class="row">
                    <div class="col-md-12">
                        <x-adminlte-input name="rut_director" wire:model.lazy="rut_director" type="text" label="Rut Director :" placeholder="9 1111 1111" class="{{$this->rutDirectorValidationState}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="nombre_director" wire:model.lazy="nombre_director" type="text" label="Nombre del Director :" placeholder="Nombre del Director" class="{{$this->nombreDirectorValidationState}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-user text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="apellido_paterno" wire:model.lazy="apellido_paterno" type="text" label="Apellido Paterno Director :" placeholder="Apellido Paterno Director" class="{{$this->apellidoPaternoValidationState}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="apellido_materno" wire:model.lazy="apellido_materno" type="text" label="Apellido Materno Director :" placeholder="Apellido Materno Director" class="{{$this->apellidoMaternoValidationState}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="email_director" wire:model.lazy="email_director" type="text" label="Email Director :" placeholder="Email Director" class="{{$this->emailDirectorValidationState}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                </div>
            </x-form-card>
            <x-slot name="footer">
                <button type="submit" class="btn btn-primary">Agregar</button>
                <button type="submit" class="btn btn-danger" wire:click="$dispatch('resetFormulario')">Reset</button>                <!-- Agrega más botones aquí como plantilla de la tarjeta-->
            </x-slot>
        </form>
    </x-form-card>
    </form>
</div>
