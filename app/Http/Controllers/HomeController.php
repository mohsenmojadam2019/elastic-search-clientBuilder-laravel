<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Foundation\Application;
// use Illuminate\Http\Request;
use Inertia\Inertia;
use Route;
use Request;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::query()
        ->when(Request::input('search'), function ($query, $search) {
                        $query->where('title', 'like', '%' . $search . '%')
                            ->OrWhere('author', 'like',  $search )
                            ->OrWhere('genre', 'like',  $search )
                            ->OrWhere('publisher', 'like',  $search )
                            ->OrWhere('isbn', 'like',  $search );
            })->paginate(100)->appends(Request::input());
        return Inertia::render('Welcome', [
            'books'=>$books,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function bookDetail($id){
        $book = Book::find($id);
        // dd($book);
        return Inertia::render(
            'Detail',[
                'book'=>$book,
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register')
            ]
        );
    }
}
