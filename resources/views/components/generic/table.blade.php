@props(['columns', 'rows', 'actionRoute'])
{{-- @php
    dd(request());
@endphp --}}
<div class="content">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    @foreach ($columns as $column)
                        <th class="text-center">{{ ucfirst($column) }}</th>
                    @endforeach
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rows as $row)
                    <tr>
                        @foreach ($columns as $column)
                            <td class="text-center">{{ $row->{$column} }}</td>
                        @endforeach
                        <td class="text-center">
                            <a href="{{ route($actionRoute[0], $row->id) }}" class="btn btn-sm btn-primary"><i
                                    class="fa fa-eye" aria-hidden="true"></i> View</a>
                            <a href="{{ route($actionRoute[1], $row->id) }}" class="btn btn-sm btn-secondary"><i
                                    class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                            <a href="{{ route($actionRoute[2], $row->id) }}" class="btn btn-sm btn-danger"><i
                                    class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) + 1 }}" class="text-center">No records found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="d-flex justify-content-end">
        {{ $rows->links('pagination.compact') }}
    </div>
</div>
