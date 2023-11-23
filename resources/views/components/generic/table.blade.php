@props(['columns', 'rows', 'filters', 'buttons'])

<x-generic.filter :filters="$filters" />

<div class="content">
    {{-- @php
        dd($button->name);
    @endphp --}}
    @foreach ($buttons as $button)
        @if ($button->name == 'new' || $button->name == 'custom')
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route($button->routeName) }}" class="btn btn-sm btn-primary">{{ $button->label }}</a>
            </div>
        @endif
    @endforeach

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    @foreach ($columns as $column)
                        <th class="text-center">{{ ucwords(str_replace('_', ' ', $column->name)) }}</th>
                    @endforeach
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rows as $row)
                    <tr>
                        @foreach ($columns as $column)
                            <td class="text-center">{{ $row->{$column->name} }}</td>
                        @endforeach
                        <td class="text-center">
                            @foreach ($buttons as $button)
                                @switch($button)
                                    @case($button->name == 'edit')
                                        <a href="{{ route($button->routeName, $row->id) }}" class="btn btn-sm btn-secondary"><i
                                                class="fa fa-pencil fa-sm" aria-hidden="true"></i>
                                            {{ $button->label }}</a>
                                    @break

                                    @case($button->name == 'view')
                                        <a href="{{ route($button->routeName, $row->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye fa-sm" aria-hidden="true"></i>{{ $button->label }}</a>
                                    @break

                                    @case($button->name == 'delete')
                                        <a href="{{ route($button->routeName, $row->id) }}" class="btn btn-sm btn-danger"><i
                                                class="fa fa-trash fa-sm" aria-hidden="true"></i>
                                            {{ $button->label }}</a>
                                    @break
                                @endswitch
                            @endforeach
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
