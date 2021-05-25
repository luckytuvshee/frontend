<div class="row">
  <div class="col-xl-4 col-md-6">
      <div style="text-align: center; text-transform: uppercase; background-color: rgb(122, 121, 121)" class="card text-white mb-4">
          <div class="card-body">
            <div><i style="font-size: 28px" class="fas fa-shopping-cart"></i></div>
            <div style="font-size: 28px; font-family: Iosevka; margin-top: 10px">{{ $received_order_count }}</div>
          </div>
          <div style="font-weight: 500" class="card-footer d-flex align-items-center justify-content-center">
              <a class="small text-white stretched-link" href="{{ route('orders') }}">Нийт хүлээж авсан захиалга</a>
              <div class="small text-white"><i class="fas fa-angle-right ml-2 mt-1"></i></div>
          </div>
      </div>
  </div>
  <div class="col-xl-4 col-md-6">
    <div style="text-align: center; text-transform: uppercase; background-color: rgb(122, 121, 121)" class="card text-white mb-4">
        <div class="card-body">
          <div><i style="font-size: 28px" class="fas fa-truck"></i></div>
          <div style="font-size: 28px; font-family: Iosevka; margin-top: 10px">{{ $shipped_order_count }}</div>
        </div>
        <div style="font-weight: 500" class="card-footer d-flex align-items-center justify-content-center">
            <a class="small text-white stretched-link" href="{{ route('orders') }}">Хүргэсэн захиалга</a>
            <div class="small text-white"><i class="fas fa-angle-right ml-2 mt-1"></i></div>
        </div>
    </div>
  </div>
  <div class="col-xl-4 col-md-6">
    <div style="text-align: center; text-transform: uppercase; background-color: rgb(122, 121, 121)" class="card text-white mb-4">
        <div class="card-body">
          <div><i style="font-size: 28px" class="fas fa-truck-loading"></i></div>
          <div style="font-size: 28px; font-family: Iosevka; margin-top: 10px">{{ $waiting_order_count }}</div>
        </div>
        <div style="font-weight: 500" class="card-footer d-flex align-items-center justify-content-center">
          <a class="small text-white stretched-link" href="{{ route('orders') }}">Хүлээгдэж буй захиалга</a>
            <div class="small text-white"><i class="fas fa-angle-right ml-2 mt-1"></i></div>
        </div>
    </div>
  </div>
</div>