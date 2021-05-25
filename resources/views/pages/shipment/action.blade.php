{{-- <a href='javascript:void(0)' class='edit btn btn-primary btn-sm'>Харах</a> --}}

<div class="btn-group">
		@if ($row->order_status_id == 1)
			@if(Auth::user()->type->id <= 2)
				<a class="btn btn-primary"  href="{{ route('order.assign', ['id' => $row->id]) }}">Баталгаажуулах</a>
			@else
				<a class="btn btn-primary" style="color: #FFF">Баталгаажаагүй</a>
			@endif
		@elseif ($row->order_status_id == 2)
			@if(Auth::user()->type->id == 3)
				<a class="btn btn-primary"  href="{{ route('order.package', ['id' => $row->id]) }}">Бэлтгэх</a>
			@else
				<a class="btn btn-primary" style="color: #FFF">Баталгаажсан</a>
			@endif
		@elseif($row->order_status_id == 3)
			@if(Auth::user()->type->id <= 3)
				<a class="btn btn-primary" style="color: #FFF">Бэлтгэгдсэн</a>
			@else
				<a class="btn btn-primary"  href="{{ route('order.shipping_started', ['id' => $row->id]) }}">Хүргэлтэн гарсан</a>
			@endif
		@elseif($row->order_status_id == 4)
			@if(Auth::user()->type->id <= 3)
				<a class="btn btn-primary" style="color: #FFF">Хүргэлтэнд гарсан</a>
			@else
				<a class="btn btn-primary"  href="{{ route('order.shipped', ['id' => $row->id]) }}">Хүргэгдсэн</a>
			@endif
		@elseif($row->order_status_id == 5)
			<a class="btn btn-primary" style="color: #FFF">Хүргэгдсэн</a>
		@endif

    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu">
		<a class="dropdown-item" href="{{ route('product.edit', ['id' => $row->id]) }}">Засах</a>
		<div class="dropdown-divider"></div>

		<button type="button" class="dropdown-item" data-toggle="modal" data-target="#product_delete_modal">
			<strong>Устгах</strong>
		</button>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="product_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLongTitle">Бараа устгах</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
			Та энэ барааг устгахдаа итгэлтэй байна уу?
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Үгүй</button>
		<a style="color: #fff" href="{{ route('product.delete', ['id' => $row->id]) }}" class="btn btn-primary">Тийм</a>
		</div>
	</div>
	</div>
</div>