@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Шинэ ажилтан бүртгэх @endslot
    @slot('breadcrumb') Шинэ ажилтан бүртгэх @endslot
    @section('side-navigation-content')
        <div class="row">
            <div class="col-xl-5 col-md-8">
                <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data">           
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
                        <label class="mb-2" for="name">Овог</label>
                        <input class="form-control py-4 @error('last_name') is-invalid @enderror" id="last_name" type="text" 
                        name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus/>

                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="name">Нэр</label>
                        <input class="form-control py-4 @error('first_name') is-invalid @enderror" id="first_name" type="text" 
                        name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus/>

                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="name">Имэйл</label>
                        <input class="form-control py-4 @error('email') is-invalid @enderror" id="email" type="email" 
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="name">Утасны дугаар</label>
                        <input class="form-control py-4 @error('mobile_number') is-invalid @enderror" id="mobile_number" type="number" 
                        name="mobile_number" value="{{ old('mobile_number') }}" required autocomplete="mobile_number" autofocus/>

                        @error('mobile_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="small mb-1" for="password">Нууц үг</label>
                        <input class="form-control py-4 @error('password') is-invalid @enderror" id="password" type="password" 
                        name="password" required autocomplete="new-password" />

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="small mb-1" for="password-confirm">Нууц үг давтах</label>
                        <input class="form-control py-4 @error('password') is-invalid @enderror" id="password-confirm" type="password"" 
                        name="password_confirmation" required autocomplete="new-password" />

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="type">Ажилтаны төрөл</label>
                        <select class="form-control" name="type" id="type">
                            <option disabled selected>Ажилтаны төрөл сонгох</option>
                            @foreach ($employee_types as $item)
                                @if (old('type') == $item->id . '. ' . $item->name)
                                    <option selected>{{$item->id . '. ' . $item->name}}</option>
                                @else
                                    <option>{{$item->id . '. ' . $item->name}}</option>
                                @endif
                            @endforeach
                        </select>

                        @error('types')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="mb-1" for="image">Зураг</label>
                        <input class="form-control py-1 @error('image') is-invalid @enderror" id="image" type="file" 
                        name="image" autocomplete="image" />

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-md">
                            Шинэ ажилтан бүртгэх
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
    @endcomponent
@endsection