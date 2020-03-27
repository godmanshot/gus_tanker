<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Прибыль по месяцам</h3>
    </div>
    <div class="box-body" style="width: 100%; height: 100%;">
            <canvas id="MonthCash" style="width: 100%; height: 400px;"></canvas>
            @php
                $sum = array_reverse(array_values($sum_by_month));
                $dates = array_reverse(array_keys($sum_by_month));
            @endphp
            <script>
            $(function () {
                var ctx = document.getElementById("MonthCash").getContext('2d');
                var MonthCash = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($dates),
                        datasets: [
                            {
                                data: @json($sum),
                                label: "Прибыль",
                                borderColor: "#00c0ef",
                                fill: true,
                                backgroundColor: "#00c0ef"
                            }
                        ]
                    },
                    // options: {
                    //     title: {
                    //         display: true,
                    //         text: 'World population per region (in millions)'
                    //     }
                    // }
                });
            });
            </script>
    </div>
    <div class="box-footer text-center">
        <a href="{{route('works.index')}}" target="_blank" class="uppercase">Посмотреть работы</a>
    </div>
</div>
