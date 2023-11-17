@props(['columns', 'rows', 'actionRoute', 'filters', 'button'])

<x-generic.filter :filters="$filters" />

<div class="content">

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route($button['new']) }}" class="btn btn-sm btn-primary">New</a>
    </div>

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
                            @if (isset($actionRoute['view']))
                                <a href="{{ route($actionRoute['view'], $row->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-eye fa-sm" aria-hidden="true"></i> View</a>
                            @endif
                            @if (isset($actionRoute['edit']))
                                <a href="{{ route($actionRoute['edit'], $row->id) }}"
                                    class="btn btn-sm btn-secondary"><i class="fa fa-pencil fa-sm" aria-hidden="true"></i>
                                    Edit</a>
                            @endif
                            @if (isset($actionRoute['delete']))
                                <a href="{{ route($actionRoute['delete'], $row->id) }}"
                                    class="btn btn-sm btn-danger"><i class="fa fa-trash fa-sm" aria-hidden="true"></i> Delete</a>
                            @endif
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
