@extends('layout.header')

@section('contenido')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<center>
    <br>
    <h2>Grafico - Por Estatus</h2>
    <br>
    <div style="width:600px">
      <canvas id="myChart"></canvas>
    </div>
</center>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const espera = @json($en_espera);
    const procesado = @json($procesado);
    const enproceso = @json($en_proceso);
    const total = procesado + enproceso + espera;

  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['En Espera', 'En Proceso', 'Procesado'],
      datasets: [{
        label: total+' de ',
        data: [espera, enproceso, procesado],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>


@endsection