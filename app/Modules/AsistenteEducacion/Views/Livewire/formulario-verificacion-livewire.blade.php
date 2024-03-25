<div>
    
        <div class="container w-50">
            <x-form-card title="Verificación de usuario">
                <form wire:submit.prevent="verificarSolicitud">
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input name="rut_establecimiento" wire:model.lazy="rut_establecimiento" type="text"
                                label="RUT del Establecimiento :" placeholder="Introduce el RUT del establecimiento"
                                :disabled=$disabled class="{{ $ValidationState }}">
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="rbd_establecimiento" wire:model.lazy="rbd_establecimiento"
                                type="text" label="RBD del Establecimiento :"
                                placeholder="Introduce el RBD del establecimiento" :disabled=$disabled
                                class="{{ $ValidationState }}">
                            </x-adminlte-input>
                        </div>
                    </div>
                    @if (!$validacionExitosa)
                        <x-adminlte-button class="btn-flat" type="submit" label="Verificar" theme="success"
                            :disabled="$errors->has('rut_establecimiento') || $errors->has('rbd_establecimiento')" />
                    @endif
                </form>
            </x-form-card>
        </div>
    
    @if($mostrarFormulario == 2)
    <livewire:AsistenteEducacion::Livewire.MvSolicitudEstab.CreateLivewire :rut_establecimiento=$rut_establecimiento :rbd_establecimiento=$rbd_establecimiento />
    @endif
    @if($mostrarFormulario == 1)
    <livewire:AsistenteEducacion::Livewire.MvSolicitudCambioDirector.createLivewire :rut_establecimiento=$rut_establecimiento :rbd_establecimiento=$rbd_establecimiento />
    @endif
</div>

