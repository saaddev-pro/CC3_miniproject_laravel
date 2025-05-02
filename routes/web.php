<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibraryManagerController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ManagerUserController;
use App\Http\Controllers\ManagerBookController;
use App\Http\Controllers\UserBookController;

// Public routes - Redirect directly to login
Route::redirect('/', '/login');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Main dashboard redirector
    Route::get('/dashboard', function () {
        $user = auth()->user();
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'library_manager' => redirect()->route('manager.dashboard'),
            default => redirect()->route('user.dashboard')
        };
    })->name('dashboard');

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Regular user dashboard
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Managers Management (CRUD) - Correct view paths
    Route::resource('managers', LibraryManagerController::class)->except(['show'])
        ->names([
            'index' => 'admin.managers.index',
            'create' => 'admin.managers.create',
            'store' => 'admin.managers.store',
            'edit' => 'admin.managers.edit',
            'update' => 'admin.managers.update',
            'destroy' => 'admin.managers.destroy'
        ]);

    // Admin-specific operations
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');

    // Books Management
    Route::resource('books', BookController::class)->except(['show']);
    Route::get('/books/{book:isbn}', [BookController::class, 'show'])->name('books.show');
});

// Library Manager routes
Route::middleware(['auth', 'role:library_manager'])->prefix('manager')->group(function () {
    // Dashboard - Now handled by ManagerBookController
    Route::get('/dashboard', [ManagerBookController::class, 'index'])->name('manager.dashboard');
    
    // User management
    Route::get('/users', [ManagerUserController::class, 'index'])->name('manager.users.index');
    Route::get('/users/create', [ManagerUserController::class, 'create'])->name('manager.users.create');
    Route::post('/users', [ManagerUserController::class, 'store'])->name('manager.users.store');
    
    // Book management
    Route::get('/books', [ManagerBookController::class, 'index'])->name('manager.books.index');
    
    // Loan operations
    Route::post('/manager/books/borrow', [ManagerBookController::class, 'borrow'])
     ->name('manager.books.borrow');
    Route::post('/books/return', [ManagerBookController::class, 'returnBook'])->name('manager.books.return');
    Route::post('/books/extend', [ManagerBookController::class, 'extendLoan'])->name('manager.books.extend');
    Route::post('/manager/books/return', [ManagerBookController::class, 'returnBook'])
     ->name('manager.books.return');
    Route::post('/manager/books/extend', [ManagerBookController::class, 'extendLoan'])
     ->name('manager.books.extend');
});

// User routes
Route::middleware(['auth', 'role.user'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserBookController::class, 'index'])->name('user.dashboard');
    Route::post('/books/borrow', [UserBookController::class, 'borrow'])->name('user.books.borrow');
    Route::post('/books/return', [UserBookController::class, 'returnBook'])->name('user.books.return');
    Route::post('/books/extend', [UserBookController::class, 'extendLoan'])->name('user.books.extend');
    
});





require __DIR__.'/auth.php';