<div class="row col-md-12">
    @foreach($products as $product)
        <div class="col-md-2">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="form-group">
                        <label for="qty_{{ $product->id }}"><strong>{{ $product->name }}</strong>  </label>
                        <input type="text" id="qty_{{ $product->id }}" name="quantities[{{ $product->id }}]" class="form-control" value="0" pattern="\d*" title="Please enter only digits" required>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
