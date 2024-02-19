@extends('admin.layouts.master')
@section('title', 'Booking')
@section('subtitle', 'List')
@section('content')

<x-flash-message />

<div class="p-2 px-4">
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">

        <div class="grid grid-cols-6 gap-4 mb-5">
            <div class="col-start-1 col-end-3">
              <a href="{{ url('admin/bookings') }}">
                <h5 class="card-title">Booking List</h5>
              </a>
            </div>
            <div class="col-end-7 col-span-2">
                <form action="{{url('admin/search-bookings')}}" class="float-right" method="GET">
                    @csrf
                    <div class="flex items-center">
                        <input type="text" name="search" class="input input-bordered btn-sm w-full" placeholder="Search">
                        <div class="flex space-x-2 mx-2">
                            <button type="submit" class="btn btn-outline btn-sm">Search</button>
                            <a href="{{url('admin/bookings/create')}}" class="flex items-center btn btn-outline btn-sm btn-primary hover:text-white">
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
                  <th>Voucher</th>
                  <th>Room</th>
                  <th>Check In</th>
                  <th>Check Out</th>
                  <th>Person</th>
                  <th>Extra</th>
                  <th>Remark</th>
                </tr>
              </thead>
              <tbody>
                @foreach($bookings as $booking)
                <tr>
                  <th>{{ $booking->id }}</th>
                  <td>{{ $booking->voucher }}</td>
                  <td>
                        @foreach($booking->rooms as $room)
                            {{ $room->name }}
                        @endforeach
                  </td>
                  <td>{{ $booking->check_in }}</td>
                  <td>{{ $booking->check_out }}</td>
                  <td>{{ $booking->person }}</td>
                  <td>{{ $booking->extra }}</td>
                  <td>{{ $booking->remark }}</td>
                  <td class="flex space-x-2">
                    <a href="{{ route('bookings.show', ['id' => $booking->id]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-indigo-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
                        </svg>
                    </a>
                    <a href="#" onclick="document.getElementById('deleteModal{{ $booking->id }}').showModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-700 flex-shrink-0 group-hover:text-gray-900 transition duration-75">
                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                  </td>
                </tr>

                  {{-- Delete Modal --}}
                  <dialog id="deleteModal{{ $booking->id }}" class="modal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg text-yellow-600">Delete Confirm!</h3>
                        <p class="py-4">Are you sure you want to delete?</p>
                        <div class="modal-action">
                            <form id="deleteForm{{ $booking->id }}" action="{{ url('admin/bookings/' . $booking->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="button" onclick="submitDeleteForm('{{ $booking->id }}')" class="btn btn-error btn-sm">Delete</button>
                                <button type="button" onclick="document.getElementById('deleteModal{{ $booking->id }}').close()" class="btn btn-sm">Close</button>
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
@endsection
