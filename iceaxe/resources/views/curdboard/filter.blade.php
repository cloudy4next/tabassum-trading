@props(['filters'])

<div class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Filter Options</h5>
        </div>
        <div class="card-body">
            <form id="filterForm" method="GET" action="{{ url()->current() }}">
                <div class="row mb-2">
                    @foreach ($filters as $filter)
                        <div class="form-group col-md-6">
                            <label for="{{ $filter->name }}">{{ $filter->label }}:</label>
                            @if ($filter->type == 'text')
                                <input type="text" name="{{ $filter->name }}" id="{{ $filter->name }}"
                                    placeholder="{{ $filter->placeholder ?? '' }}" class="form-control">
                            @elseif ($filter->type == 'select')
                                <select name="{{ $filter->name }}" id="{{ $filter->name }}" class="form-control">
                                    <option value="">{{ $filter->placeholder ?? 'Select ' . $filter->label }}
                                    </option>
                                    @foreach ($filter->options as $option)
                                        <option value="{{ $option->value }}">{{ $option->label }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" onclick="clearFilters()">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function clearFilters() {
        // Assuming you have form elements with IDs, you can reset them here
        document.getElementById('filterForm').reset();

        // Optionally, you can trigger form submission after clearing the filters
        document.getElementById('filterForm').submit();
    }
</script>
