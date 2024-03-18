<div class="container">
    <x-form-card title="Agregar Documentos">
    <form wire:submit.prevent="Guardar" enctype="multipart/form-data" method="POST" novalidate>
        <x-form-card title="Datos del Origen">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="tipoorigen1" name="tipo_origen" wire:model.live="tipo_origen" value="1">
                            <label for="tipoorigen1" class="custom-control-label">Institución</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="tipoorigen2" name="tipo_origen" value="2" wire:model.live="tipo_origen">
                            <label for="tipoorigen2" class="custom-control-label">Persona Natural</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <x-adminlte-select name="establecimiento_id" wire:model.live="establecimiento_id" id="establecimiento_id" label="Institución o persona natural que envia documento*:" class="{{$this->establecimientoIdValidationState}}" :disabled="$tipo_origen == 2" >
                        <option value="" >-- Seleccione --</option>
                        @foreach ($origenes as $origen)
                        <option value="{{ $origen->id }}">{{ $origen->descripcion }}</option>
                        @endforeach
                    </x-adminlte-select>
                    <x-adminlte-input name="correo" wire:model.blur="correo" type="mail" label="Correo electronico :" placeholder="Ej: nombre@gmail.com" class="{{$this->correoValidationState}}"  >
                        <x-slot name="prependSlot">
                            <div class="input-group-text ">
                                <i class="fas fa-lg fa-envelope text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="telefono_fijo" wire:model.blur="telefono_fijo" type="text" label="Telefono Fijo :" placeholder="(+56) 43 111 1111" class="{{$this->telefonoFijoValidationState}}" >
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-lg fa-phone text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    <x-adminlte-input name="telefono_movil" wire:model.blur="telefono_movil" type="text" label="Telefono Movil :" placeholder="(+56) 9 1111 1111" class="{{$this->telefonoMovilValidationState}}" >
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
            <div class="row" >
                <div class="col-md-6" >
                    {{$isDisabled}}
                    <x-adminlte-select name="establecimiento_destino_id"  wire:model.live="establecimiento_destino_id"  label="Establecimiento :" class="{{$establecimientoDestinoIdValidationState}}" :disabled="$isDisabled" >
                        <option value="">-- Seleccione --</option>
                        @foreach ($destinos as $destino)
                        <option value="{{ $destino->id }}">{{ $destino->descripcion }}</option>
                        @endforeach
                    </x-adminlte-select>
                    <x-adminlte-input name="area_destino" wire:model="area_destino" type="text" label="Area Funcionario :" class="{{$areaDestinoValidationState}}" :disabled="$isDisabled" >
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-lg fa-mobile text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    <x-adminlte-button theme="primary" label="Agregar Destino" wire:click="AgregarDestino" wire:loading.attr="disabled" :disabled="$isDisabled"/>
                </div>
                <div class="col-md-6" wire:loading.remove wire:targer="AgregarDestino">
                    @if($this->lista_destinos)
                    <table class="table table-sm">


                        <tbody>
                            @foreach($this->lista_destinos as $index => $destino)
                            <tr>
                                <td>{{ $this->BuscarNombreDestino(key($destino)) }}</td>
                                <td>{{ current($destino) }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a style="cursor: pointer;"class="text-decoration-none text-danger" wire:click="EliminarDestino({{ $index }})">
                                            <i class="fa fa-trash fa-xs"></i>
                                        </a>
                                    </div>
                                </td>                            
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    @else
                    <div class="alert alert-info text-center">
                        Sin Datos que Mostrar.
                    </div>
                    @endif

                </div>
                <div class="col-md-6" wire:loading wire:targer="AgregarDestino">
                    <div class="d-flex justify-content-center">
                    <i class="fas fa-spinner fa-spin fa-3x fa-fw text-lightblue"></i>
                    </div>
                </div>
            </div>
        </x-form-card>
        <x-form-card title="Documentos">
            <div class="row">
                <div class="col-md-6">
                    @dump($archivos)
                    <x-adminlte-input-file name="archivos" id="archivos" wire:model="archivos" label="Seleccionar los archivos" placeholder="" igroup-size="lg" legend="Buscar" accept=".pdf"
                        x-data="{ archivo: '' }"
                        x-on:input="
                            archivo = $event.target.files[0];
                            if (archivo && archivo.name.substr(archivo.name.lastIndexOf('.') + 1) !== 'pdf') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Solo se permiten archivos PDF.',
                                });
                                $event.target.value = null;
                            }
                        " :disabled="$isDisabledArchivos">
                        <x-slot name="appendSlot">
                        </x-slot>
                    </x-adminlte-input-file>                   
                    <x-adminlte-textarea name="descripcion" wire.model.blur='descripcion' label="Descripcion" rows=5  igroup-size="sm" placeholder="Ingresa una Descripcion de la carga de los Documentos" :disabled="$isDisabledArchivos">
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

                    @if ($archivos)
                        @foreach ($archivos as $archivo)
                            <tr class="dz-image-preview">
                                <td class="text-center">
                                    <span class="preview">
                                        <i class="fas fa-file-alt fa-2x"></i>
                                    </span>
                                </td>
                                <td>
                                    <p class="mb-0">
                                        <span class="lead fs-10">{{ $archivo->getClientOriginalName() }}</span>
                                        (<span><strong>{{ number_format($archivo->getSize() / 1024 / 1024, 2) }}</strong> MB</span>)
                                    </p>
                                    <strong class="error text-danger"></strong>
                                </td>
                                <td>
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group position top-50 start-50 translate-middle">
                                        <button type="button" class="btn btn-warning cancel fs-6" wire:click="$cancelUpload('{{ $archivo->getFilename() }}')"><i class="fas fa-times-circle"></i><span>Cancel</span></button>
                                        <button type="button" class="btn btn-danger delete fs-6" wire:click="EliminarArchivo('{{ $archivo->getFilename() }}')"><i class="fas fa-trash"></i><span>Delete</span></button>                                </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </table>
                </div>
            </div>
        </x-form-card>
   
    <x-slot name="footer">
        <button type="submit" class="btn btn-primary">Agregar</button>
        <!-- Agrega más botones aquí -->
    </x-slot>
</x-form-card> </form>
</div>