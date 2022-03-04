@extends('home')

@section('contents')
<div class="pb-20 my-5">
    <div class="text-center">
        <h1 class="text-5xl">
            Add Disease/Injury
        </h1>
    </div>
    <div>

        <div class="flex justify-center pt-3">
            <form action="/diseaseinjury" method="POST">
                @csrf
                <div class="block">
                    <div>
                        <label for="classify" class="text-lg">Classify</label>
                        <input type="text" class="block shadow-5xl p-2 my-5 w-full" id="classify" name="classify"
                            placeholder="Classify" value="{{old('classify')}}">
                        @if($errors->has('classify'))
                        <p class="text-center text-red-500">{{ $errors->first('classify') }}</p>
                        @endif
                    </div>

                    <label for="animals_id" class="text-lg">Animal Name</label>
                    <select name="animals_id" id="animals_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($animals as $id => $animal)
                        <option value="{{ $id }}">{{ $animal }}</option>
                        @endforeach
                    </select>

                    <div class="grid grid-cols-2 gap-2 w-full">
                        <button type="submit" class="bg-green-800 text-white font-bold p-2 mt-5">
                            Submit
                        </button>
                        <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                            role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        @endsection