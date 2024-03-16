@props(['title'])

{{--@dd($form)--}}
<div class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ Str::title($title) }} </h5>
        </div>
        <div class="card-body">
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
                <form id="userForm" method={{ $form->getActionMethod() }} action="{{ route($form->getActionRoute()) }}">
                    @csrf
                    <div class="row">
                        @foreach ($form->getColums() as $field)
                            <div class="{{ $field->getClassAttribute() }} mb-2">
                                <label for="{{ $field->name }}">{{ $field->label }}:</label>
                                @switch($field->type)

                                    @case($field->type == 'hidden')
                                        <input type="hidden" name="{{ $field->name  }}" id="{{ $field->name }}" value="{{ $field->value }}">
                                        @break
                                    @case($field->type == 'select')
                                        <select name="{{ $field->name }}" id="{{ $field->name }}" class="form-control" required>
                                            <option
                                                value="">{{ $field->placeHolder ?? 'Select ' . $field->label }}</option>
                                            @foreach ($field->options as $key =>$value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @break
                                        <!-- Add other form inputs here -->
                                    @case($field->type == 'select2')
                                        <select name="{{ $field->name }}" id="{{ $field->name }}" class="form-control" required>
                                            <option
                                                value="">{{ $field->placeHolder ?? 'Select ' . $field->label }}</option>
                                            @foreach ($form->getRelationalData($field->getFeatureBuilder()->getModel(),$field->getFeatureBuilder()->getAttribute()) as $key =>$value)
                                                <option
                                                    value="{{ $value->id }}">{{ $value->{$field->getFeatureBuilder()->getAttribute()} }}</option>
                                            @endforeach
                                        </select>
                                        @break
                                    @case($field->type == 'component')
                                        <x-dynamic-component :component="$field->component"
                                                             :value="$field->value ?? null"/>
                                        @break
                                    @case($field->type == 'date')
                                        <input type="date" name="{{ $field->name }}" id="{{ $field->name }}"
                                               placeholder="{{ $field->placeHolder ?? '' }}" class="form-control">
                                        @break
                                    @case($field->type == 'datetime')
                                        <input type="datetime-local" name="{{ $field->name }}" id="{{ $field->name }}"
                                               placeholder="{{ $field->placeHolder ?? '' }}" class="form-control">
                                        @break
                                    @case($field->type == 'password')
                                        <input type="password" name="{{ $field->name }}" id="{{ $field->name }}"
                                               placeholder="{{ $field->placeHolder ?? '' }}" class="form-control">
                                        @break
                                    @case($field->type == 'number')
                                        <input type="number" name="{{ $field->name }}" id="{{ $field->name }}"
                                               placeholder="{{ $field->placeHolder ?? '' }}" class="form-control">
                                        @break
                                    @default
                                        <input type="text" name="{{ $field->name }}" id="{{ $field->name }}"
                                               placeholder="{{ $field->placeHolder ?? '' }}" class="form-control">
                                        @break
                                @endswitch
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>

</div>
