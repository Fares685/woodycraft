<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tableau de bord</h2>
    </x-slot>

    {{-- HÉRO bannière --}}
    <div class="max-w-6xl mx-auto mt-6">
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-green-900">
                Construisez vos rêves en 3D avec WoodyCraft
            </h3>
            <p class="mt-1 text-green-800">
                Découvrez nos catégories et ajoutez vos puzzles au panier.
            </p>

            <a href="{{ route('panier.index') }}"
               class="inline-flex mt-4 px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800">
                Voir mon panier
            </a>
        </div>
    </div>

    {{-- Catégories mises en avant --}}
    <div class="max-w-6xl mx-auto mt-8">
        <h3 class="text-lg font-semibold mb-3 text-green-900">Catégories</h3>

        <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-4">
            @forelse($categories as $cat)
                <a href="{{ route('categories.show', $cat->id) }}"
                   class="bg-white rounded shadow p-4 hover:shadow-md transition">
                    <div class="font-semibold text-green-900">{{ $cat->nom }}</div>
                    <div class="text-sm text-green-800 mt-1">Voir les puzzles →</div>
                </a>
            @empty
                <div class="text-sm text-green-800 col-span-full">Aucune catégorie.</div>
            @endforelse
        </div>
    </div>

    {{-- Produits récents --}}
    <div class="max-w-6xl mx-auto mt-10 mb-10">
        <h3 class="text-lg font-semibold mb-3 text-green-900">Produits</h3>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($produits as $p)
                <div class="bg-white rounded shadow p-4">
                    <div class="font-semibold text-green-900">{{ $p->nom }}</div>
                    <div class="text-green-800 mt-1">
                        {{ number_format($p->prix, 2, ',', ' ') }} €
                    </div>
                    <a href="{{ route('categories.show', $p->categorie_id) }}"
                       class="inline-block mt-3 text-sm text-green-900 underline">
                        Voir la catégorie
                    </a>
                </div>
            @empty
                <div class="text-sm text-green-800 col-span-full">Aucun produit pour le moment.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>
