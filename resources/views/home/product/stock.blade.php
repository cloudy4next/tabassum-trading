<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Product Stock Update
    </x-slot:title>

    <div class="content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <h5 class="text-center">Update Product Stock for: <strong>{{ $product['name'] }}</strong></h5>

                            <form action="{{ route('product.stock.update') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                        <input type="text" name="id" id="{{ $product['id'] }}" value="{{ $product['id'] }}" class="form-control" hidden></input>
                                </div>

                                <div class="form-group">
                                    <label for="quantity_in">Quantity In</label>
                                    <input type="number" name="quantity_in" id="quantity_in" class="form-control">
                                </div>


                                <button type="submit" class="btn btn-primary mt-lg-4">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-main-layout>
