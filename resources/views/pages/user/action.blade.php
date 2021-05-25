{{-- <a href='javascript:void(0)' class='edit btn btn-primary btn-sm'>Харах</a> --}}

<div class="btn-group">
    <a class="btn btn-primary" href="{{ route('user.show', ['id' => $row->id]) }}">Харах</a>
    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu">
		<a class="dropdown-item" href="{{ route('user.edit', ['id' => $row->id]) }}">Засах</a>
		<div class="dropdown-divider"></div>
		
        {{-- <a class="dropdown-item" href="{{ route('product.delete', ['id' => $row->id]) }}">Устгах</a> --}}

        <!-- Remove modal trigger-->
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
		<h5 class="modal-title" id="exampleModalLongTitle">Хэрэглэгчийг устгах</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
			Та энэ хэрэглэгчийг устгахдаа итгэлтэй байна уу?
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Үгүй</button>
		<a style="color: #fff" href="{{ route('user.delete', ['id' => $row->id]) }}" class="btn btn-primary">Тийм</a>
		</div>
	</div>
	</div>
</div>