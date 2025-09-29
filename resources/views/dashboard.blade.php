<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="p-6">
        <h3 class="text-lg font-semibold mb-4">Catégories</h3>

        @isset($categories)
            @if($categories->count())
                <ul class="list-disc pl-6 space-y-1">
                    @foreach($categories as $categorie)
                        <li>
                            <a class="text-indigo-600 underline"
                               href="{{ route('categories.show', $categorie->id) }}">
                                {{ $categorie->nom }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Aucune catégorie trouvée.</p>
            @endif
        @else
            <p>Pas de catégories chargées (vérifie la route /dashboard).</p>
        @endisset
    </div>
</x-app-layout>
