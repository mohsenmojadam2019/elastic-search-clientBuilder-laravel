<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Services\EsService;
use GuzzleHttp\Client;
use Inertia\Inertia;

class BookController extends Controller
{

    public $es_service;
    public function __construct()
    {
        // $this->middleware('auth');
        $this->es_service = new EsService();
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $books = Book::select(['id','title','description','author','genre','isbn','image','publisher','published'])->orderBy('id', 'desc')->paginate(100);
        return Inertia::render('Book/Index',['books'=>$books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render(
            'Book/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $res = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'genre' => $request->genre,
            'isbn' => $request->isbn,
            'publisher' => $request->publisher,
            'published' => $request->published,
            'image' => $request->image,
        ]);

        $this->es_service->create($res);
        sleep(1);

        if($res){
            return redirect()->route('book.index')->with('message', 'Book Added Successfully');
        }else{
            return redirect()->route('book.index')->with('message', 'Error!!');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        // dd($book);
        return Inertia::render(
            'Book/Edit',
            [
                'books' => $book
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {

        $book->title = $request->title;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->genre = $request->genre;
        $book->isbn = $request->isbn;
        $book->publisher = $request->publisher;
        $book->published = $request->published;
        $book->image = $request->image;
        $book->save();
        sleep(1);

        return redirect()->route('book.index')->with('message', 'Book Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        sleep(1);

        return redirect()->route('book.index')->with('message', 'Book Delete Successfully');
    }

    public function importDummyData(){
        // dd("Rishabh");
        $client = new Client();
        $stateQuery = $client->get('https://fakerapi.it/api/v1/books?_quantity=1000');
        $Data = $stateQuery->getBody();
        $Data = json_decode($Data, true)['data'];

        foreach ($Data as  $value) {
            $es = new EsService();
            Book::create($value);
            $es->create($value);
        }
        return redirect()->route('book.index')->with('message', 'Books Imported Successfully');

    }

}
