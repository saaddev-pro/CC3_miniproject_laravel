<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class UserBookController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role.user']);
    }

    // In UserBookController.php
    public function index(Request $request)
    {
        $search = $request->input('search', ''); // Add default empty value
        $availability = $request->input('availability', 'all');

        $filteredBooks = Book::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('titre', 'like', "%{$search}%")
                        ->orWhere('auteur1', 'like', "%{$search}%")
                        ->orWhere('isbn', 'like', "%{$search}%");
                });
            })
            ->when($availability === 'available', fn($q) => $q->available())
            ->when($availability === 'unavailable', fn($q) => $q->unavailable())
            ->paginate(10);

        // Get active loans for ALL users (not just manager's own loans)
        $activeLoans = Loan::with(['book'])
            ->where('user_id', auth()->id())  // Add user filter
            ->where('date_retour', '>', now())
            ->orderBy('date_retour')
            ->get()
            ->map(function ($loan) {
                // Calculate time remaining using Carbon
                $loan->time_remaining = now()->diffForHumans($loan->date_retour, [
                    'parts' => 2,
                    'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE
                ]);

                // Add overdue status
                $loan->is_overdue = $loan->date_retour->isPast();

                return $loan;
            });

        return view('user.dashboard', compact(
            'filteredBooks',
            'activeLoans',
            'search',
            'availability'
        ));
    }

    public function borrow(Request $request)
    {
        $request->validate(['book_isbn' => 'required|exists:books,isbn']);
        $book = Book::findOrFail($request->book_isbn);

        if (!$book->isAvailable()) {
            return back()->with('error', 'This book is not available for borrowing');
        }

        Loan::create([
            'user_id' => auth()->id(),
            'book_isbn' => $book->isbn,
            'date_emprunt' => now(),
            'date_retour' => now()->addWeeks(2),
        ]);

        $book->decrement('disponible');
        return back()->with('success', "Book '{$book->titre}' borrowed successfully");
    }
    // Add these methods to UserBookController
    public function returnBook(Request $request)
    {
        $request->validate(['loan_id' => 'required|exists:loans,id']);
        $loan = Loan::findOrFail($request->loan_id);

        // Verify ownership
        if ($loan->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action');
        }

        if ($loan->date_retour->isFuture()) {
            $loan->update(['date_retour' => now()]);
            Book::where('isbn', $loan->book_isbn)->increment('disponible');
        }

        return back()->with('success', 'Book returned successfully');
    }

    public function extendLoan(Request $request)
    {
        $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'new_return_date' => [
                'required',
                'date',
                'after:' . now()->addDay()->format('Y-m-d'),
                function ($value, $fail) use ($request) {
                    $loan = Loan::find($request->loan_id);
                    if ($value <= $loan->date_retour->format('Y-m-d')) {
                        $fail("New date must be after current return date");
                    }
                }
            ]
        ]);

        $loan = Loan::findOrFail($request->loan_id);

        // Verify ownership
        if ($loan->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action');
        }

        $loan->update(['date_retour' => $request->new_return_date]);
        return back()->with('success', 'Loan extended successfully');
    }
}
