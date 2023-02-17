<div class="card-body">

    @hasanyrole('employee|admin')
    <div class="text-right">
        <a href="{{ route('vehicle-order.create') }}" class="btn btn-primary mb-3">Order New Vehicle</a>
    </div>
    @endhasanyrole

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">Orderer</th>
                    <th scope="col">Approver</th>
                    <th scope="col">Vehicle</th>
                    <th scope="col">Driver</th>
                    <th scope="col">Purpose</th>
                    <th scope="col">Status</th>
                    {{-- <th scope="col">Action</th> --}}
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($vehicleOrders as $vehicleOrder)
                <tr wire:key='{{ $vehicleOrder->id }}'>
                    <th scope="row">{{ $vehicleOrder->order_number }}</th>
                    <td>{{ $vehicleOrder->orderer?->name }}</td>
                    <td>{{ $vehicleOrder->approver?->name }}</td>
                    <td>{{ $vehicleOrder->vehicle?->name }}</td>
                    <td>{{ $vehicleOrder->driver?->name }}</td>
                    <td>{{ $vehicleOrder->purpose }}</td>
                    <td>
                        @if($vehicleOrder->vehicleOrderApproval->status === 'approved' &&
                        auth()->user()->hasRole('supervisor') && $vehicleOrder->approved_by_supervisor
                        === 'pending')

                        <button class="btn btn-sm m-1 btn-primary"
                            wire:click="supervisorApprove({{ $vehicleOrder->id }})">
                            Approve
                        </button>

                        <button class="btn btn-sm m-1 btn-danger"
                            wire:click="supervisorReject({{ $vehicleOrder->id }})">
                            Reject
                        </button>

                        @elseif($vehicleOrder->vehicleOrderApproval->status === 'pending' &&
                        auth()->user()->id === $vehicleOrder->approver_id)

                        <button class="btn btn-sm m-1 btn-primary"
                            wire:click="approverApprove({{ $vehicleOrder->id }})">
                            Approve
                        </button>

                        <button class="btn btn-sm m-1 btn-danger" wire:click="approverReject({{ $vehicleOrder->id }})">
                            Reject
                        </button>

                        @else
                        {!! $vehicleOrder->status !!}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>