@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Профайл @endslot
    @slot('breadcrumb') Профайл / {{ Auth()->user()->first_name }} @endslot
    @section('side-navigation-content')
        <div class="row">
            <div class="col-xl-4 col-md-6">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <a class="btn btn-primary mb-3" href="{{ route('employee.profile.edit') }}">
                    <i class="fas fa-edit mr-1"></i>
                    Профайл засах
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-5 col-md-8">
                <div class="form-group">
                    <label class="mb-2" for="name">Нэр</label>
                    <input disabled class="form-control py-4" value="{{ Auth()->user()->first_name }}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Овог</label>
                    <input disabled class="form-control py-4" value="{{ Auth()->user()->last_name }}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Имэйл</label>
                    <input disabled class="form-control py-4" value="{{ Auth()->user()->email }}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Утасны дугаар</label>
                    <input disabled class="form-control py-4" value="{{ Auth()->user()->mobile_number }}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Төрөл</label>
                    <input disabled class="form-control py-4" value="{{ Auth()->user()->type->name }}"/>
                </div>
            </div>
        </div>
    @endsection
    @endcomponent
@endsection