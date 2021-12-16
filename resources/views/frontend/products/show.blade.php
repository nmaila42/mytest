@extends('layouts.frontend')
@section('content')

    <div class="container-fluid product-show-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card product-show-card1">
                    <div class="display-4">
                        {{ trans('global.show') }} {{ trans('cruds.product.title') }}
                    </div><hr>
                    <div class="row g-0">
                        <div class="col-md-4 col-sm-12">
                            <div class="card product-show-card2">
                                @if($product->photo)
                                    <a class="product-img" href="{{ $product->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $product->photo->getUrl() }}">
                                    </a>
                                @endif
                                <div class="card-body"></div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{ trans('cruds.product.fields.name') }} :  {{ $product->name }}</li>
                                    <li class="list-group-item">{{ trans('cruds.product.fields.price') }} :  {{ $product->price }}</li>
                                </ul>
                                <div class="card-body">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary product-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        More pictures
                                    </button>
                                        @can('product_show')
                                            <a type="button" class="btn btn-primary product-btn" data-bs-toggle="modal" href="{{ route('frontend.products.edit', $product->slug) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan
                                        @can('product_delete')
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                            </form>
                                        @endcan




                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="card-body">
                                <p class="card-title display-4">{{ trans('cruds.product.fields.description') }}</p><hr>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text">
                                    <small class="text-muted">{{ trans('cruds.product.fields.category') }}
                                        @foreach($product->categories as $key => $category)
                                            <span class="label label-info">{{ $category->name }}</span>
                                        @endforeach
                                    </small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">{{ trans('cruds.product.fields.tag') }}
                                        @foreach($product->tags as $key => $tag)
                                            <span class="label label-info">{{ $tag->name }}</span>
                                        @endforeach
                                    </small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">{{ trans('cruds.product.fields.id') }} :  {{ $product->id }}</small>
                                </p>
                                <a href="{{ route('frontend.products.index') }}" class="btn btn-primary product-btn">{{ trans('global.back_to_list') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
