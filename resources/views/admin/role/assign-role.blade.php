@extends('admin.layouts.master')
@section('title', 'Assign Permission')
@section('subtitle', 'Role and Permission')
@section('content')

{{-- <x-flash-message /> --}}

<form action="{{ url('admin/roles/permissions/assign') }}" method="post">
    @csrf
    <div class="p-6 px-4">
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">

        <div class="grid grid-cols-6 gap-4 mb-3">
            <div class="col-start-1 col-end-3">
                <h5 class="card-title">Permission List</h5>
                <h6><span class="font-bold">Role:</span> {{ $role->name }}</h6>
                <input type="hidden" name="role_id" value="{{ $role->id }}">
            </div>
            <div class="col-end-9 col-span-2">
                <a href="{{url('admin/roles')}}" class="flex items-center btn btn-outline btn-sm hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M2.515 10.674a1.875 1.875 0 0 0 0 2.652L8.89 19.7c.352.351.829.549 1.326.549H19.5a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-9.284c-.497 0-.974.198-1.326.55l-6.375 6.374ZM12.53 9.22a.75.75 0 1 0-1.06 1.06L13.19 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 1 0 1.06-1.06L15.31 12l1.72-1.72a.75.75 0 1 0-1.06-1.06l-1.72 1.72-1.72-1.72Z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Permission</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @if(!empty($permissions) && $permissions->count() > 0)
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td><label for="{{ $permission->id }}">{{ $permission->name }}</label>
                        <td>
                            <input type="checkbox" name="permission_ids[]" class="checkbox checkbox-primary" value="{{ $permission->id }}" id="{{ $permission->id }}"
                            @if(!empty($role->permissions) && $role->permissions->contains ('id', $permission->id))
                            checked
                            @endif
                            >
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <p>No Permission Found.</p>
                    @endif
              </tbody>
            </table>
          </div>
          <div class="grid justify-items-end mt-5">
            <div class="flex space-x-2">
                <button type="submit" class="btn btn-primary btn-sm">Assign Permission</button>
            </div>
       </div>
    </div>
</form>

 </div>
@endsection
