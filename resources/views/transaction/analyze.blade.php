<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Transaction Analyze') }}
    </h2>
  </x-slot>

  <x-slot name="javascript">
    {{-- <script src="{{ mix('/js/app.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script> --}}
    {{-- 日本語の日付を表示するには以下が必要 --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/ja.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0"></script> --}}
    <script type="text/javascript">
        
    </script>
  </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div>
                    <span class="mx-auto mb-2 uppercase font-bold text-lg text-grey-darkest">Payment and Income</span>
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

