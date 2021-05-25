<div class="row">
  <div class="col-xl-4 col-md-6">
    <div style="height: 10.5em; text-align: center; text-transform: uppercase; background-color: rgb(29, 41, 56, 0.9)" class="card text-white mb-4 dashboard-card">
      <div style="font-weight: 500; height: 3em" class="card-footer d-flex align-items-center justify-content-center">
        <a style="display: flex; align-items: center; text-decoration: none" class="small text-white stretched-link" href="{{ route('orders') }}">
          <div><i style="font-size: 28px" class="fas fa-shopping-bag"></i></div>
          <span style="margin-left: 10px; font-weight: 700">Нийт хүлээж авсан захиалга</span>
        </a>
      </div>
      <div class="card-body">
        <div style="font-size: 28px; font-family: Iosevka; margin-top: 10px">{{ $received_order_count }}</div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-md-6">
    <div style="height: 10.5em; text-align: center; text-transform: uppercase; background-color: rgb(29, 41, 56, 0.9)" class="card text-white mb-4 dashboard-card">
      <div style="font-weight: 500; height: 3em" class="card-footer d-flex align-items-center justify-content-center">
        <a style="display: flex; align-items: center; text-decoration: none" class="small text-white stretched-link" href="{{ route('orders') }}">
          <div><i style="font-size: 28px" class="fas fa-truck"></i></div>
          <span style="margin-left: 10px; font-weight: 700">Хүргэсэн захиалга</span>
        </a>
      </div>
      <div class="card-body">
        <div style="font-size: 28px; font-family: Iosevka; margin-top: 10px">{{ $shipped_order_count }}</div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-md-6">
    <div style="height: 10.5em; text-align: center; text-transform: uppercase; background-color: rgb(29, 41, 56, 0.9)" class="card text-white mb-4 dashboard-card">
      <div style="font-weight: 500; height: 3em" class="card-footer d-flex align-items-center justify-content-center">
        <a style="display: flex; align-items: center; text-decoration: none" class="small text-white stretched-link" href="{{ route('orders') }}">
          <div><i style="font-size: 28px" class="fas fa-truck-loading"></i></div>
          <span style="margin-left: 10px; font-weight: 700">Хүлээгдэж буй захиалга</span>
        </a>
      </div>
      <div class="card-body">
        <div style="font-size: 28px; font-family: Iosevka; margin-top: 10px">{{ $waiting_order_count }}</div>
      </div>
    </div>
  </div>
</div>