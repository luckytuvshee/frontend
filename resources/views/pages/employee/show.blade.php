@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Ажилчин @endslot
    @slot('breadcrumb') Ажилчин / {{ $employee->first_name }} @endslot
    @section('side-navigation-content')
        <a class="btn btn-primary mb-3" href="{{ route('employee.edit', ['id' => $employee->id]) }}">
            <i class="fas fa-edit mr-1"></i>
            Ажилчны мэдээлэл өөрчлөх
        </a>
        <div class="row">
            <div class="col-xl-5 col-md-8">
                <div class="form-group">
                    <label class="mb-2" for="name">Нэр</label>
                    <input disabled class="form-control py-4" value="{{ $employee->first_name }}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Овог</label>
                    <input disabled class="form-control py-4" value="{{ $employee->last_name }}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Имэйл</label>
                    <input disabled class="form-control py-4" value="{{ $employee->email }}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Утасны дугаар</label>
                    <input disabled class="form-control py-4" value="{{ $employee->mobile_number }}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2" for="name">Төрөл</label>
                    <input disabled class="form-control py-4" value="{{ $employee->type->name }}"/>
                </div>
            </div>
        </div>
    @endsection
    @endcomponent
@endsection