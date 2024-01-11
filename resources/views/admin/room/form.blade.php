@extends('admin.layouts.master')
@section('title', 'Room')
@section('subtitle', 'Form')
@section('content')

<div class="p-6 px-4">
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">

        {{-- Form Head --}}
            <div class="grid grid-cols-6 gap-4 mb-3">
                <div class="col-start-1 col-end-3">
                    <h5 class="card-title">Room Form</h5>
                </div>
                <div class="col-end-9 col-span-2">
                    <a href="{{url('admin/rooms')}}" class="flex items-center btn btn-outline btn-sm hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M2.515 10.674a1.875 1.875 0 0 0 0 2.652L8.89 19.7c.352.351.829.549 1.326.549H19.5a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-9.284c-.497 0-.974.198-1.326.55l-6.375 6.374ZM12.53 9.22a.75.75 0 1 0-1.06 1.06L13.19 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 1 0 1.06-1.06L15.31 12l1.72-1.72a.75.75 0 1 0-1.06-1.06l-1.72 1.72-1.72-1.72Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Form --}}
            @if(empty($room->id))
            <form action="{{url('admin/rooms')}}" method="post" enctype="multipart/form-data">
                @else
                <form action="{{url('admin/rooms/'.$room->id)}}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
            @endif
            @csrf
            <div class="grid grid-cols-1 gap-1">
                <div>
                    <label class="form-control w-full my-1">
                    <div class="label">
                      <span class="label-text-2xl">Image File</span>
                    </div>
                    <input type="file" class="file-input file-input-bordered w-full @error('picture') file-input-error  @enderror" id="picture" name="picture" value="{{old('picture') ?? $room->picture}}" />
                    @error('picture')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                  </label>
                </div>
                <div>
                    <label class="form-control w-full my-1">
                    <div class="label">
                      <span class="label-text-2xl">Name</span>
                    </div>
                    <input type="text" placeholder="Enter Name" class="input input-bordered w-full @error('name') input-error @enderror" id="name" name="name" value="{{old('name') ?? $room->name}}" />
                    @error('name')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                  </label>
                </div>
                <div>
                    <label class="form-control w-full my-1">
                        <div class="label">
                            <span class="label-text-2xl">Room Type</span>
                        </div>
                        <select name="room_type_id" id="" class="select select-bordered w-full @error('room_type_id') select-error @enderror">
                            <option disabled selected>Select Type</option>
                            @foreach($roomTypes as $roomType)
                                <option value="{{ $roomType->id }}"
                                    {{ $roomType->id == $room->room_type_id || old('room_type_id') == $roomType->id ? 'selected' : '' }}>
                                    {{ $roomType->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_type_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div>
                    <label class="form-control w-full my-1">
                    <div class="label">
                      <span class="label-text-2xl">Person</span>
                    </div>
                    <input type="number" placeholder="Enter Person" class="input input-bordered w-full @error('person') input-error @enderror" id="person" name="person" value="{{old('person') ?? $room->person}}" />
                    @error('person')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                  </label>
                </div>
                <div>
                    <label class="form-control w-full my-1">
                    <div class="label">
                      <span class="label-text-2xl">Price</span>
                    </div>
                    <input type="text" placeholder="Enter Price" class="input input-bordered w-full @error('price') input-error @enderror" id="price" name="price" value="{{old('price') ?? $room->price}}" />
                    @error('price')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                  </label>
                </div>
            </div>
           <div class="grid justify-items-end mt-5">
                <div class="flex space-x-2">
                    @if(empty($room->id))
                        <button type="reset" class="btn btn-active btn-sm my-3">Reset</button>
                        <button type="submit" class="btn btn-primary btn-sm my-3">Add</button>
                    @else
                        <a href="{{url('admin/rooms')}}" class="btn btn-active btn-sm">Cancel</a>
                        <button type="submit" class="btn btn-info btn-sm">Update</button>
                    @endif
                </div>
           </div>
        </form>
    </div>
</div>

@endsection
