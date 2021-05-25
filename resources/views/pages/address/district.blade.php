@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Хаяг @endslot
    @slot('breadcrumb') Дүүрэг @endslot
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#district_add_modal">
                    <strong>Дүүрэг нэмэх</strong>
                </button>

                <!-- Edit Modal -->
                <div class="modal fade" id="district_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Дүүргийн мэдээлэл өөрчлөх</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('district.edit') }}" enctype="multipart/form-data">  
                                @csrf 
                                <input type="hidden" name="district_id" id="district_id">
                                <div class="form-group">
                                    <label class="mb-2" for="name">Дүүргийн нэр</label>
                                    <input class="form-control py-4" id="district_name" type="text" name="district_name" required autofocus/>
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
                <div class="modal fade" id="district_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Дүүрэг устгах</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{ route('district.delete') }}">
                                @csrf
                                @method('delete')
                                <div class="modal-body">
                                    Та <strong id="district_name"></strong> дүүргийг устгахдаа итгэлтэй байна уу?
                                    <input type="hidden" name="district_id" id="district_id">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Үгүй</button>
                                    <button type="submit" class="btn btn-danger">Тийм</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Add Modal -->
                <div class="modal fade" id="district_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Шинэ дүүрэг нэмэх</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('district.add', ['id' => request()->route('id')] )}}" enctype="multipart/form-data">   
                                <div class="form-group">
                                    <label class="mb-2" for="name">Дүүргийн нэр</label>
                                    <input class="form-control py-4" id="name" type="text" name="district_name" required autofocus/>
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
                        Дүүрэг
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="districts-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Дүүргийн код</th>
                                        <th>Хотын нэр</th>
                                        <th>Дүүргийн нэр</th>
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