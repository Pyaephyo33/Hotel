@extends('admin.layouts.master')
@section('title', 'Booking')
@section('subtitle', 'Detail')
@section('content')

<div class="p-2 px-4">
    <div class="bg-white shadow rounded-lg sm:p-6 xl:p-8">
        <div>
            <h1 class="text-center text-lg text-semibold">Booking Detail</h1>
        </div>
        <div class="grid grid-cols-4 gap-4 py-3">
            <div class="flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>
                <h5>Bagan</h5>
            </div>
            <div class="flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                </svg>
                <h5>01232132</h5>
            </div>
            <div class="flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <h5>hotline@mail.com</h5>
            </div>
            <div class="flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m6.115 5.19.319 1.913A6 6 0 0 0 8.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 0 0 2.288-4.042 1.087 1.087 0 0 0-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 0 1-.98-.314l-.295-.295a1.125 1.125 0 0 1 0-1.591l.13-.132a1.125 1.125 0 0 1 1.3-.21l.603.302a.809.809 0 0 0 1.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 0 0 1.528-1.732l.146-.292M6.115 5.19A9 9 0 1 0 17.18 4.64M6.115 5.19A8.965 8.965 0 0 1 12 3c1.929 0 3.716.607 5.18 1.64" />
                </svg>
                <h5>www.hotel.com</h5>
            </div>
        </div>
        <hr class="clear-both border-none h-1 bg-gray-500">

        <h1 class="text-start px-1 text-2xl text-bold pt-5">BOOKING SLIP</h1>

        <div class="grid grid-cols-6 gap-4 px-1 pt-2">
            <div class="col-start-1 col-end-3">
                <div class="flex space-x-1">
                    <h2>CheckIn - Date</h2>
                </div>
                <div class="flex space-x-1">
                    <h2>CheckOut - Date</h2>
                </div>
                <div class="flex space-x-1">
                    <h2>Package - Person</h2>
                </div>
            </div>
            <div class="col-end-7 col-span-2">
                <div class="flex space-x-1">
                    <h2>Voucher No - </h2>
                </div>
                <div class="flex space-x-1">
                    <h2>Room - Room A</h2>
                </div>
                <div class="flex-space-x-1">
                    <h2>Date - Created At</h2>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-6 gap-4 px-1 py-4">
            <div class="col-start-1 col-end-3 py-2">
                <div class="flex space-x-1 pb-1">
                    <h1 class="text-lg text-semibold">Description</h1>
                </div>
                <div class="flex-space-x-1">
                    <h2>Extra</h2>
                </div>
                <div class="flex-space-x-1">
                    <h2>Price</h2>
                </div>
            </div>
            <div class="col-end-7 col-span-2 py-2">
                <div class="flex space-x-1 pb-1">
                    <h1 class="text-lg text-semibold">Amount</h1>
                </div>
                <div class="flex space-x-1">
                    <h2>2 Bed Extra</h2>
                </div>
                <div class="flex space-x-1">
                    <h2>$ 500</h2>
                </div>
            </div>
        </div>
        <hr class="clear-both border-none h-1 bg-gray-500">
        <div class="grid grid-cols-6 gap-4 px-1 py-2">
            <div class="col-start-1 col-end-3 py-2">
                <div class="flex space-x-1">
                    <h2>Total</h2>
                </div>
            </div>
            <div class="col-end-7 col-span-2 py-2">
                <div class="flex space-x-1 pb-1">
                    <div class="flex space-x-1">
                        <h2>$ 1000</h2>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h1 class="text-start text-lg px-1">Remark</h1>
            <textarea name="" id="" rows="3" class="w-full my-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2" disabled></textarea>
        </div>

        <h2 class="text-sm opacity-75 text-start my-2">Thank You for choosing us</h2>


    </div>
</div>

@endsection
