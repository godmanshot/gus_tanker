<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Работы</h3>
    </div>
    <div class="box-body" style="width: 100%; height: 100%;">
            <canvas id="Works" style="width: 100%; height: 400px;"></canvas>
            @php
                $created = ($works[0] ?? collect())->count();
                $start = ($works[1] ?? collect())->count();
                $ready = ($works[2] ?? collect())->count();
            @endphp
            <script>
            $(function () {
                var ctx = document.getElementById("Works").getContext('2d');
                var Works = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Не в работе", "В работе", "Закончено"],
                        datasets: [{
                            label: 'Количество работ',
                            data: [{{$created}}, {{$start}}, {{$ready}}],
                            backgroundColor: [
                                '#cdcdcd',
                                '#ffc533',
                                '#00a65a'
                            ],
                            borderColor: [
                                '#cdcdcd',
                                '#ffc533',
                                '#00a65a'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                    stepSize: 1,
                                    // suggestedMax: 15
                                }
                            }]
                        }
                    }
                });
            });
            </script>
    </div>
    <div class="box-footer text-center">
        <a href="{{route('works.index')}}" target="_blank" class="uppercase">Посмотреть работы</a>
    </div>
</div>