@props(['title'])


{{--@dd($form->getData())--}}
<div class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ Str::title($title) }}</h5>
        </div>
        <div class="card-body">
            <div class="card-body">
                <form id="userForm" method="POST" action="{{ route($form->getActionRoute()) }}">
                    @csrf
                    <div class="row ">
                        <input type="hidden" id="id" name="id" value={{ $form->getData()['id'] }}>
                        @foreach ($form->getColums() as $field)
                            <div class="{{ $field->getClassAttribute() }} mb-2">
                                <label for="{{ $field->name }}">{{ $field->label }} @if($field->isRequired())
                                        <span class="required" style="color: red">* </span>
                                    @endif:</label>
                                @switch($field->type)
                                    @case('select')
                                        <select name="{{ $field->name }}" id="{{ $field->name }}" class="form-control">
                                            <option value="">{{ $field->placeholder ?? 'Select ' . $field->label }}
                                            </option>
                                            @foreach ($field->options as $option)
                                                <option value="{{ $option['value'] }}"
                                                    {{ old($field->name, $form->getData()[$field->name] ?? '') == $option['value'] ? 'selected' : '' }}>
                                                    {{ $option['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @break
                                    @case($field->type =='checkbox')
                                        <input type="{{ $field->type }}"
                                               name="{{ $field->name }}"
                                               id="{{ $field->name }}"
                                               value="1"
                                               class="form-check-input"
                                               @if(old($field->name, $form->getData()[$field->name] ?? null) == 1)
                                                   checked
                                            @endif>

                                        @break


                                    @case('component')
                                        @foreach ($form->getComponentData() as $key => $value)
                                            @if ($key == $field->component)
                                                <x-dynamic-component :component="$field->component"
                                                                     :value="$field->value" :field=$value/>
                                                    @endif
                                                    @endforeach
                                                    @break

                                                    @default
                                                        <input type="{{ $field->type }}" name="{{ $field->name }}"
                                                               id="{{ $field->name }}"
                                                               value="{{ old($field->name, $form->getData()[$field->name] ?? '') }}"
                                                               class="form-control">
                                                @break
                                                @endswitch
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
</div>
