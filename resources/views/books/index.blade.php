<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Liste des Livres Disponibles
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="card shadow-lg dark:bg-gray-700">
                        <!-- SEARCH HEADER -->
                        <div
                            class="card-header dark:bg-gray-600 p-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                                📚 Gestion des Livres
                            </h2>

                            <!-- SEARCH FORM -->
                            <form method="GET" action="{{ route('books.index') }}" class="w-full md:w-auto">
                                <div class="flex gap-2">
                                <select name="search_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                    <option value="titre" {{ $searchType === 'titre' ? 'selected' : '' }}>Titre</option>
                                    <option value="auteur1" {{ $searchType === 'auteur1' ? 'selected' : '' }}>Auteur</option>
                                    <option value="isbn" {{ $searchType === 'isbn' ? 'selected' : '' }}>ISBN</option>
                                    <option value="type" {{ $searchType === 'type' ? 'selected' : '' }}>Type</option>
                                    <option value="genre" {{ $searchType === 'genre' ? 'selected' : '' }}>Genre</option>
                                </select>

                                    <input type="text" name="search" value="{{ $search }}" placeholder="Rechercher..."
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">

                                    <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>

                            <a href="{{ route('books.create') }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300 w-full md:w-auto text-center">
                                <i class="fas fa-plus mr-2"></i>Nouveau Livre
                            </a>
                        </div>

                        <!-- TABLE SECTION -->
                        <div class="card-body p-4 dark:bg-gray-700">
                            <div class="overflow-x-auto rounded-lg">
                                @if($books->isEmpty())
                                    <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                                        Aucun livre trouvé
                                    </div>
                                @else
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-300">
                                            <tr>
                                                <th class="px-4 py-3">ISBN</th>
                                                <th class="px-4 py-3">Titre</th>
                                                <th class="px-4 py-3">Auteur</th>
                                                <th class="px-4 py-3">Éditeur</th>
                                                <th class="px-4 py-3">Année</th>
                                                <th class="px-4 py-3">Genre</th>
                                                <th class="px-4 py-3">Type</th>
                                                <th class="px-4 py-3">Tome</th>
                                                <th class="px-4 py-3 text-center">Disponibilité</th>
                                                <th class="px-4 py-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($books as $book)
                                                <tr
                                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                                        {{ $book->isbn }}
                                                    </td>
                                                    <td class="px-4 py-3">{{ $book->titre }}</td>
                                                    <td class="px-4 py-3">{{ $book->auteur1 }}</td>
                                                    <td class="px-4 py-3">{{ $book->editeur }}</td>
                                                    <td class="px-4 py-3">{{ $book->annee }}</td>
                                                    <td class="px-4 py-3">
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
                                                    </td>

                                                    
                                                    <td class="px-4 py-3">
                                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                            @switch($book->type)
                                                                @case('livre') Livre @break
                                                                @case('magazine') Magazine @break
                                                                @case('dictionnaire') Dictionnaire @break
                                                            @endswitch
                                                        </span>
                                                    </td>
                                                    <td class="px-4 py-3">{{ $book->tome ?? '-' }}</td>
                                                    <td class="px-4 py-3 text-center">
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                                {{ $book->disponible > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                                            {{ $book->disponible }} disponible(s)
                                                        </span>
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        <div class="flex items-center space-x-2">
                                                            <!-- View Button -->
                                                            <a href="{{ route('books.show', $book->isbn) }}"
                                                                class="text-green-600 hover:text-green-900 dark:text-green-400"
                                                                title="Voir les détails">
                                                                <i class="fas fa-eye fa-lg"></i>
                                                            </a>

                                                            <!-- Edit Button -->
                                                            <a href="{{ route('books.edit', $book->isbn) }}"
                                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400"
                                                                title="Modifier">
                                                                <i class="fas fa-edit fa-lg"></i>
                                                            </a>

                                                            <!-- Delete Button -->
                                                            <form action="{{ route('books.destroy', $book->isbn) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="text-red-600 hover:text-red-900 dark:text-red-400"
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre?')"
                                                                    title="Supprimer">
                                                                    <i class="fas fa-trash fa-lg"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif

                                <!-- PAGINATION -->
                                <div class="mt-4 px-4">
                                    {{ $books->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>