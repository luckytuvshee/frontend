@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Сагсны дэлгэрэнгүй мэдээлэл @endslot
    @slot('breadcrumb') Сагсны дэлгэрэнгүй мэдээлэл @endslot
    @section('side-navigation-content')
    <a href="{{ route('baskets') }}" class="alert alert-dark" style="text-decoration: none">Буцах</a>
        <div class="row mt-4">
            <div class="col-xl-5 col-md-8">
                @if (count($basketItems) == 0)
                    <h3>Сагс хоосон байна</h3>
                @endif

                @foreach ($basketItems as $item)
                    <h3>{{ $item->product_registration->product->product_name }}</h3>

                    <div class="form-group">
                        <label class="mb-2" for="name">Хэмжээ</label>
                        <input disabled class="form-control py-4" value="{{ $item->product_registration->size->size }}"/>
                    </div>

                    <div class="form-group">
                        <label class="mb-2" for="name">Өнгө</label>
                        <input disabled class="form-control py-4" value="{{ $item->product_registration->color->color }}"/>
                    </div>

                    <div class="form-group">
                        <label class="mb-2" for="name">Тоо ширхэг</label>
                        <input disabled class="form-control py-4" value="{{ $item->quantity }}"/>
                    </div>

                    <div class="form-group">
                        <label class="mb-2" for="name">Зураг</label>
                        <img class="d-block w-100 img-thumbnail" src="{{ url($item->product_registration->color_image) }}" alt="product_registration_image">
                    </div>

                    <hr />
                @endforeach
            </div>
        </div>
    @endsection
    @endcomponent
@endsection