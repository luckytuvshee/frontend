@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Ажилчид @endslot
    @slot('breadcrumb') Ажилчид @endslot
    @section('side-navigation-content')
        <div class="row">
            <div class="col-xl-4 col-md-6">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <a class="btn btn-primary" href="{{ route('employee.create') }}">
                    <i class="fas fa-plus mr-1"></i>
                    Шинэ ажилтан бүртгэх
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col mt-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Ажилчид
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="employees-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Овог</th>
                                        <th>Нэр</th>
                                        <th>Имэйл</th>
                                        <th>Утасны дугаар</th>
                                        <th>Ажилтаны төрөл</th>
                                        <th>Үйлдэл</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @endcomponent
@endsection