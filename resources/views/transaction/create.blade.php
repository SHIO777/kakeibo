<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Create New Transaction') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          @include('common.errors')
          <form class="mb-6" action="{{ route('transaction.store') }}" method="POST">
            @csrf

            {{-- PaymentかIncomeを選択 --}}
            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="kind">Kind</label>
              <select name="kind_id" id="kind_id">
                @foreach ($kinds as $kind)
                    <option value="{{ $kind->id }}">{{ $kind->id }}: {{ $kind->kind }}</option>
                @endforeach
              </select>
            </div>

            {{-- Categoryを選択 --}}
            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="kind">Category</label>
              <select name="kind_id" id="kind_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->id }}: {{ $category->category }}</option>
                @endforeach
              </select>
            </div>

            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="price">Price</label>
              <input class="border py-2 px-3 text-grey-darkest" type="number" min="0" step="1" name="price" id="price" value="{{ old('price') }}">
            </div>

            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="date">Date</label>
              <input class="border py-2 px-3 text-grey-darkest" type="date" name="date" id="date" value="{{ old('date') }}">
            </div>

            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="place">Place</label>
              <input class="border py-2 px-3 text-grey-darkest" type="text" name="place" id="place" value="{{ old('place') }}">
            </div>

            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="note">Note</label>
              <input class="border py-2 px-3 text-grey-darkest" type="text" name="note" id="note" value="{{ old('note') }}">
            </div>
            <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              Create
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

