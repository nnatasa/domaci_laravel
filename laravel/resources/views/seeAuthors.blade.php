<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Authors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex">
                    <div class="flex-auto text-2xl mb-4">All Available Authors</div>

                </div>
                <table class="w-full text-md rounded mb-4">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left p-3 px-5">Author ID</th>

                            <th class="text-left p-3 px-5">Full name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(App\Models\Author::all() as $author)
                        <tr class="border-b hover:bg-orange-100">
                            <td class="p-3 px-5">
                                {{$author->id}}
                            </td>
                            <td class="p-3 px-5">
                                {{$author->firstname." ".$author->lastname}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>


</x-app-layout>