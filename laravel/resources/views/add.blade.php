<x-app-layout>
    <x-slot name="header">
        <h2 class="font semibold text-xl text-gray-800 leading-tight">
            {{__('Add Book')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <form action="/book" method="POST">
                    <div class="form-group">
                        <label for="author_id">Author ID:</label>
                        <select name="author_id" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-10 py-2 px-3 font-medium focus:outline-none focus:bg-white my-5" >
                            @foreach(App\Models\Author::all() as $author)
                            <option value="{{$author->id}}">{{$author->firstname." ".$author->lastname}}</option>
                            @endforeach
                        </select>
                        <!-- <input type="text" name="author_id" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-10 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white my-5"></input> -->
                        @if ($errors->has('author_id'))
                        <span class="text-danger">{{ $errors->first('author_id') }}</span>
                        @endif
                        <label for="title">Book title:</label>
                        <input type="text" name="title" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-10 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white my-5"></input>
                        @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                        <label for="description">Book description:</label>
                        <textarea name="description" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white my-5"></textarea>
                        @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Book</button>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>

        </div>

    </div>

</x-app-layout>