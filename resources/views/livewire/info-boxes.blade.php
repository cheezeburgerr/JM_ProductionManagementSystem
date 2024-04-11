<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="columns-2 md:columns-4">
        @foreach ($boxes as $boxes)
        <x-card class="p-4 mb-4 break-inside-avoid-column">
            <p>{{$boxes['title']}}</p>
            <p class="text-2xl font-bold">{{$boxes['count']}}</p>
        </x-card>
        @endforeach
    </div>
</div>
