@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Хэрэглэгчийн мэдээлэл өөрчлөх @endslot
    @slot('breadcrumb') Хэрэглэгчийн мэдээлэл өөрчлөх / {{ $user->email }} @endslot
    @section('side-navigation-content')
        <div class="row">
            <div class="col-xl-5 col-md-8">
                <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">           
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
                        <label class="mb-2" for="last_name">Овог</label>
                        <input class="form-control py-4 @error('last_name') is-invalid @enderror" id="last_name" type="text" 
                        name="last_name" value="{{ old('last_name', $user->last_name) }}" required autocomplete="last_name" autofocus/>
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="first_name">Нэр</label>
                        <input class="form-control py-4 @error('first_name') is-invalid @enderror" id="first_name" type="text" 
                        name="first_name" value="{{ old('first_name', $user->first_name) }}" required autocomplete="first_name" autofocus/>
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="email">Имэйл</label>
                        <input class="form-control py-4 @error('email') is-invalid @enderror" id="email" type="text" 
                        name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" autofocus/>
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="mobile_number">Утасны дугаар</label>
                        <input class="form-control py-4 @error('mobile_number') is-invalid @enderror" id="mobile_number" type="text" 
                        name="mobile_number" value="{{ old('mobile_number', $user->mobile_number) }}" required autocomplete="mobile_number" autofocus/>
                    </div>
                    
                    <div class="form-group">
                        <label class="small mb-1" for="password">Нууц үг</label>
                        <input class="form-control py-4" id="password" type="password" 
                        name="password" autocomplete="new-password" />
                    </div>
                    <div class="form-group">
                        <label class="small mb-1" for="password-confirm">Нууц үг давтах</label>
                        <input class="form-control py-4" id="password-confirm" type="password"
                        name="password_confirmation" autocomplete="new-password" />
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-md">
                            Хэрэглэгчийн мэдээлэл өөрчлөх
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
    @endcomponent
@endsection