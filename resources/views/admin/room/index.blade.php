@extends('admin.layouts.master')
@section('title', 'Room')
@section('subtitle', 'List')
@section('content')

<x-flash-message />

<div class="p-6 px-4">
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">

        <div class="grid grid-cols-6 gap-4 mb-5">
            <div class="col-start-1 col-end-3">
              <a href="{{ url('admin/rooms') }}">
                <h5 class="card-title">Room List</h5>
              </a>
            </div>
            <div class="col-end-7 col-span-2">
                <form action="{{url('admin/search-rooms')}}" class="float-right" method="GET">
                    @csrf
                    <div class="flex items-center">
                        <input type="text" name="search" class="input input-bordered btn-sm w-full" placeholder="Search">
                        <div class="flex space-x-2 mx-2">
                            <button type="submit" class="btn btn-outline btn-sm">Search</button>
                            <a href="{{url('admin/rooms/create')}}" class="flex items-center btn btn-outline btn-sm btn-primary hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Room</th>
                  <th>No</th>
                  <th>Type</th>
                  <th>Person</th>
                  <th>Price</th>
                  <th>Code</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($rooms as $room)
                <tr>
                  <th>{{ $room->id }}</th>
                  <td>
                    @if($room->picture && $room->picture != 'No Image Available')
                        <img src="{{ asset('rooms/' . $room->picture) }}" alt="Image" class="max-w-20 rounded">
                    @else
                        <p class="text-xs font-bold hover:text-violet-800">No Image</p>
                    @endif
                  </td>
                  <td>{{ $room->name }}</td>
                  <td>{{ $room->roomType ? $room->roomType->name : 'N/A' }}</td>
                  <td>{{ $room->person }}</td>
                  <td>$ {{ $room->price }}</td>
                  <td>{{ $room->code }}</td>
                  <td>
                    @if($room->status == true)
                        <span class="badge badge-accent badge-outline" onclick="openModal('{{ $room->id }}')">Available</span>
                    @else
                        <span class="badge badge-outline" onclick="openModal('{{ $room->id }}')">Unavailable</span>
                    @endif
                </td>
                  <td class="flex space-x-2">
                    <a href="{{url('admin/rooms/'.$room->id.'/edit')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-cyan-700 flex-shrink-0 group-hover:text-gray-900 transition duration-75">
                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                          </svg>
                    </a>
                    <a href="#" onclick="document.getElementById('deleteModal{{ $room->id }}').showModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-700 flex-shrink-0 group-hover:text-gray-900 transition duration-75">
                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                  </td>
                </tr>

                  {{-- Delete Modal --}}
                  <dialog id="deleteModal{{ $room->id }}" class="modal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg text-yellow-600">Delete Confirm!</h3>
                        <p class="py-4">Are you sure you want to delete?</p>
                        <div class="modal-action">
                            <form id="deleteForm{{ $room->id }}" action="{{ url('admin/rooms/' . $room->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="button" onclick="submitForm('{{ $room->id }}')" class="btn btn-error btn-sm">Delete</button>
                                <button type="button" onclick="document.getElementById('deleteModal{{ $room->id }}').close()" class="btn btn-sm">Close</button>
                            </form>
                        </div>
                    </div>
                  </dialog>


                  <dialog id="statusModal{{ $room->id }}" class="modal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg text-yellow-600">Change Status Confirm!</h3>
                        <p class="py-4">Are you sure you want to change the status?</p>
                        <div class="modal-action">
                            <form id="statusForm{{ $room->id }}" action="{{ url('admin/rooms/status/' . $room->id) }}" method="post">
                                @csrf
                                @method('get') <!-- Assuming you are updating the status, so use PUT method -->
                                <button type="button" onclick="submitStatusForm('{{ $room->id }}')" class="btn btn-warning btn-sm">Change</button>
                                <button type="button" onclick="closeModal('{{ $room->id }}')" class="btn btn-sm">Close</button>
                            </form>
                        </div>
                    </div>
                </dialog>
                @endforeach
              </tbody>
            </table>
          </div>
    </div>
 </div>

 <script>
   function submitForm(id) {
        // Trigger form submission
        document.getElementById('deleteForm' + id).submit();
        // Close the delete modal
        document.getElementById('deleteModal' + id).close();
    }

    function openModal(roomId) {
        document.getElementById('statusModal' + roomId).showModal();
    }

    function closeModal(roomId) {
        document.getElementById('statusModal' + roomId).close();
    }

    function submitStatusForm(roomId) {
        document.getElementById('statusForm' + roomId).submit();
    }
 </script>
@endsection
