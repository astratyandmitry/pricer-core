@php /** @var \App\Models\Advert $advert */ @endphp

@if ($advert->updates->count() > 1)
  <div class="p-6 bg-white shadow-md rounded-md mb-12">
    <canvas id="myChart" width="100%" height="30vh"></canvas>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js"
          integrity="sha512-yadYcDSJyQExcKhjKSQOkBKy2BLDoW6WnnGXCAkCoRlpHGpYuVuBqGObf3g/TdB86sSbss1AOP4YlGSb6EKQPg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    var ctx = document.getElementById('myChart')
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: @json($advert->graphLabels()),
        datasets: [{
          data: @json($advert->graphData()),
          borderWidth: 2,
          borderColor: '#2563EB',
          label: '{{ $advert->title }}',
        }]
      },
    })
  </script>
@endif
