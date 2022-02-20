@extends('home')

@section('contents')
<div class="pb-20 my-5">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Animal
        </h1>
    </div>
<div>
        <div class="flex justify-center pt-4">
            <form action="/animals/{{ $animals->animals_id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="block">

                    <div>
                    <label for="animal_name" class="text-lg">Animal Name</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="animal_name"
                    value="{{ $animals->animal_name }}">
                    @if($errors->has('animal_name'))
                    <p class="text-center text-red-500">{{ $errors->first('animal_name') }}</p>
                    @endif 
                    </div>

                    <div>
                    <label for="age" class="text-lg">Age</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="age"
                    value="{{ $animals->age }}">
                    @if($errors->has('age'))
                    <p class="text-center text-red-500">{{ $errors->first('age') }}</p>
                    @endif 
                    </div>

                    <div>
                    <label for="gender" class="text-lg">Gender</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="gender"
                    value="{{ $animals->gender }}">
                    @if($errors->has('gender'))
                    <p class="text-center text-red-500">{{ $errors->first('gender') }}</p>
                    @endif 
                    </div>

                    <div>
                    <label for="type" class="text-lg">Type</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="type"
                    value="{{ $animals->type }}">
                    @if($errors->has('type'))
                    <p class="text-center text-red-500">{{ $errors->first('type') }}</p>
                    @endif 
                    </div>

                    <div>
                    <label for="images" class="text-lg">Animal Pic</label>
                    <input type="file"
                    class="block shadow-5xl p-2 w-full"
                    name="images">
                    <img src="{{ asset('uploads/animals/'.$animals->images)}}" alt="I am A Pic" width="100" height="100" class="ml-24 pb-2">
                    @if($errors->has('images'))
                    <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                    @endif 
                    </div>

                    <label for="rescuer_id" class="text-lg">Rescuer</label>
                    <select name="rescuer_id" id="rescuer_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($rescuers as $rescuer)
                            <option value="{{ $rescuer->rescuer_id }}">{{ $rescuer->last_name }},{{ $rescuer->first_name }}</option>
                        @endforeach
                    </select>

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