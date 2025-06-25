<div>
     <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg divide-y divide-gray-200">
    <!-- Language Row Component -->
    <div class="group">
      <button class="w-full flex items-center justify-between p-4 hover:bg-gray-50"
        wire:click="ToggleRow()"
      >
        <div class="flex items-center space-x-3">
          {{-- <span class="bg-gray-200 text-xs px-2 py-1 rounded">PL</span> --}}
          <span class="font-medium text-gray-800">{{$language}}</span>
        </div>
        <div class="flex items-center space-x-4">
          <div class="w-32 h-2 bg-gray-200 rounded">
            <div class="bg-green-500 h-2 rounded" style="width: {{$percentage}}%"></div>
          </div>
          <span class="text-gray-500 text-sm">{{$percentage}}%</span>
          <svg class="w-4 h-4 text-gray-400 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
          </svg>
        </div>
      </button>
      @if($show) <!-- dropdown -->
        <div class="px-6 pb-4 text-sm text-gray-600">

            {!! $text !!}
        </div>
      @endif
    </div>
    <!-- Duplicate block for other languages -->
    <!-- Copy/paste and change content as needed -->

  </div>
</div>
