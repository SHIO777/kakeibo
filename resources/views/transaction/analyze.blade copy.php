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
    

        function getDataGet() {
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

        function getData() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                type: "post",
                url: "{{ route('transaction.postdata') }}",
                dataType: "json",
                data: {
                    id: 100,
                    subject: "テストタイトル",
                },
            })
            // success
            .then((res) => {
                //something
                console.log(res);
                // console.log(res["2022-09-26"]);
                // var data = []
                // var price = []
                // for (var date in res){
                //     data.push(date);
                //     price.push(res[date]);
                // }
                // console.log(data);
                // console.log(price);

                // myChart.data.labels = data;
                // myChart.data.datasets[0].data = price;
                // myChart.update();
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


<div class="h-screen flex flex-wrap flex-row">
    <div class="bg-red-100 w-1/5"></div>
    <div class="bg-red-200 w-1/5"></div>
</div>

<div class="py-12">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="date">Start Date</label>
        <input class="border py-2 px-3 text-grey-darkest" type="date" name="date" id="date" value="{{ old('date') }}">
        <select name="duration" id="duration">
            <option value="yearly">Yearly</option>
            <option value="monthly">Monthly</option>
            <option value="weekly">Weekly</option>
        </select>
        <button type="submit" id="getdata" class="w-4/12 py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
            Update
        </button>
        <div class="relative m-auto sm:h-72" style="position: relative; height: 500px; width; 600px">
            <canvas id="myChart"></canvas>
        </div>
        <div class="h-screen w-screen flex justify-center items-center">
        </div>

    </div>
</div>
</x-app-layout>

