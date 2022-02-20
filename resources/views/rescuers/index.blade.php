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
@endif

<div class="pt-8 pb-4 px-8">
    <a href="rescuer/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add a new rescuer &rarr;
    </a>
</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white">
            <th class="w-screen text-3xl">Id</th> 
            <th class="w-screen text-3xl">First Name</th>
            <th class="w-screen text-3xl">Last Name</th>
            <th class="w-screen text-3xl">Phone Number</th>
            <th class="w-screen text-3xl">Rescuer Pic</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
        </tr>

  @forelse ($rescuers as $rescuer)
      <tr>
        <td class=" text-center text-3xl">
            {{ $rescuer->rescuer_id  }}
      </td>
          <td class=" text-center text-3xl">
                {{ $rescuer->first_name }}
          </td>
          <td class=" text-center text-3xl">
                {{ $rescuer->last_name }}
          </td>
          <td class=" text-center text-3xl">
                {{ $rescuer->phone_number }}
          </td>
          <td class="pl-24">
            <img src="{{ asset('uploads/rescuers/'.$rescuer->images)}}" alt="I am A Pic" width="75" height="75">
          </td>
          <td class=" text-center">
            <a href="rescuer/{{ $rescuer->rescuer_id }}/edit" class="text-center text-3xl bg-green-600 p-2">
                Update &rarr; 
               </a>
          </td>
          <td class=" text-center">
            <form action="/rescuer/{{ $rescuer->rescuer_id }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="text-center text-3xl bg-red-600 p-2">
                    Delete &rarr;
                </button>
           </form>
          </td>
      </tr>
            @empty
                <p>No Rescuer Data in the Database</p>
            @endforelse
        </table>
    </div>
</div>
@endsection