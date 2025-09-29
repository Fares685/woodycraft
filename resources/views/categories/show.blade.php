{{-- resources/views/categories/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Catégorie : {{ $categorie->nom }}
        </h2>
    </x-slot>

    <div class="p-6">
        @if($categorie->puzzles->count())
            <ul class="space-y-2">
                @foreach($categorie->puzzles as $puzzle)
                    <li class="border-b pb-2">
                        <div class="font-semibold">{{ $puzzle->nom }}</div>
                        @if($puzzle->image)
                            <img src="{{ asset('storage/'.$puzzle->image) }}" alt="{{ $puzzle->nom }}" class="mt-1 max-h-32">
                        @endif
                        <div class="text-sm text-gray-600 mt-1">
                            {{ Str::limit($puzzle->description, 120) }}
                        </div>
                        <div class="mt-1">
                            <span class="font-medium">{{ number_format($puzzle->prix, 2, ',', ' ') }} €</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Pas de puzzles dans cette catégorie.</p>
        @endif

        <div class="mt-6">
            <a href="{{ route('accueil') }}" class="text-indigo-600 underline">← Retour aux catégories</a>
        </div>
    </div>
</x-app-layout>
