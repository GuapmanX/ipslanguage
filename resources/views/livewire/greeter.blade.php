<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div>Hello {{$name}}!</div>
    <div class="mt-2">
        <button class="text-white font-medium rounded-md px-4 py-2 bg-blue-600"
        wire:click="changeName('plovs')"
        >
        </button>
    </div>
</div>
