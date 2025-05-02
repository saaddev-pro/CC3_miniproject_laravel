<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $searchType = $request->input('search_type', 'titre');

        $books = Book::when($search, function ($query) use ($search, $searchType) {
            return $query->where(function ($q) use ($search, $searchType) {
                $q->where($searchType, 'LIKE', "%{$search}%");
            });
        })->latest()->paginate(10);

        return view('books.index', compact('books', 'search', 'searchType'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'isbn' => 'required|unique:books',
            'titre' => 'required|max:255',
            'auteur1' => 'required|max:255',
            'auteur2' => 'nullable|max:255',
            'editeur' => 'required|max:255',
            'annee' => 'required|integer|min:1900|max:'.date('Y'),
            'nombre_exemplaires' => 'required|integer|min:1',
            'genre' => 'required|in:comédie,science,science-fiction,horreur,drame,romance',
            'type' => 'required|in:livre,magazine,dictionnaire',
            'tome' => 'nullable|max:50',
            'disponible' => 'required|integer|min:0|lte:nombre_exemplaires'
        ]);

        Book::create($request->all());
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book) // Implicit model binding
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'isbn' => [
            'required',
            Rule::unique('books')->ignore($book->isbn, 'isbn') // Use ISBN as identifier
        ],
            'titre' => 'required',
            'auteur1' => 'required',
            'editeur' => 'required',
            'annee' => 'required|numeric|min:1900|max:' . date('Y'),
            'nombre_exemplaires' => 'required|integer',
            'disponible' => 'required|integer',
            'genre' => 'required|in:comédie,science,science-fiction,horreur,drame,romance',
            'type' => 'required|in:livre,magazine,dictionnaire',
        ]);
        $book->update($request->all());
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}
