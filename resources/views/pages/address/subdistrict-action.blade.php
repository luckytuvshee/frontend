{{-- <a href='javascript:void(0)' class='edit btn btn-primary btn-sm'>Харах</a> --}}

<div class="btn-group">
		<button type="button" class="btn btn-primary" data-subdistrictid="{{ $row->subdistrict_id }}" data-subdistrictname="{{ $row->subdistrict_name }}" data-toggle="modal" data-target="#subdistrict_edit_modal">
			<strong>Засах</strong>
		</button>
    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu">
		<button type="button" class="dropdown-item" data-subdistrictid="{{ $row->subdistrict_id }}" data-subdistrictname="{{ $row->subdistrict_name }}" data-toggle="modal" data-target="#subdistrict_delete_modal">
			<strong>Устгах</strong>
		</button>
    </div>
</div>