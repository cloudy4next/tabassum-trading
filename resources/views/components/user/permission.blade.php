@props(['value'])

<div class="row">
    @foreach ($value as $permission)
        <div class="col-md-3">
            <div class="form-check">
                <input type="checkbox" name="permission[]" id="{{ $permission['name'] }}_{{ $permission['id'] }}"
                    value="{{ $permission['name'] }}" class="form-check-input">
                <label for="{{ $permission['name'] }}_{{ $permission['id'] }}" class="form-check-label">
                    {{ $permission['name'] }}
                </label>
            </div>
        </div>
    @endforeach
</div>
