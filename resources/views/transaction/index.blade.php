<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Transaction Index') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">Transaction</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transactions as $transaction)
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">
                  <a href="{{ route('transaction.show', $transaction->id) }}">
                    <h5 class="text-left text-sm text-grey-dark">{{$transaction->date}}</h5>
                    {{-- <h5 class="text-left text-sm text-grey-dark">{{$transaction}}</h5> --}}
                    {{-- 6.15 投稿者名の表示: 多対1 belongs to $transaction->function->column name --}}
                    <h5 class="text-left text-sm text-grey-dark">
                      @if ($transaction->kind_id === 1)
                        <span class="bg-rose-500 text-white">{{ $transaction->kind->kind }}</span>
                      @else
                        <span class="bg-green-500 text-white">{{ $transaction->kind->kind }}</span>
                      @endif              
                       > 
                       {{ $transaction->category->category}}
                    </h5>
                    @if ($transaction->kind_id === 1)
                      <h3 class="text-left font-bold text-lg text-rose-500">¥{{$transaction->price}}</h3>                      
                    @else
                      <h3 class="text-left font-bold text-lg text-green-500">¥{{$transaction->price}}</h3>
                    @endif
                  </a>

                  <p class="text-left">{{ $transaction->note }}</p>
                  <div class="flex">
                    <!-- 更新ボタン -->
                    <form action="{{ route('transaction.edit',$transaction->id) }}" method="GET" class="text-left">
                      @csrf
                      <button type="submit" class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline">
                        <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                      </button>
                    </form>
                    <!-- 削除ボタン -->
                    <form action="{{ route('transaction.destroy',$transaction->id) }}" method="POST" class="text-left">
                      @method('delete')
                      @csrf
                      <button type="submit" class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure you want to delete {{ $transaction->transaction }} transaction?')">
                        <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

