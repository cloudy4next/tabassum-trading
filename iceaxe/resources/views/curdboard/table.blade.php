@props(['columns', 'rows', 'filters', 'buttons'])

<div class="content">
    <x-native-cloud::curd-board-filter :filters="$grid->getFilter()" />

    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <div class="input-group mr-2">
                    @foreach ($grid->getButtons() as $button)
                        @if ($button->name == 'new' || $button->name == 'custom')
                            <div class="float-right">
                                <a href="{{ route($button->routeName) }}" class="btn btn-sm btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top">{{ $button->label }}</a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>

                        @foreach ($grid->getColumns() as $column)
                            <th scope="col" class="text-center">{{ ucwords(str_replace('_', ' ', $column->label)) }}</th>
                        @endforeach
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($grid->getData() as $k=>$row)
                        <tr>
                            <th scope="row">{{ $k + 1 }}</th>
                            @foreach ($grid->getColumns() as $column)
                                @switch($column->getType())
                                    @case($column->getType() == 'select2')
                                        <td scope="col" class="text-center">
                                            {{ $row->{$column->getFeatureBuilder()->getEntity()}[0]->{$column->getFeatureBuilder()->getAttribute()} }}
                                        </td>
                                    @break

                                    @default
                                        {{--  @dd($column->name,$row); --}}
                                        <td class="text-center">{{ $row->{$column->name} }}</td>
                                @endswitch
                            @endforeach
                            <td class="text-center ">
                                @foreach ($grid->getButtons() as $button)
                                    @switch($button)
                                        @case($button->name == 'edit')
                                            <a href="{{ route($button->routeName, $row->id) }}"
                                                class="btn btn-sm btn-secondary"><i class="fa fa-pencil fa-sm"
                                                    aria-hidden="true"></i>
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
                                            <a href="{{ route($button->routeName, $row->id) }}"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash fa-sm"
                                                    aria-hidden="true"></i>
                                                {{ $button->label }}</a>
                                        @break
                                    @endswitch
                                @endforeach
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($grid->getColumns()) + 1 }}" class="text-center">No records found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {{ $grid->getData()->links('native-cloud::pagination.compact') }}

            </div>
        </div>
    </div>
