<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Book as BookResource;

class BookController extends BaseController
{
    public function index(){
        $books = Book::all();
        return $this->sendResponse(
            BookResource::collection($books),
            'Books retrieved successfully');
        
    }

    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'author_id' => 'required',
            'title'=>'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation error', $validator->errors());
        }
        $book = Book::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Book created successfully',
            'data' => $book
        ]);
    }

    public function show(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'id' => 'required'
        ]);
        
        if($validator->fails()){
            return $this->sendError("Validation error", $validator->errors());
        }

        $id = $input['id'];

        $book = Book::find($id);
        if(is_null($book)){
            return $this->sendError("Book not found!");
        }
        return response()->json([
            "success" => true,
            "message"=> "Book retrived successfully",
            "data"=> $book
        ]);
    }

    public function update(Request $request, Book $book){
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);
        
        if($validator->fails()){
            return $this->sendError("Validation error", $validator->errors());
        }

        $book->title = $input['title'];
        $book->description = $input['description'];

        return response()->json([
            "success" => true,
            "message"=> "Book updated successfully",
            "data"=> $book
        ]);
    }

    public function destroy(Book $book){
        $book->delete();
        return response()->json([
            "success" => true,
            "message"=> "Book deleted successfully",
            "data"=> $book
        ]);
    }
    
}
