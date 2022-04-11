<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Author as AuthorResource;

class AuthorController extends BaseController
{
    public function index(){
        $authors = Author::all();
        return $this->sendResponse(
            AuthorResource::collection($authors),
            'Author retrieved successfully');
        
    }

    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'firstname' => 'required',
            'lastname'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation error', $validator->errors());
        }
        $authors = Author::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Author created successfully',
            'data' => $authors
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

        $authors = Author::find($id);
        if(is_null($authors)){
            return $this->sendError("Author not found!");
        }
        return response()->json([
            "success" => true,
            "message"=> "Author retrived successfully",
            "data"=> $authors
        ]);
    }

    public function update(Request $request, Author $author){
        $input = $request->all();
        $validator = Validator::make($input, [
            'firstname' => 'required',
            'description' => 'required'
        ]);
        
        if($validator->fails()){
            return $this->sendError("Validation error", $validator->errors());
        }

        $author->firstname = $input['firstname'];
        $author->lastname = $input['lastname'];

        return response()->json([
            "success" => true,
            "message"=> "Author updated successfully",
            "data"=> $author
        ]);
    }

    public function destroy(Author $authors){
        $authors->delete();
        return response()->json([
            "success" => true,
            "message"=> "Author deleted successfully",
            "data"=> $authors
        ]);
    }
    
}
