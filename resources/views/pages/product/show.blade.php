@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Бараа @endslot
    @slot('breadcrumb') Бараа / {{ $product->product_name }} @endslot
    @section('side-navigation-content')
        <a class="btn btn-primary mb-3" href="{{ route('product.edit', ['id' => $product->id]) }}">
            <i class="fas fa-edit mr-1"></i>
            Барааг засах
        </a>
        <div class="row">
            <div class="col-xl-5 col-md-8">
                <div class="form-group">
                    <label class="mb-2" for="name">Барааны нэр</label>
                    <input disabled class="form-control py-4" value="{{ $product->product_name }}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Төрөл</label>
                    <input disabled class="form-control py-4" value="{{ $product->type->type_name }}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Тайлбар</label>
                    <textarea class="form-control py-1" cols="30" rows="5" disabled>{{ $product->description }}
                    </textarea>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Үнэ ₮</label>
                    <input disabled class="form-control py-4" value="{{ $product->price }}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Тоо ширхэг</label>
                    <input disabled class="form-control py-4" value="{{ $product->quantity }}"/>
                </div>
            </div>
            <div class="col-xl-5 col-md-8">
                <div class="form-group">
                    <label class="mb-2" for="name">Нүүр зураг</label>
                    <img class="img-thumbnail" src="{{ url($product->image) }}" alt="product-image">
                </div>
                <label class="mb-2" for="name">Бусад зурагнууд</label>
                <div id="product-images-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach (explode('\\', $product->images) as $image)
                        <li data-target="#product-images-carousel" data-slide-to="2"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">

                        @foreach (explode('\\', $product->images) as $image)
                            @if ($loop->iteration == 1)
                            <div class="carousel-item active">
                                <img class="d-block w-100 img-thumbnail" src="{{ url($image) }}" alt="slide">
                            </div>
                            @else
                            <div class="carousel-item">
                                <img class="d-block w-100 img-thumbnail" src="{{ url($image) }}" alt="slide">
                            </div>
                            @endif
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-images-carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#product-images-carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    @endsection
    @endcomponent
@endsection