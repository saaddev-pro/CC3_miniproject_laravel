<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifier le Livre: {{ $book->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="card shadow-lg dark:bg-gray-700">
                        <div class="card-header dark:bg-gray-600 p-4">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                                ✏️ Modification du Livre
                            </h2>
                        </div>

                        <div class="card-body p-4 dark:bg-gray-700">
                            <form action="{{ route('books.update', $book->isbn) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- ISBN (readonly) -->
                                    <div>
                                        <label for="isbn"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ISBN
                                            *</label>
                                        <input type="text"
                                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300 cursor-not-allowed"
                                            id="isbn" name="isbn" value="{{ $book->isbn }}" readonly>
                                    </div>

                                    <!-- Titre -->
                                    <div>
                                        <label for="titre"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre
                                            *</label>
                                        <input type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                            id="titre" name="titre" value="{{ $book->titre }}" required>
                                    </div>

                                    <!-- Auteur 1 -->
                                    <div>
                                        <label for="auteur1"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Auteur
                                            Principal *</label>
                                        <input type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                            id="auteur1" name="auteur1" value="{{ $book->auteur1 }}" required>
                                    </div>

                                    <!-- Auteur 2 -->
                                    <div>
                                        <label for="auteur2"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Auteur
                                            Secondaire</label>
                                        <input type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                            id="auteur2" name="auteur2" value="{{ $book->auteur2 }}">
                                    </div>

                                    <!-- Éditeur -->
                                    <div>
                                        <label for="editeur"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Éditeur
                                            *</label>
                                        <input type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                            id="editeur" name="editeur" value="{{ $book->editeur }}" required>
                                    </div>

                                    <!-- Année -->
                                    <div>
                                        <label for="annee"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Année
                                            *</label>
                                        <input type="number"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                            id="annee" name="annee" value="{{ $book->annee }}" required>
                                    </div>

                                    <!-- Nombre d'exemplaires -->
                                    <div>
                                        <label for="nombre_exemplaires"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Exemplaires
                                            *</label>
                                        <input type="number"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                            id="nombre_exemplaires" name="nombre_exemplaires"
                                            value="{{ $book->nombre_exemplaires }}" required>
                                    </div>

                                    <!-- Type -->
                                    <div>
                                        <label for="genre"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genre
                                            *</label>
                                        <select
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                            id="genre" name="genre" required>
                                            <option value="comédie" {{ $book->genre === 'comédie' ? 'selected' : '' }}>
                                                Comédie</option>
                                            <option value="science" {{ $book->genre === 'science' ? 'selected' : '' }}>
                                                Science</option>
                                            <option value="science-fiction" {{ $book->genre === 'science-fiction' ? 'selected' : '' }}>
                                                Science-Fiction</option>
                                            <option value="horreur" {{ $book->genre === 'horreur' ? 'selected' : '' }}>
                                                Horreur</option>
                                            <option value="drame" {{ $book->genre === 'drame' ? 'selected' : '' }}>Drame
                                            </option>
                                            <option value="romance" {{ $book->genre === 'romance' ? 'selected' : '' }}>
                                                Romance</option>
                                        </select>
                                    </div>

                                            

                                    <!-- Update Type dropdown -->
                                    <div>
                                        <label for="type"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type
                                            *</label>
                                        <select
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                            id="type" name="type" required>
                                            <option value="livre" {{ $book->type === 'livre' ? 'selected' : '' }}>Livre
                                            </option>
                                            <option value="magazine" {{ $book->type === 'magazine' ? 'selected' : '' }}>
                                                Magazine</option>
                                            <option value="dictionnaire" {{ $book->type === 'dictionnaire' ? 'selected' : '' }}>Dictionnaire</option>
                                        </select>
                                    </div>

                                    <!-- Tome -->
                                    <div>
                                        <label for="tome"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tome</label>
                                        <input type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                            id="tome" name="tome" value="{{ $book->tome }}">
                                    </div>

                                    <!-- Disponible -->
                                    <div>
                                        <label for="disponible"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Disponibles
                                            *</label>
                                        <input type="number"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                            id="disponible" name="disponible" value="{{ $book->disponible }}" required>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="md:col-span-2 mt-4">
                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Mettre à Jour
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