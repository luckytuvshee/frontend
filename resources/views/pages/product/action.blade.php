{{-- <a href='javascript:void(0)' class='edit btn btn-primary btn-sm'>Харах</a> --}}

<div class="btn-group">
    <a class="btn btn-primary" href="{{ route('product.show', ['id' => $row->id]) }}">Харах</a>
    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu">
		<a class="dropdown-item" href="{{ route('product.edit', ['id' => $row->id]) }}">Засах</a>        
		<div class="dropdown-divider"></div>
        <button type="button" class="dropdown-item" data-productid={{ $row->id }} data-toggle="modal" data-target="#product_delete_modal">
            <strong>Устгах</strong>
        </button>
</div>