@foreach ( $users as $user)
    <ul>
        <li>
            {{ $user->id }} {{ $user->usuario }} {{ $user->activo }}
        </li>
    </ul>
    
@endforeach