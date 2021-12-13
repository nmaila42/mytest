@extends('products.index')
@section('content')

    @foreach($products as $key => $product)
        <tr data-entry-id="{{ $product->id }}">

            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <div class="col mb-5">
                    <div class="card h-1">
                        <!-- Product image-->
                        <img class="card-img-top"
                        @if($product->photo)
                            <a href="{{ $product->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $product->photo->getUrl('thumb') }}" alt="">
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
                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.products.show', $product->id) }}">
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
                        <a class="btn btn-xs btn-primary" href="{{ route('frontend.products.show', $product->id) }}">
                            {{ trans('global.view') }}
                        </a>
                    @endcan

                    @can('product_edit')
                        <a class="btn btn-xs btn-info" href="{{ route('frontend.products.edit', $product->id) }}">
                            {{ trans('global.edit') }}
                        </a>
                    @endcan

                    @can('product_delete')
                        <form action="{{ route('frontend.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                        </form>
                    @endcan

                </td>
            </div>>
        </tr>
    @endforeach

@endsection
