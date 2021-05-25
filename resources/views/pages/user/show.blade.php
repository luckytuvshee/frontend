@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Хэрэглэгч @endslot
    @slot('breadcrumb') Хэрэглэгч / {{ $user->email }} @endslot
    @section('side-navigation-content')
        <a class="btn btn-primary mb-3" href="{{ route('user.edit', ['id' => $user->id]) }}">
            <i class="fas fa-edit mr-1"></i>
            Хэрэглэгчийн мэдээлэл өөрчлөх
        </a>
        <div class="row">
            <div class="col-xl-5 col-md-8">
                <div class="form-group">
                    <label class="mb-2" for="name">Хэрэглэгчийн овог</label>
                    <input disabled class="form-control py-4" value="{{ $user->last_name }}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Хэрэглэгчийн нэр</label>
                    <input disabled class="form-control py-4" value="{{ $user->first_name }}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Имэйл</label>
                    <input disabled class="form-control py-4" value="{{ $user->email }}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Утасны дугаар</label>
                    <input disabled class="form-control py-4" value="{{ $user->mobile_number }}"/>
                </div>
            </div>
        </div>
    @endsection
    @endcomponent
@endsection