@extends('layouts.frontend')
@section('content')


    <!--<p class="lead fw-normal text-black-50 mb-0">Contact info here & Your Website 2021</p> -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!--@can('product_create')
                    <div style="margin-bottom: 10px;" class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-success" href="{{ route('frontend.products.create') }}">
                                {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
                            </a>
                        </div>
                    </div>
                @endcan-->
                <div class="card">
                    <div class="card-header">
                        {{ trans('cruds.product.title_singular') }} {{ trans('global.list') }}
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Product">
                                <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.product.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.product.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.product.fields.price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.product.fields.category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.product.fields.tag') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.product.fields.photo') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                                </thead>

                                <p>all products displayed</p>

                                <tbody>

                                @foreach($products as $key => $product)
                                    <tr data-entry-id="{{ $product->id }}">

                                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                                            <div class="col mb-5">
                                                <div class="card h-1">
                                                    <!-- Product image-->
                                                    <img class="card-img-top"
                                                    @if($product->photo)
                                                        <a href="{{ $product->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                            <img src="{{ $product->photo->getUrl('') }}" alt="">
                                                        </a>
                                                @endif
                                                <!-- Product details-->
                                                    <div class="card-body p-4">
                                                        <div class="text-center">
                                                            <!-- Product name-->
                                                            <h5 class="fw-bolder">{{ $product->name ?? '' }}  </h5>
                                                            <!-- Product price-->
                                                            {{ $product->price ?? '' }}
                                                        </div>
                                                    </div>
                                                    <!-- Product actions-->
                                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                        @can('product_show')
                                                            <a class="btn btn-xs btn-primary" href="{{ route('frontend.products.show', $product->slug) }}">
                                                                {{ trans('global.view') }}
                                                            </a>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>



                                            <td>
                                                {{ $product->id ?? '' }}
                                            </td>
                                            <td>
                                                {{ $product->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $product->description ?? '' }}
                                            </td>
                                            <td>
                                                {{ $product->price ?? '' }}
                                            </td>
                                            <td>
                                                @foreach($product->categories as $key => $item)
                                                    <span>{{ $item->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($product->tags as $key => $item)
                                                    <span>{{ $item->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($product->photo)
                                                    <a href="{{ $product->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                        <img src="{{ $product->photo->getUrl('thumb') }}" alt="">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @can('product_show')
                                                    <a class="btn btn-xs btn-primary" href="{{ route('frontend.products.show', $product->slug) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                            </td>
                                        </div>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('product_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('frontend.products.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });
                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')
                        return
                    }
                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan
            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            });
            let table = $('.datatable-Product:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script>
@endsection
