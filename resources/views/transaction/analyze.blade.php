<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Transaction Analyze') }}
    </h2>
  </x-slot>

  <x-slot name="javascript">
    {{-- <script src="{{ mix('/js/app.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script> --}} --}}
    {{-- 日本語の日付を表示するには以下が必要 --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/ja.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0"></script> --}}
    <script type="text/javascript">
        const CHART_COLORS = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };

        const ctx = document.getElementById("myChart").getContext("2d");
        const myChart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: [],     // here
                datasets: [
                    {
                        data: [],       // here
                        fill: false,
                        // borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: Object.values(CHART_COLORS),
                        tension: 0.1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,      // レスポンシブ対応のため
            }
        })

        const categoryData = {!! $categories_json !!};
        const priceData = {!! $filled_result_json !!};
        console.log({!! $filled_result_json !!});

        // function pushData() {
            var category = []
            var price = []
            for (let i=0; i<categoryData.length; i++) {
                category.push(categoryData[i].category);
                price.push(parseInt(priceData[i+1]));
            }
        myChart.data.labels = category;
        myChart.data.datasets[0].data = price;
        myChart.update();

        console.log(category);
        console.log(price);

    </script>
  </x-slot>

<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <span class="mx-auto mb-2 uppercase font-bold text-lg text-grey-darkest">Payment and Income</span>
            {{-- <div class="relative m-auto sm:h-72" style="position: relative; height: 500px; width; 600px"> --}}
            <div class="relative m-auto sm:h-72" style="position: relative; height: 500px; width; 500px">
                <canvas id="myChart"></canvas>
            </div>
            <div class="p-6 bg-white border-b border-gray-200">
                <div>
                    <table class="w-full whitespace-nowrap mx-auto">
                        <tr>
                            <th class=" px-6 py-4 text-right"></th>
                            <th class=" px-6 py-4 text-right"></th>
                        </tr>
                        @foreach ($payment_categories as $category)
                        <tr>
                            <td class="px-6 py-2 text-left">{{ $category -> category }}</td>   
                            <td class="px-6 py-2 text-left">¥{{ $filled_result[$loop->index+1] }}</th>
                        </tr>
                        @endforeach
                        @foreach ($income_categories as $category)
                        <tr>
                            <td class="px-6 py-2 text-left">{{ $category -> category }}</td>   
                            <td class="px-6 py-2 text-left">¥{{ $filled_result[$loop->index+15] }}</th>
                        </tr>
                        @endforeach
                    {{-- </table>
                </div>
                <div>
                    <span class="mb-2 uppercase font-bold text-lg text-grey-darkest">Payment</span>
                    <table class="w-full whitespace-nowrap">
                        <tr>
                            <th class="text-right"></th>
                            <th class="text-right"></th>
                        </tr> --}}

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- <div class="grid grid-cols-2 gap-1 justify-evenly">
    <div class="bg-green-700 w-26 h-12">1</div>
    <div class="bg-green-500 w-26 h-12">2</div>
</div> --}}


</x-app-layout>

