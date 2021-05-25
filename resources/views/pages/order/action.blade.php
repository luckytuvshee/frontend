{{-- <a href='javascript:void(0)' class='edit btn btn-primary btn-sm'>Харах</a> --}}

<div class="btn-group">
		@if ($row->order_status_id == 1)
			@if(Auth::user()->type->id == 1)
				<a class="btn btn-primary"  href="{{ route('order.assign', ['id' => $row->order_id]) }}">Баталгаажуулах</a>
			@else
				<a class="btn btn-primary" style="color: #FFF">Баталгаажаагүй</a>
			@endif
		@elseif ($row->order_status_id == 2)
			@if(Auth::user()->type->id == 1)
				<a class="btn btn-primary"  href="{{ route('order.package', ['id' => $row->order_id]) }}">Хүргэлтэнд бэлтгэх</a>
			@else
				<a class="btn btn-success" style="color: #FFF">Баталгаажсан</a>
			@endif
		@elseif($row->order_status_id == 3)
			@if(Auth::user()->type->id == 1)
				<a class="btn btn-success" style="color: #FFF">Бэлтгэгдсэн</a>
			@else
				<a class="btn btn-primary"  href="{{ route('order.shipping_started', ['id' => $row->order_id]) }}">Хүргэлтэнд гарсан</a>
			@endif
		@elseif($row->order_status_id == 4)
			@if(Auth::user()->type->id == 1)
				<a class="btn btn-success" style="color: #FFF">Хүргэлтэнд гарсан</a>
			@else
				<a class="btn btn-primary"  href="{{ route('order.shipped', ['id' => $row->order_id]) }}">Хүргэгдсэн</a>
			@endif
		@elseif($row->order_status_id == 5)
			<a class="btn btn-success" style="color: #FFF">Хүргэгдсэн</a>
		@endif
	</div>
</div>