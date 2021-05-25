{{-- <a href='javascript:void(0)' class='edit btn btn-primary btn-sm'>Харах</a> --}}

<div class="btn-group">
		<a class="btn btn-primary"  href="{{ route('districts', ['id' => $row->city_id]) }}">Дэлгэрэнгүй</a>
    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu">
			<button type="button" class="dropdown-item" data-cityid="{{ $row->city_id }}" data-cityname="{{ $row->city_name }}" data-toggle="modal" data-target="#city_edit_modal">
				<strong>Засах</strong>
			</button>
			<div class="dropdown-divider"></div>

			<button type="button" class="dropdown-item" data-cityid="{{ $row->city_id }}" data-cityname="{{ $row->city_name }}" data-toggle="modal" data-target="#city_delete_modal">
				<strong>Устгах</strong>
			</button>
    </div>
</div>