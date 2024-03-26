<div>
    <div class="container w-100">
        <x-form-card title="Solicitud de Cambio de Director">
            <form wire:submit.prevent="Guardar" enctype="multipart/form-data" method="POST" autocomplete="off" novalidate>
                <x-form-card title="Datos del Solicitante">
                    <div class="row">
                        <div class="col-md-12">
                            <x-adminlte-input name="rut_solicitante" wire:model.lazy="rut_solicitante" type="text"
                                label="Rut Solicitante :" placeholder="26.335.451-6;263354516;26335451-6"
                                class="{{ $this->ValidationState }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-lg fa-id-card text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <x-adminlte-input name="nombre_solicitante" wire:model.lazy="nombre_solicitante"
                                type="text" label="Nombres del Solicitante :" placeholder=""
                                class="{{ $this->ValidationState }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-lg fa-user text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="apellido_paterno_solicitante" wire:model.lazy="apellido_paterno_solicitante"
                                type="text" label="Apellido Paterno Solicitante :" placeholder=""
                                class="{{ $this->ValidationState }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-lg fa-user-tag text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="apellido_materno_solicitante" wire:model.lazy="apellido_materno_solicitante"
                                type="text" label="Apellido Materno Solicitante :" placeholder=""
                                class="{{ $this->ValidationState }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-lg fa-user-check text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <x-adminlte-input name="cargo" wire:model.lazy="cargo" type="text"
                                label="Cargo Solicitante :" placeholder="" class="{{ $this->ValidationState }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-lg fa-briefcase text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="telefono_solicitante" wire:model.lazy="telefono_solicitante"
                                type="text" label="Telefono Solicitante :" placeholder=""
                                class="{{ $this->ValidationState }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-lg fa-mobile text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="email_solicitante" wire:model.lazy="email_solicitante"
                                type="text" label="Email Solicitante :" placeholder=""
                                class="{{ $this->ValidationState }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-lg fa-envelope text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    </div>                </x-form-card>
                <x-form-card title="Datos del Director">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-4">
                                <x-adminlte-input name="rut_director" wire:model.lazy="rut_director" type="text"
                                    label="Rut Director :" placeholder="9 1111 1111" class="{{ $this->ValidationState }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-lg fa-id-card text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                            <div class="col-md-4">
                                <x-adminlte-input name="nombre_director" wire:model.lazy="nombre_director" type="text"
                                    label="Nombre del Director :" placeholder="Nombre del Director"
                                    class="{{ $this->ValidationState }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-lg fa-user text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                            <div class="col-md-4">
                                <x-adminlte-input name="apellido_paterno_director"
                                    wire:model.lazy="apellido_paterno_director" type="text"
                                    label="Apellido Paterno Director :" placeholder="Apellido Paterno Director"
                                    class="{{ $this->ValidationState }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-lg fa-user text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <x-adminlte-input name="apellido_materno_director"
                                    wire:model.lazy="apellido_materno_director" type="text"
                                    label="Apellido Materno Director :" placeholder="Apellido Materno Director"
                                    class="{{ $this->ValidationState }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-lg fa-user text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                            <div class="col-md-4">
                                <x-adminlte-input name="telefono_director" wire:model.lazy="telefono_director"
                                    type="text" label="Telefono Director :" placeholder="Telefono Director"
                                    class="{{ $this->ValidationState }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-lg fa-phone text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                            <div class="col-md-4">
                                <x-adminlte-input name="email_director" wire:model.lazy="email_director" type="text"
                                    label="Email Director :" placeholder="Email Director"
                                    class="{{ $this->ValidationState }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-lg fa-envelope text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                        </div>                    </div>
                    <x-slot name="footer">
                        <button type="submit" class="btn btn-primary"  wire:loading.attr="disabled">Agregar</button>
                    </x-slot>

                </x-form-card>
            </form>
        </x-form-card>
    </div>
</div>
