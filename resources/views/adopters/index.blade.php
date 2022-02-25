@extends('home')

@section('contents')

@if ($message = Session::get('add'))
 <div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
 </div>
 @elseif ($message = Session::get('update'))
 <div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
 </div>
 @elseif ($message = Session::get('delete'))
 <div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
 </div>
 @elseif ($message = Session::get('restore'))
 <div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
 </div>
 @elseif ($message = Session::get('force'))
 <div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
 </div>
@endif

<div class="pt-8 pb-4 px-8">
    <a href="adopter/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add a new adopter &rarr;
    </a>
</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white">
            <th class="w-screen text-3xl">Id</th> 
            <th class="w-screen text-3xl">First Name</th>
            <th class="w-screen text-3xl">Last Name</th>
            <th class="w-screen text-3xl">Phone Number</th>
            <th class="w-screen text-3xl">Adopter Pic</th>
            <th class="w-screen text-3xl">Animal Name</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
            <th class="w-screen text-3xl">Restore</th>
            <th class="w-screen text-3xl">Destroy</th>
        </tr>

  @forelse ($adopters as $adopter)
      <tr>
        <td class=" text-center text-3xl">
            {{ $adopter->adopter_id }}
      </td>
          <td class=" text-center text-3xl">
                {{ $adopter->first_name }}
          </td>
          <td class=" text-center text-3xl">
                {{ $adopter->last_name }}
          </td>
          <td class=" text-center text-3xl">
                {{ $adopter->phone_number }}
          </td>
          <td class="pl-24">
            <img src="{{ asset('uploads/adopters/'.$adopter->images)}}" alt="I am A Pic" width="75" height="75">
          </td>
          <td class=" text-center text-3xl">
            {{ $adopter->animal->animal_name }}
         </td>
          <td class=" text-center">
            <a href="adopter/{{ $adopter->adopter_id }}/edit" class="text-center text-3xl bg-green-600 p-2">
                Update &rarr; 
               </a>
          </td>
          <td class=" text-center">
            {!! Form::open(array('route' => array('adopter.destroy', $adopter->adopter_id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-3xl bg-red-600 p-2">
                    Delete &rarr;
                </button>
            {!! Form::close() !!}
          </td>
      </tr>
            @empty
                <p>No Adopter Data in the Database</p>
            @endforelse
        </table>
    </div>
</div>
@endsection