<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function dashboard()
    {
        return view('manager.dashboard');
    }

    public function borrowBook(Request $request)
    {
        $request->validate([
            'book_isbn' => 'required|exists:books,isbn',
            'user_id' => 'required|exists:users,id'
        ]);

        return DB::transaction(function () use ($request) {
            $book = Book::findOrFail($request->book_isbn);

            if ($book->disponible < 1) {
                return back()->withErrors(['error' => 'Ce livre n\'est plus disponible']);
            }

            // Create loan with date_retour as due date (e.g., 14 days from now)
            Loan::create([
                'book_isbn' => $book->isbn,
                'user_id' => $request->user_id,
                'date_emprunt' => now(),
                'date_retour' => now()->addDays(14) // return deadline
            ]);

            // Update book availability
            $book->decrement('disponible');

            return back()->with('success', 'Livre emprunté avec succès');
        });
    }

    public function returnBook(Request $request)
    {
        $request->validate([
            'loan_id' => 'required|exists:loans,id'
        ]);

        return DB::transaction(function () use ($request) {
            $loan = Loan::findOrFail($request->loan_id);

            if ($loan->date_retour !== null) {
                return back()->withErrors(['error' => 'Ce livre a déjà été retourné.']);
            }

            $loan->update(['date_retour' => now()]);

            // Update book availability
            $book = $loan->book;
            $book->increment('disponible');

            return back()->with('success', 'Livre retourné avec succès');
        });
    }


}
