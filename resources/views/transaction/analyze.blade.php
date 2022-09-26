<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Transaction Analyze') }}
    </h2>
  </x-slot>

  <x-slot name="javascript">
    <script src="{{ mix('/js/chartjs.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
    {{-- 日本語の日付を表示するには以下が必要 --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/ja.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0"></script>
    <script type="text/javascript">
        const ctx = document.getElementById("myChart").getContext("2d");
        const myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: [],
                datasets: [
                    {
                        label: "sum of payment and income",
                        data: [],
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                          tooltipFormat: 'DD T'
                        },
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'value'
                        }
                    }
                }, 
                responsive: true,
                maintainAspectRatio: false,      // レスポンシブ対応のため
            }
        })
    

        function getData() {
            $.ajax({
                type: "get",
                // url: "/getdata",
                url: "{{ route('transaction.getdata') }}",
                dataType: "json",
            })
            // success
            .done((res) => {
                //something
                console.log(res);
                // console.log(res["2022-09-26"]);
                var data = []
                var price = []
                for (var date in res){
                    data.push(date);
                    price.push(res[date]);
                }
                console.log(data);
                console.log(price);

                myChart.data.labels = data;
                myChart.data.datasets[0].data = price;
                myChart.update();
            })
            // fail
            .fail((error) => {
                console.log(error.statusText);
            });
        };

        // 初期実行
        getData();

        // getdataボタンが押されたら実行
        $("#getdata").click(function(e) {
            console.log('push');
            e.preventDefault();
            getData();
        });
    </script>
  </x-slot>


<div class="py-12">
    {{-- <div class="max-w-7xl mx-auto sm:w-10/12 sm:h-full md:w-8/10 md:h-full lg:w-10/12 lg:h-full"> --}}
      {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200"> --}}

{{-- <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-10/12"> --}}
      {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
    <div class="relative m-auto sm:h-72" style="position: relative; height: 500px; width; 600px">
        <canvas id="myChart"></canvas>
    </div>
          
            {{-- <a href="route('transaction.getdata')"> --}}
                {{-- <button type="submit" id="getdata" onclick="getCharts()">chart</button> --}}
                <button type="submit" id="getdata">chart</button>

            {{-- </a> --}}
        {{-- </div> --}}
      {{-- </div> --}}
    </div>
  </div>
</x-app-layout>

