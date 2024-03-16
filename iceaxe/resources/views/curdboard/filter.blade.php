@props(['filters'])
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-search"> </i>  Search</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>

        </div>
    </div>
    <div class="card-body">
        <form id="filterForm" name='filter' method="GET" action="{{ url()->current() }}">
            <div class="row">
                @foreach ($filters as $filter)
                    <div class="form-group col-md-3">
                        <label for="{{ $filter->name }}">{{ $filter->label }}:</label>
                        @if ($filter->type == 'text' || $filter->type == 'select2')
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
            <div class="col-lg-12 mt-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-success float-right">Filter</button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" onclick="clearFilters()">Clear</button>
                    </div>
                </div>
            </div>

        </form>
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
