@extends('home')

@section('contents')
<div class="pb-20 my-5">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Pet
        </h1>
    </div>
<div>
        <div class="flex justify-center pt-4">
            <form action="/animals/{{ $animals->animals_id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="block">
                    <label for="animal_name" class="text-lg">Animal Name</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="animal_name"
                    value="{{ $animals->animal_name }}">

                    <label for="age" class="text-lg">Age</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="age"
                    value="{{ $animals->age }}">

                    <label for="gender" class="text-lg">Gender</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="gender"
                    value="{{ $animals->gender }}">

                    <label for="type" class="text-lg">Type</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="type"
                    value="{{ $animals->type }}">

                    <label for="animal_pic" class="text-lg">Animal Pic</label>
                    <input type="file"
                    class="block shadow-5xl p-2 w-full"
                    name="animal_pic">
                    <img src="{{ asset('uploads/animals/'.$animals->animal_pic)}}" alt="I am A Pic" width="100" height="100" class="ml-24 pb-2">

                    <button type="submit" class="bg-gray-800 text-white block shadow-5xl p-2 w-full font-bold">
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