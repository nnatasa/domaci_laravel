<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = auth()->user()->allBooks();
        return view('dashboard', compact('books'));
    }

    public function add()
    {
        return view('add');
    }

    public function seeAuthors()
    {
        return view('seeAuthors');
    }

    public function create(Request $request)
    {
        $this->validate($request, [ //proveri da li je ispravno unesen spoljni kljuc
            'author_id' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);
        $book = new Book();
        $book->author_id =  $request->author_id;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->user_id =  auth()->user()->id;

        $book->save();

        return redirect('/dashboard');
    }

    public function edit(Book $book)
    {
        return view('edit', compact('book'));
    }

    public function details(Book $book)
    {
        return view('details', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        if (isset($_POST['delete'])) {
            $book->delete();
            return redirect('/dashboard');
        } else {
            $this->validate($request, [ //proveri da li je ispravno unesen spoljni kljuc
                'author_id' => 'required',
                'title' => 'required',
                'description' => 'required'
            ]);

            $book->author_id =  $request->author_id;
            $book->title = $request->title;
            $book->description = $request->description;

            $book->save();

            return redirect('/dashboard');
        }
    }
}
