@extends('admin')

@section('side-navigation-content-header')
    @component('components.side-navigation-content')
    @slot('title') Самбар @endslot
    @slot('breadcrumb') Самбар @endslot
    @section('side-navigation-content')
        @if (in_array(Auth::user()->type->id, [1]))
          @include('components.dashboard-icons')
          @include('components.dashboard-graph')
        @elseif (Auth::user()->type->id == 2)
          @include('components.shipper-icons')
        @endif
    @endsection
    @endcomponent

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
  var orders_stats_monthly = document.getElementById("orders_stats_monthly");
  var monthly = new Chart(orders_stats_monthly, {
    type: 'bar',
    data: {
      labels: [],
      datasets: [{
        label: "Захиалгын тоо",
        lineTension: 0.3,
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        pointRadius: 5,
        pointBackgroundColor: "rgba(2,117,216,1)",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(2,117,216,1)",
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: [],
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'month'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 10
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: 100,
            maxTicksLimit: 10
          },
          gridLines: {
            color: "rgba(0, 0, 0, .125)",
          }
        }],
      },
      legend: {
        display: true
      }
    }
  });

  var orders_stats_current_month = document.getElementById("orders_stats");
  var current_month = new Chart(orders_stats_current_month, {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: "Захиалгын тоо",
        lineTension: 0.3,
        backgroundColor: "rgba(2,117,216,0.2)",
        borderColor: "rgba(2,117,216,1)",
        pointRadius: 5,
        pointBackgroundColor: "rgba(2,117,216,1)",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(2,117,216,1)",
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: [],
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'date'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 10
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: 100,
            maxTicksLimit: 10
          },
          gridLines: {
            color: "rgba(0, 0, 0, .125)",
          }
        }],
      },
      legend: {
        display: true
      }
    }
  });
  var updateChart = function() {
    $.ajax({
      url: "{{ route('charts') }}",
      type: 'GET',
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        monthly.data.labels = data.monthly_labels;
        monthly.data.datasets[0].data = data.monthly_data;

        current_month.data.labels = data.current_month_labels;
        current_month.data.datasets[0].data = data.current_month_data;
        // current_month.data.labels = ['өдөр 1', 'өдөр 2', 'өдөр 3', 'өдөр 4', 'өдөр 5', 
        //                        'өдөр 6', 'өдөр 7', 'өдөр 8'];
        // current_month.data.datasets[0].data = [10, 20, 30, 30, 20, 60, 70, 95];
        monthly.update();
        current_month.update();
      },
      error: function(data){
        console.log(data);
      }
    });
  }
  
  updateChart();
  setInterval(() => {
    updateChart();
  }, 10000);
</script>

@endsection