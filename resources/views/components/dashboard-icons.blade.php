<div class="row">
  <div class="col-xl-3 col-md-6">
      <div style="text-align: center; text-transform: uppercase; background-color: rgb(122, 121, 121)" class="card text-white mb-4">
          <div class="card-body">
            <div><i style="font-size: 28px" class="fas fa-shopping-cart"></i></div>
            <div style="font-size: 28px; font-family: Iosevka; margin-top: 10px">{{ $order_count }}</div>
          </div>
          <div style="font-weight: 500" class="card-footer d-flex align-items-center justify-content-center">
              <a class="small text-white stretched-link" href="{{ route('orders') }}">Нийт онлайн захиалга</a>
              <div class="small text-white"><i class="fas fa-angle-right ml-2 mt-1"></i></div>
          </div>
      </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div style="text-align: center; text-transform: uppercase; background-color: rgb(122, 121, 121)" class="card text-white mb-4">
        <div class="card-body">
          <div><i style="font-size: 28px" class="fas fa-gift"></i></div>
          <div style="font-size: 28px; font-family: Iosevka; margin-top: 10px">{{ $product_count }}</div>
        </div>
        <div style="font-weight: 500" class="card-footer d-flex align-items-center justify-content-center">
            <a class="small text-white stretched-link" href="{{ route('products') }}">Нийт бүтээгдэхүүн</a>
            <div class="small text-white"><i class="fas fa-angle-right ml-2 mt-1"></i></div>
        </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div style="text-align: center; text-transform: uppercase; background-color: rgb(122, 121, 121)" class="card text-white mb-4">
        <div class="card-body">
          <div><i style="font-size: 28px" class="fas fa-users"></i></div>
          <div style="font-size: 28px; font-family: Iosevka; margin-top: 10px">{{ $user_count }}</div>
        </div>
        <div style="font-weight: 500" class="card-footer d-flex align-items-center justify-content-center">
            <a class="small text-white stretched-link" href="{{ route('users') }}">Бүртгэлтэй хэрэглэгчид</a>
            <div class="small text-white"><i class="fas fa-angle-right ml-2 mt-1"></i></div>
        </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div style="text-align: center; text-transform: uppercase; background-color: rgb(122, 121, 121)" class="card text-white mb-4">
        <div class="card-body">
          <div><i style="font-size: 28px" class="fas fa-user-friends"></i></div>
          <div style="font-size: 28px; font-family: Iosevka; margin-top: 10px">{{ $employee_count }}</div>
        </div>
        <div style="font-weight: 500" class="card-footer d-flex align-items-center justify-content-center">
            <a class="small text-white stretched-link" href="{{ route('employees') }}">Нийт ажилчид</a>
            <div class="small text-white"><i class="fas fa-angle-right ml-2 mt-1"></i></div>
        </div>
    </div>
  </div>
</div>