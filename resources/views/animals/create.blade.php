@extends('home')

@section('contents')
<div class="pb-20 my-5">
    <div class="text-center">
        <h1 class="text-5xl">
            Create Animal
        </h1>
    </div>
<div>

        <div class="flex justify-center pt-3">
            <form action="/animals" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <label for="animal_name" class="text-lg">Animal Name</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="animal_name"
                    placeholder="Animal Name">

                    <label for="age" class="text-lg">Age</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="age"
                    placeholder="Age">

                    <label for="gender" class="text-lg"r">Gender</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="gender"
                    placeholder="Gender">

                    <label for="type" class="text-lg"r">Type</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="type"
                    placeholder="Type of Animal">

                    <label for="animal_pic"" class="text-lg">Animal Pic</label>
                    <input type="file"
                    class="block shadow-5xl p-2 w-full"
                    name="animal_pic">

                    <button type="submit" class="bg-gray-800 text-white block p-2 mt-5 w-full font-bold">
                        Submit
                    </button>
                </div>
            </form>
        </div>
        @if ($errors->any())
        <div class="text-center pt-3">
            @foreach ($errors->all() as $error)
                <li class="list-none text-red-500 text-xl">
                    {{ $error }}
                </li>
            @endforeach
        </div>
        @endif
@endsection