@extends('home')

@section('contents')
<div class="pb-20 my-5">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Rescuer
        </h1>
    </div>
<div>
        <div class="flex justify-center pt-4">
            <form action="/rescuer/{{ $rescuers->rescuer_id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="block">
                    <div>
                    <label for="first_name" class="text-lg">First Name</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="first_name"
                    value="{{ $rescuers->first_name }}">
                    @if($errors->has('first_name'))
                    <p class="text-center text-red-500">{{ $errors->first('first_name') }}</p>
                    @endif 
                    </div>

                    <div>
                    <label for="last_name" class="text-lg">Last_name</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="last_name"
                    value="{{ $rescuers->last_name }}">
                    @if($errors->has('last_name'))
                    <p class="text-center text-red-500">{{ $errors->first('last_name') }}</p>
                    @endif 
                    </div>

                    <div>
                    <label for="phone_number" class="text-lg">Phone Number</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="phone_number"
                    value="{{ $rescuers->phone_number }}">
                    @if($errors->has('phone_number'))
                    <p class="text-center text-red-500">{{ $errors->first('phone_number') }}</p>
                    @endif 
                    </div>

                    <div>
                    <label for="images" class="text-lg">Rescuer Pic</label>
                    <input type="file"
                    class="block shadow-5xl p-2 w-full"
                    name="images">
                    <img src="{{ asset('uploads/rescuers/'.$rescuers->images)}}" alt="I am A Pic" width="100" height="100" class="ml-24 pb-2">
                    @if($errors->has('images'))
                    <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                    @endif 
                    </div>

