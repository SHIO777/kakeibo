<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Show Transaction Detail') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="mb-6">
            <div class="flex flex-col mb-4">
            {{-- <h3 class="text-left font-bold text-lg text-grey-darkset">{{$transaction->date}}</h3>                      
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Price</p> --}}
              <h5 class="text-left text-sm text-grey-dark">{{$transaction->date}}</h5>
              <h5 class="text-left text-sm text-grey-dark">{{$kind->kind}} > {{ $category->category }}</h5>
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Price</p>
                @if ($transaction->kind_id === 1)
                <p class="py-2 px-3 font-bold text-lg text-rose-500" id="price">¥{{$transaction->price}}</p>
                @else
                <p class="py-2 px-3 font-bold text-lg text-green-500" id="price">¥{{$transaction->price}}</p>
                {{-- <h3 class="text-left font-bold text-lg text-green-500">¥{{$transaction->price}}</h3> --}}
                @endif
            </div>

            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Place</p>
              <p class="py-2 px-3 text-grey-darkest" id="place">
                {{$transaction->place}}
              </p>
            </div>

            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Note</p>
              <p class="py-2 px-3 text-grey-darkest" id="note">
                {{$transaction->note}}
              </p>
            </div>

            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Created at</p>
              <p class="py-2 px-3 text-grey-darkest" id="created_at">
                {{$transaction->created_at}}
              </p>
            </div>

            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Updated at</p>
              <p class="py-2 px-3 text-grey-darkest" id="updated_at">
                {{$transaction->updated_at}}
              </p>
            </div>

            <a href="{{ url()->previous() }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              Back
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

