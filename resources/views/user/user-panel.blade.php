@foreach ( $users as $user)
    <ul>
        <li>
            {{ $user->id }} {{ $user->usuarui }} {{ $user->activo }}
        </li>
    </ul>
    
@endforeach