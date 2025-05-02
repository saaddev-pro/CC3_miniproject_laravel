<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Détails du Livre: {{ $book->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="card shadow-lg dark:bg-gray-700">
                        <div class="card-header dark:bg-gray-600 p-4">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                                📖 Détails Complets
                            </h2>
                        </div>

                        <div class="card-body p-4 dark:bg-gray-700">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Book Details -->
                                <div class="space-y-2">
                                    <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                                    <p><strong>Titre:</strong> {{ $book->titre }}</p>
                                    <p><strong>Auteur Principal:</strong> {{ $book->auteur1 }}</p>
                                    <p><strong>Auteur Secondaire:</strong> {{ $book->auteur2 ?? '-' }}</p>
                                </div>

                                <div class="space-y-2">
                                    <p><strong>Éditeur:</strong> {{ $book->editeur }}</p>
                                    <p><strong>Année:</strong> {{ $book->annee }}</p>
                                    <p><strong>Genre:</strong>
                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">
                                        @switch($book->genre)
                                            @case('comédie') Comédie @break
                                            @case('science') Science @break
                                            @case('science-fiction') Science-Fiction @break
                                            @case('horreur') Horreur @break
                                            @case('drame') Drame @break
                                            @case('romance') Romance @break
                                        @endswitch
                                    </span>
                                   </p>

                                <!-- Update Type display -->
                                    <p><strong>Type:</strong>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                        @switch($book->type)
                                            @case('livre') Livre @break
                                            @case('magazine') Magazine @break
                                            @case('dictionnaire') Dictionnaire @break
                                        @endswitch
                                    </span>
                                    </p>
                                    <p><strong>Tome:</strong> {{ $book->tome ?? '-' }}</p>
                                </div>

                                <div class="md:col-span-2 space-y-2">
                                    <p><strong>Exemplaires Totaux:</strong> {{ $book->nombre_exemplaires }}</p>
                                    <p><strong>Disponibles:</strong>
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                            {{ $book->disponible > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                            {{ $book->disponible }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6 flex gap-2">
                                <a href="{{ route('books.edit', $book->isbn) }}"
                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400">
                                    <i class="fas fa-edit fa-lg mr-2"></i>Modifier
                                </a>
                                <a href="{{ route('books.index') }}"
                                    class="ml-4 text-gray-600 hover:text-gray-900 dark:text-gray-400">
                                    <i class="fas fa-arrow-left fa-lg mr-2"></i>Retour
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>