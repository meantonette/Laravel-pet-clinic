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
    <a href="diseaseinjury/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add a new disease/injury &rarr;
    </a>
</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white">
            <th class="w-screen text-3xl">Id</th> 
            <th class="w-screen text-3xl">Classify</th>
            <th class="w-screen text-3xl">Animal Name</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
        </tr>

  @forelse ($disease_injuries as $disease_injury)
      <tr>
        <td class=" text-center text-3xl">
            {{ $disease_injury->id }}
        </td>
          <td class=" text-center text-3xl">
                {{ $disease_injury->classify }}
          </td>
          <td class=" text-center text-3xl">
            {{ $disease_injury->animal->animal_name }}
         </td>
          <td class=" text-center">
            <a href="diseaseinjury/{{ $disease_injury->id }}/edit" class="text-center text-3xl bg-green-600 p-2">
                Update &rarr; 
               </a>
          </td>
          <td class=" text-center">
            <form action="/diseaseinjury/{{ $disease_injury->id }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="text-center text-3xl bg-red-600 p-2">
                    Delete &rarr;
                </button>
           </form>
          </td>
      </tr>
            @empty
                <p>No Disease/Injury Data in the Database</p>
            @endforelse
        </table>
    </div>
</div>
@endsection