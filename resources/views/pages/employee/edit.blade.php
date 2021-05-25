@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Ажилчны мэдээлэл засах @endslot
    @slot('breadcrumb') Ажилчны мэдээлэл засах / {{ $employee->first_name }} @endslot
    @section('side-navigation-content')
        <div class="row">
            <div class="col-xl-5 col-md-8">
                <form method="POST" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data">           
                    @csrf
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        Оролтын утга алдаатай байна <br><br>
                        <ul>                        
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="mb-2" for="name">Нэр</label>
                        <input class="form-control py-4 @error('first_name') is-invalid @enderror" id="first_name" type="text" 
                        name="first_name" value="{{ old('first_name', $employee->first_name) }}" required autocomplete="first_name" autofocus/>
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="name">Овог</label>
                        <input class="form-control py-4 @error('last_name') is-invalid @enderror" id="last_name" type="text" 
                        name="last_name" value="{{ old('last_name', $employee->last_name) }}" required autocomplete="last_name" autofocus/>
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="name">Имэйл</label>
                        <input class="form-control py-4 @error('email') is-invalid @enderror" id="email" type="email" 
                        name="email" value="{{ old('email', $employee->email) }}" required autocomplete="email" autofocus/>
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="name">Утасны дугаар</label>
                        <input class="form-control py-4 @error('mobile_number') is-invalid @enderror" id="mobile_number" type="number" 
                        name="mobile_number" value="{{ old('mobile_number', $employee->mobile_number) }}" required autocomplete="mobile_number" autofocus/>
                    </div>
                    <div class="form-group">
                        <label class="small mb-1" for="password">Нууц үг</label>
                        <input class="form-control py-4 @error('password') is-invalid @enderror" id="password" type="password" 
                        name="password" autocomplete="new-password" />

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="small mb-1" for="password-confirm">Нууц үг давтах</label>
                        <input class="form-control py-4 @error('password') is-invalid @enderror" id="password-confirm" type="password" 
                        name="password_confirmation" autocomplete="new-password" />

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="type">Ажилтны төрөл</label>
                        <select class="form-control" name="type" id="type">
                            <option disabled selected>Ажилтны төрөл сонгох</option>
                            @foreach ($employee_types as $item)
                                @if (old('type') == $item->id . '. ' . $item->name || $item->id == $employee->type->id)
                                    <option selected>{{$item->id . '. ' . $item->name}}</option>
                                @else
                                    <option>{{$item->id . '. ' . $item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>                   
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-md">
                            Ажилтны мэдээлэл өөрчлөх
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
    @endcomponent
@endsection