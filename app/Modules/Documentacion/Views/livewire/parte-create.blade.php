<div>
    <x-form-card title="Datos del Origen">
        <div class="form-group">

            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio">
                <label for="customRadio1" class="custom-control-label">Institución</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio">
                <label for="customRadio2" class="custom-control-label">Persona Natural</label>
            </div>

            <x-adminlte-select name="email" wire:model="email" type="email" label="Correo Electrónico :" placeholder="Ej: juan@ssbibio.cl">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-lg fa-university text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-select>

            <x-adminlte-input name="email" wire:model="email" type="email" label="Correo Electrónico :" placeholder="Ej: juan@ssbibio.cl">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-lg fa-envelope text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>


            <x-adminlte-input name="email" wire:model="email" type="email" label="Correo Electrónico :" placeholder="Ej: juan@ssbibio.cl">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-lg fa-phone text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input name="email" wire:model="email" type="email" label="Correo Electrónico :" placeholder="Ej: juan@ssbibio.cl">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-lg fa-mobile text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

        </div>

    </x-form-card>
    <x-form-card title="Datos del Destino">
        <div>

            <x-adminlte-select name="establecimiento_id" wire:model="establecimiento_id" id="establecimiento_id" label="Establecimiento :" class="form-select form-select-sm">
                <option value="">-- Seleccione --</option>
                @foreach ($origenes as $origen)
                <option value="{{ $origen->id }}">{{ $origen->descripcion }}</option>
                @endforeach
            </x-adminlte-select>

            <x-adminlte-input name="email" wire:model="email" type="email" label="Correo Electrónico :" placeholder="Ej: juan@ssbibio.cl">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-lg fa-mobile text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

        </div>
    </x-form-card>
    <x-form-card title="Documentos">
        <x-adminlte-input-file id="ifMultiple" name="ifMultiple[]" label="Upload files" placeholder="Choose multiple files..." igroup-size="lg" legend="Choose" multiple>
            <x-slot name="appendSlot">
                <x-adminlte-button theme="primary" label="Upload" />
            </x-slot>
            <x-slot name="prependSlot">
                <div class="input-group-text text-primary">
                    <i class="fas fa-file-upload"></i>
                </div>
            </x-slot>
        </x-adminlte-input-file>

        {{-- With prepend slot, sm size, and label --}}
        <x-adminlte-textarea name="taDesc" label="Description" rows=5 label-class="text-warning" igroup-size="sm" placeholder="Insert description...">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-dark">
                    <i class="fas fa-lg fa-file-alt text-warning"></i>
                </div>
            </x-slot>
        </x-adminlte-textarea>

    </x-form-card>
</div>
