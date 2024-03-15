<div>
    <form class="was-validated">
        <x-form-card title="Datos del Origen">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{$tipo_origen}}
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="tipoorigen1" name="tipo_origen" wire:model.live="tipo_origen" value="1">
                            <label for="tipoorigen1" class="custom-control-label">Institución</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="tipoorigen2" name="tipo_origen" value="2" wire:model.live="tipo_origen">
                            <label for="tipoorigen2" class="custom-control-label">Persona Natural</label>
                        </div>
                    </div>
                    {{$establecimiento_id}}
                    <x-adminlte-select name="establecimiento_id" wire:model.live="establecimiento_id" id="establecimiento_id" label="Institución o persona natural que envia documento*:" class="form-select form-select-sm">
                        <option value="">-- Seleccione --</option>
                        @foreach ($origenes as $origen)
                        <option value="{{ $origen->id }}">{{ $origen->descripcion }}</option>
                        @endforeach
                    </x-adminlte-select>

                    <x-adminlte-input name="correo" wire:model="correo" type="mail" label="Correo electronico :" placeholder="Ej: nombre@gmail.com">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-lg fa-envelope text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-6">

                    <x-adminlte-input name="telefono_fijo" wire:model="telefono_fijo" type="text" label="Telefono Fijo :" placeholder="(+56) 43 111 1111">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-lg fa-phone text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>


                    <x-adminlte-input name="telefono_movil" wire:model="telefono_movil" type="text" label="Telefono Movil :" placeholder="(+56) 9 1111 1111">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-lg fa-mobile text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>
        </x-form-card>
        <x-form-card title="Datos del Destino">
            <div class="row">
                <div class="col-md-6">
                    {{$establecimiento_destino_id}}
                    <x-adminlte-select name="establecimiento_destino" wire:model="establecimiento_destino_id" id="establecimiento_destino" label="Establecimiento :" class="form-select form-select-sm">
                        <option value="">-- Seleccione --</option>
                        @foreach ($destinos as $destino)
                        <option value="{{ $destino->id }}">{{ $destino->descripcion }}</option>
                        @endforeach
                    </x-adminlte-select>
                    {{$area_destino}}
                    <x-adminlte-input name="area_destino" wire:model="area_destino" type="text" label="Area Funcionario :" placeholder="Area o Nombre Funcionario Destino">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-lg fa-mobile text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    <x-adminlte-button theme="primary" label="Agregar Destino" wire:click="AgregarDestino" />
                </div>
                <div class="col-md-6">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nombre del Establecimiento</th>
                                <th>Área de Destino</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($this->lista_destinos as $index => $destino)
                            <tr>
                                <td>{{ $this->BuscarNombreDestino(key($destino)) }}</td>
                                <td>{{ current($destino) }}</td>
                                <td>
                                    <button type="button" wire:click="EliminarDestino({{ $index }})">Eliminar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </x-form-card>
        <x-form-card title="Documentos">
            <div class="row">
                <div class="col-md-6">
                    @dump($archivos_temporales)
                    <!-- Contenido de la primera columna -->
                    <x-adminlte-input-file name="archivos" wire:model.live="archivos" label="Seleccionar los archivos" placeholder="Selecionar Documentos" igroup-size="lg" legend="Buscar" multiple>
                        <x-slot name="appendSlot">
                            <x-adminlte-button theme="primary" label="Cargar" />
                        </x-slot>
                    </x-adminlte-input-file>
                    <x-adminlte-textarea name="taDesc" label="Description" rows=5 label-class="text-warning" igroup-size="sm" placeholder="Ingresa una Descripcion de la carga de los Documentos">
                        <x-slot name="prependSlot">
                            <div class="input-group-text ">
                                <i class="fas fa-lg fa-file-alt text-primary"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-textarea>
                </div>
                <div class="col-md-6">
                    {{-- Contenido de la segunda columna mostramos los documentos seleccionados--}}
                    <table class="table table-striped" id="previews">
                        <thead>
                            <tr>
                                <th>Previsualización</th>
                                <th>Nombre</th>
                                <th>Progreso</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        
                        @if ($archivos_temporales)
                            @foreach ($archivos as $archivo)
                                <tr class="dz-image-preview">
                                    <td class="text-center">
                                        <span class="preview">
                                            @if (Str::endsWith($archivo['archivo']->getClientOriginalName(), ['.png', '.jpg', '.jpeg', '.gif']))
                                                <!-- Previsualizar imágenes -->
                                                <img src="{{ $archivo['archivo']->temporaryUrl() }}" alt="{{ $archivo['archivo']->getClientOriginalName() }}" data-dz-thumbnail="" style="max-width: 100px; max-height: 100px;">
                                            @else
                                                <!-- Previsualizar otros archivos -->
                                                <a href="{{ $archivo['archivo']->temporaryUrl() }}">Ver archivo</a>
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            <span class="lead fs-6">{{ $archivo['archivo']->getClientOriginalName() }}</span>
                                            (<span data-dz-size=""><strong>{{ $archivo['archivo']->getSize() / 1024 }}</strong> KB</span>)
                                        </p>
                                        <strong class="error text-danger" ></strong>
                                    </td>
                                    <td>
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;" ></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning cancel fs-6"  wire:click="$cancelUpload('{{ $archivo['hash'] }}')"><i class="fas fa-times-circle"></i><span>Cancel</span></button>
                                            <button type="button" class="btn btn-danger delete fs-6" wire:click="EliminarArchivo('{{ $archivo['hash'] }}')"><i class="fas fa-trash"></i><span>Delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </x-form-card>
    </form>
</div>
