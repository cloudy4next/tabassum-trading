<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Users
    </x-slot:title>

    <div class="content">
{{--        @dd($openingStock);--}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title text-center">@php echo(\Carbon\Carbon::today())@endphp</h6>
                </div>
            </div>

            <h2 class="mt-4">Stock Movements</h2>
            <table class="table table-striped table-responsive">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Month Opening</th>
                    <th>Day Opening</th>
                    {{--                    <th>Day Received</th>--}}
                    <th>Total Received</th>
                    <th>Total Stock</th>
                    <th>Day Sale</th>
                    <th>Total Sale</th>
                    <th>Closing Stock</th>
                </tr>
                </thead>
                <tbody>


                @php
                    $total_monthly_opening_stock = 0;
                    $total_daily_opening_stock = 0;
                    $total_total_received = 0;
                    $total_stock = 0;
                    $total_quantity_out = 0;
                    $total_total_sold = 0;
                    $total_daily_closing_stock = 0;
                @endphp

                @foreach ($stockMovements as $movement)
                    <tr>
                        <td>{{ $movement->product->name }}</td>
                        <td>{{ $movement->monthly_opening_stock }}</td>
                        <td>{{ $movement->daily_opening_stock }}</td>
                        <td>{{ $movement->total_received }}</td>
                        <td>{{ $movement->stock }}</td>
                        <td>{{ $movement->quantity_out }}</td>
                        <td>{{ $movement->total_sold }}</td>
                        <td>{{ $movement->daily_closing_stock }}</td>

                        @php
                            $total_monthly_opening_stock += $movement->monthly_opening_stock;
                            $total_daily_opening_stock += $movement->daily_opening_stock;
                            $total_total_received += $movement->total_received;
                            $total_stock += $movement->stock;
                            $total_quantity_out += $movement->quantity_out;
                            $total_total_sold += $movement->total_sold;
                            $total_daily_closing_stock += $movement->daily_closing_stock;
                        @endphp
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Total</th>
                    <th>{{ $total_monthly_opening_stock }}</th>
                    <th>{{ $total_daily_opening_stock }}</th>
                    <th>{{ $total_total_received }}</th>
                    <th>{{ $total_stock }}</th>
                    <th>{{ $total_quantity_out }}</th>
                    <th>{{ $total_total_sold }}</th>
                    <th>{{ $total_daily_closing_stock }}</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Stock Value</th>
                    <td></td>
                    <td>123</td>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Today's Upfront</th>
                    <td></td>
                    <td
                    ">123</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>


</x-main-layout>
