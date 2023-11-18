@props(['column', 'route', 'data'])

@php
    $segment = Str::ucfirst(request()->segment(1));
@endphp

<div class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit {{ $segment }}</h5>
        </div>
        @if ($errors->any())
            <div class="row">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="card-body">
            <form id="userForm" method="POST" action="{{ route($route, $data->id) }}">
                @csrf
                <div class="row mb-2">
                    @foreach ($column as $field)
                        <div class="form-group col-md-6 mb-2">
                            <label for="{{ $field['name'] }}">{{ $field['label'] }}:</label>
                            @if ($field['type'] == 'text')
                                <input type="text" name="{{ $field['name'] }}" id="{{ $field['name'] }}"
                                    placeholder="{{ $field['placeholder'] ?? '' }}" class="form-control"
                                    value="{{ $data->{$field['name']} }}">
                            @elseif ($field['type'] == 'number')
                                <input type="number" name="{{ $field['name'] }}" id="{{ $field['name'] }}"
                                    placeholder="{{ $field['placeholder'] ?? '' }}" class="form-control"
                                    value="{{ $data->{$field['name']} }}">
                            @elseif ($field['type'] == 'select')
                                <select name="{{ $field['name'] }}" id="{{ $field['name'] }}" class="form-control">
                                    <option value="">{{ $field['placeholder'] ?? 'Select ' . $field['label'] }}
                                    </option>
                                    @foreach ($field['options'] as $option)
                                        <option value="{{ $option['value'] }}"
                                            {{ $data->{$field['name']} == $option['value'] ? 'selected' : '' }}>
                                            {{ $option['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            @elseif($field['type'] == 'component')
                                <x-dynamic-component :component="$field['component']" />
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-end">
                    <div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
