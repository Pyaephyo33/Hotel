@extends('admin.layouts.master')
@section('title', 'Room Type')
@section('subtitle', 'Form')
@section('content')

<div class="p-6 px-4">
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
        <form action="">
            <div class="grid grid-cols-6 gap-4 mb-3">
                <div class="col-start-1 col-end-3">
                    <h5 class="card-title">Type Form</h5>
                </div>
                <div class="col-end-9 col-span-2">
                    <a href="{{url('admin/roomTypes')}}" class="flex items-center btn btn-outline hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M2.515 10.674a1.875 1.875 0 0 0 0 2.652L8.89 19.7c.352.351.829.549 1.326.549H19.5a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-9.284c-.497 0-.974.198-1.326.55l-6.375 6.374ZM12.53 9.22a.75.75 0 1 0-1.06 1.06L13.19 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 1 0 1.06-1.06L15.31 12l1.72-1.72a.75.75 0 1 0-1.06-1.06l-1.72 1.72-1.72-1.72Z" clip-rule="evenodd" />
                        </svg> 
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="form-control w-full">
                    <div class="label">
                      <span class="label-text-2xl">Name</span>
                    </div>
                    <input type="text" placeholder="Enter Name" class="input input-bordered input-md w-full" />
                  </label>
                </div>
                <div>
                    <label class="form-control w-full">
                    <div class="label">
                      <span class="label-text-2xl">Email</span>
                    </div>
                    <input type="text" placeholder="Enter Name" class="input input-bordered w-full"  />
                  </label>
                </div>
            </div>
            <div>
               <label class="form-control w-full">
               <div class="label">
                 <span class="label-text-2xl">Address</span>
               </div>
               <textarea cols="30" rows="4" placeholder="Enter Address" class="textarea textarea-bordered w-full"></textarea>
             </label>
           </div>
           <div class="grid justify-items-end">
                <div class="flex space-x-2">   
                    <button type="reset" class="btn btn-active my-3">Reset</button>
                    <button type="submit" class="btn btn-primary my-3">Submit</button>
                </div>
           </div>
        </form>
    </div>
</div>

@endsection
