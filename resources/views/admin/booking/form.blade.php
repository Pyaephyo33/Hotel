@extends('admin.layouts.master')
@section('title', 'Booking')
@section('subtitle', 'Form')
@section('content')

<div class="p-6 px-4">
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">

        {{-- Form Head --}}
            <div class="grid grid-cols-6 gap-4 mb-3">
                <div class="col-start-1 col-end-3">
                    <h5 class="card-title">Booking Entry Form</h5>
                </div>
                <div class="col-end-9 col-span-2">
                    <a href="{{url('admin/bookings')}}" class="flex items-center btn btn-outline btn-sm hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M2.515 10.674a1.875 1.875 0 0 0 0 2.652L8.89 19.7c.352.351.829.549 1.326.549H19.5a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-9.284c-.497 0-.974.198-1.326.55l-6.375 6.374ZM12.53 9.22a.75.75 0 1 0-1.06 1.06L13.19 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 1 0 1.06-1.06L15.31 12l1.72-1.72a.75.75 0 1 0-1.06-1.06l-1.72 1.72-1.72-1.72Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Form --}}
            @if(empty($booking->id))
            <form action="{{url('admin/bookings')}}" method="post">
                @else
                <form action="{{url('admin/bookings/'.$booking->id)}}" method="post">
                    @method('PATCH')
            @endif
            @csrf
            <div class="grid grid-cols-1 gap-1">
                <div>
                    <label class="form-control w-full my-1">
                        <div class="label">
                            <span class="label-text-2xl">Room</span>
                        </div>
                        <select name="room_id" class="select select-bordered w-full @error('room_id') select-error @enderror">
                            <option disabled selected>Select Room</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div>
                    <label class="form-control w-full">
                    <div class="label">
                      <span class="label-text-2xl">Check In</span>
                    </div>
                    <input type="date" placeholder="Enter Check In" class="input input-bordered w-full @error('check_in') input-error @enderror" id="check_in" name="check_in" value="{{old('check_in') ?? $booking->check_in}}" />
                    @error('check_in')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                  </label>
                </div>
                <div>
                    <label class="form-control w-full">
                    <div class="label">
                      <span class="label-text-2xl">Check Out</span>
                    </div>
                    <input type="date" placeholder="Enter Check Out" class="input input-bordered w-full @error('check_out') input-error @enderror" id="check_out" name="check_out" value="{{old('check_out') ?? $booking->check_out}}" />
                    @error('check_out')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                  </label>
                </div>
                <div>
                    <label class="form-control w-full">
                    <div class="label">
                      <span class="label-text-2xl">Person</span>
                    </div>
                    <input type="number" placeholder="Enter Person Number" class="input input-bordered w-full @error('person') input-error @enderror" id="person" name="person" value="{{old('person') ?? $booking->person}}" />
                    @error('person')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                  </label>
                </div>
                <div>
                    <label class="form-control w-full">
                    <div class="label">
                      <span class="label-text-2xl">Extra Bed</span>
                    </div>
                    <input type="number" placeholder="Enter Extra Bed" class="input input-bordered w-full @error('extra') input-error @enderror" id="extra" name="extra" value="{{old('extra') ?? $booking->extra}}" />
                    @error('extra')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                  </label>
                </div>
                <div>
                    <label class="form-control w-full">
                    <div class="label">
                      <span class="label-text-2xl">Remark</span>
                    </div>
                    <input type="text" placeholder="Enter Remark" class="input input-bordered w-full @error('remark') input-error @enderror" id="remark" name="remark" value="{{old('remark') ?? $booking->remark}}" />
                    @error('remark')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                  </label>
                </div>
            </div>
           <div class="grid justify-items-end mt-5">
                <div class="flex space-x-2">
                    @if(empty($booking->id))
                        <button type="reset" class="btn btn-active btn-sm my-3">Reset</button>
                        <button type="submit" class="btn btn-primary btn-sm my-3">Add</button>
                    @else
                        <a href="{{url('admin/bookings')}}" class="btn btn-active btn-sm">Cancel</a>
                        <button type="submit" class="btn btn-info btn-sm">Update</button>
                    @endif
                </div>
           </div>
        </form>
    </div>
</div>

@endsection
