<x-native-cloud::layout.main>

    <x-slot:title>
        Daily Stock
    </x-slot:title>

    <div class="content">
        <div class="col-md-12">

            <h2 class="mt-4 text-center">Stock Movements</h2>

            <div class="card-body table-responsive p-0">
                <table class="table tableSortable ">
                    <thead>
                    <tr class="thead-dark">
                        <th class="text-center">Product</th>
                        <th class="text-center">Month Opening</th>
                        <th class="text-center">Day Opening</th>
                        {{--                    <th>Day Received</th>--}}
                        <th class="text-center">Total Received</th>
                        <th class="text-center"class="text-center">Total Stock</th>
                        <th class="text-center">Day Sale</th>
                        <th class="text-center">Total Sale</th>
                        <th class="text-center">Closing Stock</th>
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
                        $total_daily_closing_stock_price = 0;
                        $total_daily_closing_stock_upfront = 0;
                    @endphp

                    @foreach ($stockMovements as $movement)
                        <tr>
                            <td class="text-center">{{ $movement->product->name }}</td>
                            <td class="text-center">{{ $movement->monthly_opening_stock }}</td>
                            <td class="text-center">{{ $movement->daily_opening_stock }}</td>
                            <td class="text-center">{{ $movement->total_received }}</td>
                            <td class="text-center">{{ $movement->stock }}</td>
                            <td class="text-center">{{ $movement->quantity_out }}</td>
                            <td class="text-center">{{ $movement->total_sold }}</td>
                            <td class="text-center">{{ $movement->daily_closing_stock }}</td>

                            @php
                                $single_product = $movement->product->dp * $movement->daily_closing_stock;
                                $single_upfront = $movement->product->upfront * $movement->quantity_out;
                                $total_daily_closing_stock_upfront += $single_upfront;
                                $total_daily_closing_stock_price += $single_product;
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

                    <tfoot class="thead-white">
                    <tr>
                        <th class="text-center">Total</th>
                        <th class="text-center">{{ $total_monthly_opening_stock }}</th>
                        <th class="text-center">{{ $total_daily_opening_stock }}</th>
                        <th class="text-center">{{ $total_total_received }}</th>
                        <th class="text-center">{{ $total_stock }}</th>
                        <th class="text-center">{{ $total_quantity_out }}</th>
                        <th class="text-center">{{ $total_total_sold }}</th>
                        <th class="text-center">{{ $total_daily_closing_stock }}</th>

                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="text-center">Stock Value</th>
                        <td></td>
                        <td class="text-center">{{$total_daily_closing_stock_price}}</td>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="text-center">Today's Upfront</th>
                        <td></td>
                        <td class="text-center">{{$total_daily_closing_stock_upfront}}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</x-native-cloud::layout.main>
