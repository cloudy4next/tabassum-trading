@props(['columns', 'rows', 'filters', 'buttons'])

<x-native-cloud::curd-board-filter :filters="$grid->getFilter()"/>

{{--@dd($grid);--}}
<div class="content">

    @foreach ($grid->getButtons() as $button)
        @if ($button->name == 'new' || $button->name == 'custom')
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route($button->routeName) }}" class="btn btn-sm btn-primary">{{ $button->label }}</a>
            </div>
        @endif
    @endforeach

    <div class="table-responsive">
        <table class="table table-hover nowrap rounded card-table table-vcenter card d-table shadow-xs border-xs">
            <thead class="thead-dark">
            <tr>
                @foreach ($grid->getColumns() as $column)
                    <th class="text-center">{{ ucwords(str_replace('_', ' ', $column->label)) }}</th>
                @endforeach
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($grid->getData() as $row)
                <tr>
                    @foreach ($grid->getColumns() as $column)
                        @switch($column->getType())
                            @case($column->getType() == 'select2')
                                <td class="text-center">{{ $row->{$column->getFeatureBuilder()->getEntity()}[0]->{$column->getFeatureBuilder()->getAttribute()} }}</td>
                                @break

                            @default
                                <td class="text-center">{{ $row->{$column->name} }}</td>
                        @endswitch

                    @endforeach
                    <td class="text-center ">
                        @foreach ($grid->getButtons() as $button)
                            @switch($button)
                                @case($button->name == 'edit')
                                    <a href="{{ route($button->routeName, $row->id) }}"
                                       class="btn btn-sm btn-secondary"><i
                                            class="fa fa-pencil fa-sm" aria-hidden="true"></i>
                                        {{ $button->label }}</a>
                                    @break

                                @case($button->name == 'view')
                                    <a href="{{ route($button->routeName, $row->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye fa-sm" aria-hidden="true"></i>{{ $button->label }}</a>
                                    @break

                                @case($button->name == 'inline')
                                    <a href="{{ route($button->routeName, $row->id) }}" class="btn btn-sm btn-info">
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
                    <td colspan="{{ count($grid->getColumns()) + 1 }}" class="text-center">No records found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end">
        {{ $grid->getData()->links('native-cloud::pagination.compact') }}
    </div>
</div>
