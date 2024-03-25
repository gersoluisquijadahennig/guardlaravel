<div>
    <div class="container w-75">
        <div class="accordion" id="formularioExistente">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Solicitud de ingreso documentación al Servicio de Salud Biobío.
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                    <div class="accordion-body">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-muted small">
                                    Ud. 654 com464o funcionario perteneciente a una institución deberá indicar datos
                                    a continuación. Al guardar dichos datos, el Servicio de Salud Biobío revisará su
                                    solicitud respecto a veracidad, completitud y aplicabilidad a la institución,
                                    notificándole dentro de las próximas 48 horas la aceptación o rechazo de la
                                    misma.
                                </p>
                            </div>
                        </div>
                        <form wire:submit.prevent="Guardar" enctype="multipart/form-data" method="POST"
                            autocomplete="off" novalidate>
                            <x-form-card title="Datos del Establecimiento">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-muted small">
                                            {{$rut_establecimiento}}
                                            {{$rbd_establecimiento}}
                                            Ud. gers funcionario f sdf asdfaaasdfasdfasdfas sf perteneciente a una
                                            institución deberá indicar datos a continuación. Al guardar dichos
                                            datos, el Servicio de Salud Biobío revisará su solicitud respecto a
                                            veracidad, completitud y aplicabilidad a la institución, notificándole
                                            dentro de las próximas 48 horas la aceptación o rechazo de la misma.
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <x-adminlte-input name="nombre_establecimiento"
                                            wire:model.lazy="nombre_establecimiento" type="text"
                                            label="Nombre del Establecimiento :"
                                            placeholder="Nombre del Establecimiento"
                                            class="{{ $this->ValidationState }}">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lg fa-user text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                        <x-adminlte-input name="rut_establecimiento"
                                                wire:model.lazy="rut_establecimiento" type="text"
                                                label="Rut Establecimiento :" placeholder="9 1111 1111"
                                                class="{{ $this->ValidationState }}">
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                        <x-adminlte-input name="direccion_establecimiento"
                                            wire:model.lazy="direccion_establecimiento" type="text"
                                            label="Direccion Establecimiento :" placeholder="Direccion Establecimiento"
                                            class="{{ $this->ValidationState }}">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                        <x-adminlte-input name="telefono_establecimiento"
                                            wire:model.lazy="telefono_establecimiento" type="text"
                                            label="Telefono Establecimiento :" placeholder="9 1111 1111"
                                            class="{{ $this->ValidationState }}">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                        <x-adminlte-input name="rbd_establecimiento"
                                                wire:model.lazy="rbd_establecimiento" type="text"
                                                label="RBD del Establecimiento :" placeholder="32132-4"
                                                class="{{ $this->ValidationState }}">
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="text-muted small">
                                                    Ud. gers funcionario f sdf asdfaaasdfasdfasdfas sf perteneciente
                                                    a una
                                                    institución deberá indicar datos a continuación. Al guardar
                                                    dichos
                                                    datos, el Servicio de Salud Biobío revisará su solicitud
                                                    respecto a
                                                    veracidad, completitud y aplicabilidad a la institución,
                                                    notificándole
                                                    dentro de las próximas 48 horas la aceptación o rechazo de la
                                                    misma.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </x-form-card>
                            <x-form-card title="Datos del Director">
                                <div class="row">
                                    <div class="col-md-10">
                                        <x-adminlte-input name="rut_director" wire:model.lazy="rut_director"
                                            type="text" label="Rut Director :" placeholder="9 1111 1111"
                                            class="{{ $this->ValidationState }}">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                        <x-adminlte-input name="nombre_director" wire:model.lazy="nombre_director"
                                            type="text" label="Nombre del Director :"
                                            placeholder="Nombre del Director" class="{{ $this->ValidationState }}">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lg fa-user text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                        <x-adminlte-input name="apellido_paterno" wire:model.lazy="apellido_paterno"
                                            type="text" label="Apellido Paterno Director :"
                                            placeholder="Apellido Paterno Director"
                                            class="{{ $this->ValidationState }}">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                        <x-adminlte-input name="apellido_materno" wire:model.lazy="apellido_materno"
                                            type="text" label="Apellido Materno Director :"
                                            placeholder="Apellido Materno Director"
                                            class="{{ $this->ValidationState }}">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                        <x-adminlte-input name="email_director" wire:model.lazy="email_director"
                                            type="text" label="Email Director :" placeholder="Email Director"
                                            class="{{ $this->ValidationState }}">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                </div>
                                <x-slot name="footer">
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                    <button type="submit" class="btn btn-danger"
                                        wire:click="$dispatch('resetFormulario')">Reset</button>
                                    <!-- Agrega más botones aquí como plantilla de la tarjeta-->
                                </x-slot>

                            </x-form-card>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
