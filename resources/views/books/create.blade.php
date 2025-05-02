<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ajouter un Nouveau Livre
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="card shadow dark:bg-gray-700">
                        <div class="card-header dark:bg-gray-600 p-4">
                            <h2 class="h4 text-gray-800 dark:text-gray-200">Ajouter un Nouveau Livre</h2>
                        </div>

                        <div class="card-body p-4 dark:bg-gray-700">
                            <form action="{{ route('books.store') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- ISBN -->
                                    <div>
                                        <label for="isbn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ISBN *</label>
                                        <input type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @error('isbn') border-red-500 @enderror"
                                            id="isbn" 
                                            name="isbn" 
                                            value="{{ old('isbn') }}"
                                            required>
                                        @error('isbn')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Titre -->
                                    <div>
                                        <label for="titre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre *</label>
                                        <input type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @error('titre') border-red-500 @enderror"
                                            id="titre" 
                                            name="titre" 
                                            value="{{ old('titre') }}"
                                            required>
                                        @error('titre')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Auteur 1 -->
                                    <div>
                                        <label for="auteur1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Auteur Principal *</label>
                                        <input type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @error('auteur1') border-red-500 @enderror"
                                            id="auteur1" 
                                            name="auteur1" 
                                            value="{{ old('auteur1') }}"
                                            required>
                                        @error('auteur1')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Auteur 2 -->
                                    <div>
                                        <label for="auteur2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Auteur Secondaire</label>
                                        <input type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @error('auteur2') border-red-500 @enderror"
                                            id="auteur2" 
                                            name="auteur2" 
                                            value="{{ old('auteur2') }}">
                                        @error('auteur2')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Éditeur -->
                                    <div>
                                        <label for="editeur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Éditeur *</label>
                                        <input type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @error('editeur') border-red-500 @enderror"
                                            id="editeur" 
                                            name="editeur" 
                                            value="{{ old('editeur') }}"
                                            required>
                                        @error('editeur')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Année -->
                                    <div>
                                        <label for="annee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Année *</label>
                                        <input type="number"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @error('annee') border-red-500 @enderror"
                                            id="annee" 
                                            name="annee" 
                                            value="{{ old('annee') }}"
                                            required>
                                        @error('annee')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Nombre d'exemplaires -->
                                    <div>
                                        <label for="nombre_exemplaires" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre d'exemplaires *</label>
                                        <input type="number"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @error('nombre_exemplaires') border-red-500 @enderror"
                                            id="nombre_exemplaires" 
                                            name="nombre_exemplaires" 
                                            value="{{ old('nombre_exemplaires') }}"
                                            required>
                                        @error('nombre_exemplaires')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Genre -->
                                    <div>
                                        <label for="genre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genre *</label>
                                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white @error('genre') border-red-500 @enderror"
                                            id="genre" 
                                            name="genre" 
                                            required>
                                            <option value="comédie" {{ old('genre') == 'comédie' ? 'selected' : '' }}>Comédie</option>
                                            <option value="science" {{ old('genre') == 'science' ? 'selected' : '' }}>Science</option>
                                            <option value="science-fiction" {{ old('genre') == 'science-fiction' ? 'selected' : '' }}>Science-Fiction</option>
                                            <option value="horreur" {{ old('genre') == 'horreur' ? 'selected' : '' }}>Horreur</option>
                                            <option value="drame" {{ old('genre') == 'drame' ? 'selected' : '' }}>Drame</option>
                                            <option value="romance" {{ old('genre') == 'romance' ? 'selected' : '' }}>Romance</option>
                                        </select>
                                        @error('genre')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Type -->
                                    <div>
                                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type *</label>
                                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white @error('type') border-red-500 @enderror"
                                            id="type" 
                                            name="type" 
                                            required>
                                            <option value="livre" {{ old('type') == 'livre' ? 'selected' : '' }}>Livre</option>
                                            <option value="magazine" {{ old('type') == 'magazine' ? 'selected' : '' }}>Magazine</option>
                                            <option value="dictionnaire" {{ old('type') == 'dictionnaire' ? 'selected' : '' }}>Dictionnaire</option>
                                        </select>
                                        @error('type')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Tome -->
                                    <div>
                                        <label for="tome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tome</label>
                                        <input type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @error('tome') border-red-500 @enderror"
                                            id="tome" 
                                            name="tome" 
                                            value="{{ old('tome') }}">
                                        @error('tome')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Disponible -->
                                    <div>
                                        <label for="disponible" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Exemplaires Disponibles *</label>
                                        <input type="number"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @error('disponible') border-red-500 @enderror"
                                            id="disponible" 
                                            name="disponible" 
                                            value="{{ old('disponible') }}"
                                            required>
                                        @error('disponible')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="md:col-span-2">
                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Enregistrer
                                        </button>
                                        <a href="{{ route('books.index') }}"
                                            class="ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">
                                            Annuler
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>