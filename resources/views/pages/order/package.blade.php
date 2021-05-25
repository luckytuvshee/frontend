@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Захиалгийн дэлгэрэнгүй мэдээлэл @endslot
    @slot('breadcrumb') Захиалгийн дэлгэрэнгүй мэдээлэл @endslot
    @section('side-navigation-content')
    <a href="{{ route('orders') }}" class="alert alert-dark" style="text-decoration: none">Буцах</a>
        <div class="row mt-4">
            <div class="col-xl-5 col-md-8">
                <br />
                <form method="POST" action="{{ route('order.package_order', ['id' => $order->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>                        
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="mb-1" for="employee">Хүргэлтийн ажилтан сонгох</label>
                        <select class="form-control" name="employee" id="employee">
                            <option disabled selected>Ажилтан сонгох</option>
                            @foreach ($shippers as $item)
                                <option>{{$item['employee_id'] . '. ' . $item['last_name'] . ' ' . $item['first_name'] . ' (хүлээгдэж буй хүргэлт: ' . $item['shipping_queue'] . ')'}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-md">
                            Хүргэлтийн ажилтныг сонгох
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
    @endcomponent
@endsection