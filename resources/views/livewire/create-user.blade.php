<div>
    
    <button type="submit">Guardar Usuario</button>
    </form>

    <button wire:click="showCreateUserForm">Mostrar Formulario</button>
    @if ($showForm)
    <!-- Contenido del formulario de creación de usuario -->
    <form wire:submit.prevent="createUser">
        <!-- Campos del formulario, por ejemplo -->
        <div>
            <label for="name">Nombre:</label>
            <input type="text" id="name" wire:model="name">
        </div>

        <div>
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" wire:model="email">
        </div>

        <!-- Otros campos del formulario según tus necesidades -->

        <button type="submit">Guardar Usuario</button>
    </form>
@endif
</div>
