<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Users
    </x-slot:title>

    <div class="content">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Today's Opening Stock</h4>
                    <p class="card-text">Opening Stock: {{ $openingStock }}</p>
                </div>
            </div>

            <h2 class="mt-4">Stock Movements</h2>
            <table class="table table-striped table-responsive">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Quantity In</th>
                    <th>Quantity Out</th>
                    <th>Closing Stock</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($stockMovements as $movement)
                    <tr>
                        <td>{{ $movement->date }}</td>
                        <td>{{ $movement->product->product_name }}</td>
                        <td>{{ $movement->quantity_in }}</td>
                        <td>{{ $movement->quantity_out }}</td>
                        <td>{{ $movement->closing_stock }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-main-layout>
