@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Тайлан @endslot
    @slot('breadcrumb') Тайлан @endslot
    @section('side-navigation-content')
        <div class="row">
            <div class="col-xl-4 col-md-6">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('warning'))
                    <div class="alert alert-warning">
                        {{ session()->get('warning') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col mt-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Хүргэлтийн тайлан
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="shipment-report-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Хүргэлтийн ажилтны код</th>
                                        <th>Нэр</th>
                                        <th>Овог</th>
                                        <th>Хүргэсэн захиалгийн тоо</th>
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