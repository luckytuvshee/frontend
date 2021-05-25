{{-- <a href='javascript:void(0)' class='edit btn btn-primary btn-sm'>Харах</a> --}}

<div class="btn-group">
		<a class="btn btn-primary"  href="{{ route('subdistricts', ['id' => $row->district_id]) }}">Дэлгэрэнгүй</a>
    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu">
		<button type="button" class="dropdown-item" data-districtid="{{ $row->district_id }}" data-districtname="{{ $row->district_name }}" data-toggle="modal" data-target="#district_edit_modal">
			<strong>Засах</strong>
		</button>
		<div class="dropdown-divider"></div>

		<button type="button" class="dropdown-item" data-districtid="{{ $row->district_id }}" data-districtname="{{ $row->district_name }}" data-toggle="modal" data-target="#district_delete_modal">
			<strong>Устгах</strong>
		</button>
    </div>
</div>