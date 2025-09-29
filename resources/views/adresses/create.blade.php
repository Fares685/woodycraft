<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouvelle adresse') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('adresses.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="numero">Numéro *</label>
                        <input type="text" name="numero" id="numero" class="border rounded w-full">
                    </div>

                    <div class="mb-4">
                        <label for="rue">Rue *</label>
                        <input type="text" name="rue" id="rue" class="border rounded w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="ville">Ville *</label>
                        <input type="text" name="ville" id="ville" class="border rounded w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="code_postal">Code postal *</label>
                        <input type="text" name="code_postal" id="code_postal" class="border rounded w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="pays">Pays *</label>
                        <input type="text" name="pays" id="pays" class="border rounded w-full" required>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                            Enregistrer
                        </button>
                    </div>
                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button class="ml-3">
                            {{ __('Send') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-guest-layout>
