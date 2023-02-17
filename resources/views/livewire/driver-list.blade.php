<div class="card-body">

    @hasrole('admin')
    <div class="text-right">
        <a href="{{ route('driver.create') }}" class="btn btn-primary mb-3">Add Driver</a>
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
                    <th scope="col">phone</th>
                    <th scope="col">address</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($this->drivers as $vehicle)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $vehicle->name }}</td>
                    <td>{{ $vehicle->phone }}</td>
                    <td>{{ $vehicle->address }}</td>
                    <td>
                        <a href="{{ route('driver.edit', $vehicle->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <button wire:click="deleteDriver({{ $vehicle->id }})"
                            class="btn btn-sm btn-danger">Delete</button>
                    </td>

                    @endforeach
            </tbody>
        </table>
    </div>

</div>