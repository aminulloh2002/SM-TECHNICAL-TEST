<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Orderer Name</th>
            <th>Driver Name</th>
            <th>Approver Model</th>
            <th>Purpose</th>
            <th>Travel Distance</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicleOrders as $order)
        <tr>
            <td>{{ $order->order_number }}</td>
            <td>{{ $order->orderer->name }}</td>
            <td>{{ $order->driver->name }}</td>
            <td>{{ $order->approver->name }}</td>
            <td>{{ $order->purpose }}</td>
            <td>{{ $order->travel_distance}}</td>
            <td>{{ $order->start_date }}</td>
            <td>{{ $order->end_date }}</td>
            <td>{{ $order->approved_by_supervisor }}</td>
        </tr>
        @endforeach
    </tbody>
</table>