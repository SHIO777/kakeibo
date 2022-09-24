<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Edit Transaction') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          @include('common.errors')
          <form class="mb-6" action="{{ route('transaction.update', $transaction->id) }}" method="POST">
            @method('put')
            @csrf

            {{-- PaymentかIncomeを選択 --}}
            {{-- TODO: 元のvalueをselected --}}
            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="kind">Kind</label>
              <select name="kind_id" id="kind_id">
                @foreach ($kinds as $kind)
                    @if ($transaction->kind_id === $kind->id)
                        <option value="{{ $kind->id }}" selected>{{ $kind->id }}: {{ $kind->kind }}</option>
                    @else
                        <option value="{{ $kind->id }}">{{ $kind->id }}: {{ $kind->kind }}</option>                        
                    @endif

                @endforeach
              </select>
            </div>

            {{-- Categoryを選択 --}}
            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="kind">Category</label>
              <select name="category_id" id="category_id">
                @foreach ($categories as $category)
                    @if ($transaction->category_id === $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->id }}: {{ $category->category }}</option>                        
                    @else
                        <option value="{{ $category->id }}">{{ $category->id }}: {{ $category->category }}</option>                        
                    @endif
                @endforeach
              </select>
            </div>

            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="price">Price</label>
              <input class="border py-2 px-3 text-grey-darkest" type="number" min="0" step="1" name="price" id="price" value="{{ $transaction->price }}">
            </div>

            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="date">Date</label>
              <input class="border py-2 px-3 text-grey-darkest" type="date" name="date" id="date" value="{{ $transaction->date }}">
            </div>

            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="place">Place</label>
              <input class="border py-2 px-3 text-grey-darkest" type="text" name="place" id="place" value="{{ $transaction->place }}">
            </div>

            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="note">Note</label>
              <input class="border py-2 px-3 text-grey-darkest" type="text" name="note" id="note" value="{{ $transaction->note }}">
            </div>

            <div class="flex justify-evenly">
              <a href="{{ url()->previous() }}" class="block text-center w-5/12 py-3 mt-6 font-medium tracking-widest text-black uppercase bg-gray-100 shadow-sm focus:outline-none hover:bg-gray-200 hover:shadow-none">
                Back
              </a>
              <button type="submit" class="w-5/12 py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                Update
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
