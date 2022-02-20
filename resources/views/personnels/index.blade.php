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

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white">
            <th class="w-screen text-3xl">Id</th> 
            <th class="w-screen text-3xl">Full Name</th>
            <th class="w-screen text-3xl">Email</th>
            <th class="w-screen text-3xl">Role</th>
            <th class="w-screen text-3xl">Personnel Pic</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
        </tr>

  @forelse ($personnels as $personnel)
      <tr>
        <td class=" text-center text-3xl">
            {{ $personnel->personnel_id }}
      </td>
          <td class=" text-center text-3xl">
                {{ $personnel->full_name }}
          </td>
          <td class=" text-center text-3xl">
                {{ $personnel->email }}
          </td>
          <td class=" text-center text-3xl">
                {{ $personnel->role }}
          </td>
          <td class="pl-24">
            <img src="{{ asset('uploads/personnels/'.$personnel->images)}}" alt="I am A Pic" width="75" height="75">
          </td>
          <td class=" text-center">
            <a href="personnel/{{ $personnel->personnel_id }}/edit" class="text-center text-3xl bg-green-600 p-2">
                Update &rarr; 
               </a>
          </td>
          <td class=" text-center">
            <form action="/personnel/{{ $personnel->personnel_id }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="text-center text-3xl bg-red-600 p-2">
                    Delete &rarr;
                </button>
           </form>
          </td>
      </tr>
            @empty
                <p>No Personnel Data in the Database</p>
            @endforelse
        </table>
    </div>
</div>
@endsection