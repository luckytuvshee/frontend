@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Хаяг @endslot
    @slot('breadcrumb') Хот @endslot
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
            <div class="col">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#city_add_modal">
                    <strong>Хот нэмэх</strong>
                </button>

                <!-- Add Modal -->
                <div class="modal fade" id="city_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Шинэ хот нэмэх</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('city.add')}}" enctype="multipart/form-data">   
                                <div class="form-group">
                                    <label class="mb-2" for="name">Хотын нэр</label>
                                    <input class="form-control py-4" id="name" type="text" name="city_name" required autofocus/>
                                </div>
                                <div class="form-group modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                                    <button type="submit" class="btn btn-primary">
                                        Нэмэх
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="card mb-4 mt-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Хот
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="city_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Хотын мэдээлэл өөрчлөх</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('city.edit') }}" enctype="multipart/form-data">  
                                    @csrf 
                                    <input type="hidden" name="city_id" id="city_id">
                                    <div class="form-group">
                                        <label class="mb-2" for="name">Хотын нэр</label>
                                        <input class="form-control py-4" id="city_name" type="text" name="city_name" required autofocus/>
                                    </div>
                                    <div class="form-group modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                                        <button type="submit" class="btn btn-primary">
                                            Хадгалах
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="city_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Хот устгах</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('city.delete') }}">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">
                                        Та <strong id="city_name"></strong> хотыг устгахдаа итгэлтэй байна уу?
                                        <input type="hidden" name="city_id" id="city_id">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Үгүй</button>
                                        <button type="submit" class="btn btn-danger">Тийм</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="cities-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Хотын код</th>
                                        <th>Хотын нэр</th>
                                        <th>Үүсгэсэн огноо</th>
                                        <th>Өөрчилсөн огноо</th>
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