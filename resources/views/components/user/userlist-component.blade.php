<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300 w-full">
                          <thead>
                            <tr>
                              <th class="py-2 px-4 border-b">Id</th>
                              <th class="py-2 px-4 border-b">Nombre</th>
                              <th class="py-2 px-4 border-b">Email</th>
                              <th class="py-2 px-4 border-b">Password</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ( $users as $user)
                              <tr>
                                <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->password }}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      
                </div>
            </div>
        </div>
    </div>
</div>
                      