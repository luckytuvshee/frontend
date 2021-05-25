@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Хэрэглэгч @endslot
    @slot('breadcrumb') Хэрэглэгч @endslot
    @section('side-navigation-content')
        <div class="row">
            <div class="col mt-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Хэрэглэгчид
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="users-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Овог</th>
                                        <th>Нэр</th>
                                        <th>Имэйл</th>
                                        <th>Утасны дугаар</th>
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