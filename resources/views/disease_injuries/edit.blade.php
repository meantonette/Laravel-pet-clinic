@extends('home')

@section('contents')
<div class="pb-20 my-5">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Disease/Injury
        </h1>
    </div>
<div>
        <div class="flex justify-center pt-4">
            <form action="/diseaseinjury/{{ $disease_injuries->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="block">

                    <div>
                    <label for="classify" class="text-lg">Classify</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="classify"
                    value="{{ $disease_injuries->classify }}">
                    @if($errors->has('classify'))
                    <p class="text-center text-red-500">{{ $errors->first('classify') }}</p>
                    @endif 
                    </div>

                    <label for="animals_id" class="text-lg">Animal Name</label>
                    <select name="animals_id" id="animals_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($animals as $animal)
                            <option value="{{ $animal->animals_id }}">{{ $animal->animal_name }}</option>
                        @endforeach
                    </select>
