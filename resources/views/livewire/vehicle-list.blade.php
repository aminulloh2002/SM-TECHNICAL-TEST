<div class="card-body">

    @hasrole('admin')
    <div class="text-right">
        <a href="{{ route('vehicle.create') }}" class="btn btn-primary mb-3">Create New Vehicle</a>
    </div>
    @endhasrole

    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">name</th>
                    <th scope="col">plate</th>
                    <th scope="col">type</th>
                    <th scope="col">fuel consumtion (KM)</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($this->vehicles as $vehicle)
                <tr wire:key='{{ $vehicle->id }}'>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $vehicle->name }}</td>
                    <td>{{ $vehicle->plate }}</td>
                    <td>{{ $vehicle->type }}</td>
                    <td>{{ $vehicle->fuel_per_km }}</td>
                    <td>
                        <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <button wire:click="deleteVehicle({{ $vehicle->id }})"
                            class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>