<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="h-full font-mono">

    <!-- component -->
<!-- This is an example component -->
<div>
    <nav class="bg-white border-b border-gray-200 fixed z-30 w-full">
       <div class="px-3 py-3 lg:px-5 lg:pl-3">
          <div class="flex items-center justify-between">
             <div class="flex items-center justify-start">
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="lg:hidden mr-2 text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded">
                   <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                   </svg>
                   <svg id="toggleSidebarMobileClose" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                   </svg>
                </button>
                <a href="#" class="text-xl font-bold flex items-center lg:ml-2.5">
                <img src="{{ asset('raven.jpg') }}" class="h-6 mr-2 rounded-sm" alt="Windster Logo">
                <span class="self-center whitespace-nowrap">Reservation</span>
                </a>
                {{-- <form action="#" method="GET" class="hidden lg:block lg:pl-32">
                   <label for="topbar-search" class="sr-only">Search</label>
                   <div class="mt-1 relative lg:w-64">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                         <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                         </svg>
                      </div>
                      <input type="text" name="email" id="topbar-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full pl-10 p-2.5" placeholder="Search">
                   </div>
                </form> --}}
             </div>
             <div class="flex items-center">
                <button id="toggleSidebarMobileSearch" type="button" class="lg:hidden text-gray-500 hover:text-gray-900 hover:bg-gray-100 p-2 rounded-lg">
                   <span class="sr-only">Search</span>
                   <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                   </svg>
                </button>
                {{-- <a href="#" class="hidden sm:inline-flex ml-5 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center mr-3">
                   <svg class="svg-inline--fa fa-gem -ml-1 mr-2 h-4 w-4" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="gem" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                      <path fill="currentColor" d="M378.7 32H133.3L256 182.7L378.7 32zM512 192l-107.4-141.3L289.6 192H512zM107.4 50.67L0 192h222.4L107.4 50.67zM244.3 474.9C247.3 478.2 251.6 480 256 480s8.653-1.828 11.67-5.062L510.6 224H1.365L244.3 474.9z"></path>
                   </svg>
                   Upgrade to Pro
                </a> --}}
             </div>
          </div>
       </div>
    </nav>
    <div class="flex overflow-hidden bg-white pt-16">
       <aside id="sidebar" class="fixed hidden z-20 h-full top-0 left-0 pt-16 flex lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75" aria-label="Sidebar">
          <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
             <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                @include('admin.layouts.sidebar')
             </div>
          </div>
       </aside>
       <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
       <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
        <div class="text-sm breadcrumbs mx-5">
            <ul>
              <li>@yield('title')</li>
              <li>@yield('subtitle')</li>
            </ul>
          </div>
          <main>
             {{-- <div class="p-6 px-4"> --}}
                {{-- <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                   <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                      <div class="flex items-center justify-between mb-4">
                         <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">$45,385</span>
                            <h3 class="text-base font-normal text-gray-500">Sales this week</h3>
                         </div>
                         <div class="flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                            12.5%
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                         </div>
                      </div>
                      <div id="main-chart"></div>
                   </div>
                   <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                      <div class="mb-4 flex items-center justify-between">
                         <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Latest Transactions</h3>
                            <span class="text-base font-normal text-gray-500">This is a list of latest transactions</span>
                         </div>
                         <div class="flex-shrink-0">
                            <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
                         </div>
                      </div>
                      <div class="flex flex-col mt-8">
                         <div class="overflow-x-auto rounded-lg">
                            <div class="align-middle inline-block min-w-full">
                               <div class="shadow overflow-hidden sm:rounded-lg">
                                  <table class="min-w-full divide-y divide-gray-200">
                                     <thead class="bg-gray-50">
                                        <tr>
                                           <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                              Transaction
                                           </th>
                                           <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                              Date & Time
                                           </th>
                                           <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                              Amount
                                           </th>
                                        </tr>
                                     </thead>
                                     <tbody class="bg-white">
                                        <tr>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                              Payment from <span class="font-semibold">Bonnie Green</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              Apr 23 ,2021
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              $2300
                                           </td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                              Payment refund to <span class="font-semibold">#00910</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              Apr 23 ,2021
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              -$670
                                           </td>
                                        </tr>
                                        <tr>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                              Payment failed from <span class="font-semibold">#087651</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              Apr 18 ,2021
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              $234
                                           </td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                              Payment from <span class="font-semibold">Lana Byrd</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              Apr 15 ,2021
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              $5000
                                           </td>
                                        </tr>
                                        <tr>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                              Payment from <span class="font-semibold">Jese Leos</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              Apr 15 ,2021
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              $2300
                                           </td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                              Payment from <span class="font-semibold">THEMESBERG LLC</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              Apr 11 ,2021
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              $560
                                           </td>
                                        </tr>
                                        <tr>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                              Payment from <span class="font-semibold">Lana Lysle</span>
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                              Apr 6 ,2021
                                           </td>
                                           <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                              $1437
                                           </td>
                                        </tr>
                                     </tbody>
                                  </table>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div> --}}
                {{-- <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                   <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                      <div class="flex items-center">
                         <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">2,340</span>
                            <h3 class="text-base font-normal text-gray-500">New products this week</h3>
                         </div>
                         <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                            14.6%
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                         </div>
                      </div>
                   </div>
                   <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                      <div class="flex items-center">
                         <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">5,355</span>
                            <h3 class="text-base font-normal text-gray-500">Visitors this week</h3>
                         </div>
                         <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                            32.9%
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                         </div>
                      </div>
                   </div>
                   <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                      <div class="flex items-center">
                         <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">385</span>
                            <h3 class="text-base font-normal text-gray-500">User signups this week</h3>
                         </div>
                         <div class="ml-5 w-0 flex items-center justify-end flex-1 text-red-500 text-base font-bold">
                            -2.7%
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 my-4">
                   <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
                      <div class="flex items-center justify-between mb-4">
                         <h3 class="text-xl font-bold leading-none text-gray-900">Latest Customers</h3>
                         <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">
                         View all
                         </a>
                      </div>
                      <div class="flow-root">
                         <ul role="list" class="divide-y divide-gray-200">
                            <li class="py-3 sm:py-4">
                               <div class="flex items-center space-x-4">
                                  <div class="flex-shrink-0">
                                     <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/neil-sims.png" alt="Neil image">
                                  </div>
                                  <div class="flex-1 min-w-0">
                                     <p class="text-sm font-medium text-gray-900 truncate">
                                        Neil Sims
                                     </p>
                                     <p class="text-sm text-gray-500 truncate">
                                        <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="17727a767e7b57607e7973646372653974787a">[email&#160;protected]</a>
                                     </p>
                                  </div>
                                  <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                     $320
                                  </div>
                               </div>
                            </li>
                            <li class="py-3 sm:py-4">
                               <div class="flex items-center space-x-4">
                                  <div class="flex-shrink-0">
                                     <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/bonnie-green.png" alt="Neil image">
                                  </div>
                                  <div class="flex-1 min-w-0">
                                     <p class="text-sm font-medium text-gray-900 truncate">
                                        Bonnie Green
                                     </p>
                                     <p class="text-sm text-gray-500 truncate">
                                        <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="d4b1b9b5bdb894a3bdbab0a7a0b1a6fab7bbb9">[email&#160;protected]</a>
                                     </p>
                                  </div>
                                  <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                     $3467
                                  </div>
                               </div>
                            </li>
                            <li class="py-3 sm:py-4">
                               <div class="flex items-center space-x-4">
                                  <div class="flex-shrink-0">
                                     <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/michael-gough.png" alt="Neil image">
                                  </div>
                                  <div class="flex-1 min-w-0">
                                     <p class="text-sm font-medium text-gray-900 truncate">
                                        Michael Gough
                                     </p>
                                     <p class="text-sm text-gray-500 truncate">
                                        <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="57323a363e3b17203e3933242332257934383a">[email&#160;protected]</a>
                                     </p>
                                  </div>
                                  <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                     $67
                                  </div>
                               </div>
                            </li>
                            <li class="py-3 sm:py-4">
                               <div class="flex items-center space-x-4">
                                  <div class="flex-shrink-0">
                                     <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/thomas-lean.png" alt="Neil image">
                                  </div>
                                  <div class="flex-1 min-w-0">
                                     <p class="text-sm font-medium text-gray-900 truncate">
                                        Thomes Lean
                                     </p>
                                     <p class="text-sm text-gray-500 truncate">
                                        <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="284d45494144685f41464c5b5c4d5a064b4745">[email&#160;protected]</a>
                                     </p>
                                  </div>
                                  <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                     $2367
                                  </div>
                               </div>
                            </li>
                            <li class="pt-3 sm:pt-4 pb-0">
                               <div class="flex items-center space-x-4">
                                  <div class="flex-shrink-0">
                                     <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/lana-byrd.png" alt="Neil image">
                                  </div>
                                  <div class="flex-1 min-w-0">
                                     <p class="text-sm font-medium text-gray-900 truncate">
                                        Lana Byrd
                                     </p>
                                     <p class="text-sm text-gray-500 truncate">
                                        <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a2c7cfc3cbcee2d5cbccc6d1d6c7d08cc1cdcf">[email&#160;protected]</a>
                                     </p>
                                  </div>
                                  <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                     $367
                                  </div>
                               </div>
                            </li>
                         </ul>
                      </div>
                   </div>
                   <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                      <h3 class="text-xl leading-none font-bold text-gray-900 mb-10">Acquisition Overview</h3>
                      <div class="block w-full overflow-x-auto">
                         <table class="items-center w-full bg-transparent border-collapse">
                            <thead>
                               <tr>
                                  <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Top Channels</th>
                                  <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Users</th>
                                  <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap min-w-140-px"></th>
                               </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                               <tr class="text-gray-500">
                                  <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Organic Search</th>
                                  <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">5,649</td>
                                  <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                     <div class="flex items-center">
                                        <span class="mr-2 text-xs font-medium">30%</span>
                                        <div class="relative w-full">
                                           <div class="w-full bg-gray-200 rounded-sm h-2">
                                              <div class="bg-cyan-600 h-2 rounded-sm" style="width: 30%"></div>
                                           </div>
                                        </div>
                                     </div>
                                  </td>
                               </tr>
                               <tr class="text-gray-500">
                                  <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Referral</th>
                                  <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">4,025</td>
                                  <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                     <div class="flex items-center">
                                        <span class="mr-2 text-xs font-medium">24%</span>
                                        <div class="relative w-full">
                                           <div class="w-full bg-gray-200 rounded-sm h-2">
                                              <div class="bg-orange-300 h-2 rounded-sm" style="width: 24%"></div>
                                           </div>
                                        </div>
                                     </div>
                                  </td>
                               </tr>
                               <tr class="text-gray-500">
                                  <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Direct</th>
                                  <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">3,105</td>
                                  <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                     <div class="flex items-center">
                                        <span class="mr-2 text-xs font-medium">18%</span>
                                        <div class="relative w-full">
                                           <div class="w-full bg-gray-200 rounded-sm h-2">
                                              <div class="bg-teal-400 h-2 rounded-sm" style="width: 18%"></div>
                                           </div>
                                        </div>
                                     </div>
                                  </td>
                               </tr>
                               <tr class="text-gray-500">
                                  <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Social</th>
                                  <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">1251</td>
                                  <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                     <div class="flex items-center">
                                        <span class="mr-2 text-xs font-medium">12%</span>
                                        <div class="relative w-full">
                                           <div class="w-full bg-gray-200 rounded-sm h-2">
                                              <div class="bg-pink-600 h-2 rounded-sm" style="width: 12%"></div>
                                           </div>
                                        </div>
                                     </div>
                                  </td>
                               </tr>
                               <tr class="text-gray-500">
                                  <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Other</th>
                                  <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">734</td>
                                  <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                     <div class="flex items-center">
                                        <span class="mr-2 text-xs font-medium">9%</span>
                                        <div class="relative w-full">
                                           <div class="w-full bg-gray-200 rounded-sm h-2">
                                              <div class="bg-indigo-600 h-2 rounded-sm" style="width: 9%"></div>
                                           </div>
                                        </div>
                                     </div>
                                  </td>
                               </tr>
                               <tr class="text-gray-500">
                                  <th class="border-t-0 align-middle text-sm font-normal whitespace-nowrap p-4 pb-0 text-left">Email</th>
                                  <td class="border-t-0 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4 pb-0">456</td>
                                  <td class="border-t-0 align-middle text-xs whitespace-nowrap p-4 pb-0">
                                     <div class="flex items-center">
                                        <span class="mr-2 text-xs font-medium">7%</span>
                                        <div class="relative w-full">
                                           <div class="w-full bg-gray-200 rounded-sm h-2">
                                              <div class="bg-purple-500 h-2 rounded-sm" style="width: 7%"></div>
                                           </div>
                                        </div>
                                     </div>
                                  </td>
                               </tr>
                            </tbody>
                         </table>
                      </div>
                   </div>
                </div> --}}
             {{-- </div> --}}

             @yield('content')
             <!-- Example Table Format -->
             {{-- <div class="p-6 px-4">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="overflow-x-auto">
                        <table class="table">
                          <thead>
                            <tr>
                              <th></th>
                              <th>Name</th>
                              <th>Job</th>
                              <th>company</th>
                              <th>location</th>
                              <th>Last Login</th>
                              <th>Favorite Color</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th>1</th>
                              <td>Cy Ganderton</td>
                              <td>Quality Control Specialist</td>
                              <td>Littel, Schaden and Vandervort</td>
                              <td>Canada</td>
                              <td>12/16/2020</td>
                              <td>Blue</td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th></th>
                              <th>Name</th>
                              <th>Job</th>
                              <th>company</th>
                              <th>location</th>
                              <th>Last Login</th>
                              <th>Favorite Color</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                </div>
             </div> --}}

             <!-- Example Form Format -->
             {{-- <div class="p-6 px-4">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Form Design</h2>
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                          <div class="sm:col-span-3">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                            <div class="mt-2">
                              <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                          </div>

                          <div class="sm:col-span-3">
                            <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                            <div class="mt-2">
                              <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                          </div>

                          <div class="sm:col-span-4">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                            <div class="mt-2">
                              <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                          </div>

                          <div class="sm:col-span-3">
                            <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Country</label>
                            <div class="mt-2">
                              <select id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Mexico</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-span-full">
                            <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Street address</label>
                            <div class="mt-2">
                              <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                          </div>

                          <div class="sm:col-span-2 sm:col-start-1">
                            <label for="city" class="block text-sm font-medium leading-6 text-gray-900">City</label>
                            <div class="mt-2">
                              <input type="text" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                          </div>

                          <div class="sm:col-span-2">
                            <label for="region" class="block text-sm font-medium leading-6 text-gray-900">State / Province</label>
                            <div class="mt-2">
                              <input type="text" name="region" id="region" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                          </div>

                        <div class="sm:col-span-2">
                            <label for="postal-code" class="block text-sm font-medium leading-6 text-gray-900">ZIP / Postal code</label>
                            <div class="mt-2">
                              <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div> --}}

             <!-- Example Form Format with tailwind and daisy ui -->
             {{-- <div class="p-6 px-4">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
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
                </div>
             </div> --}}
          </main>

          {{-- @include('admin.layouts.footer') --}}
          {{-- <p class="text-center text-sm text-gray-500 my-10">
             &copy; 2024 <a href="https://github.com/Pyaephyo33/" class="hover:underline" target="_blank">Developed By Raven</a>
          </p> --}}
       </div>
    </div>

    <script>
      // for delete modal function 

      function submitDeleteForm(id) {
         // Trigger form submission
         document.getElementById('deleteForm' + id).submit();
         // Close the modal
         document.getElementById('deleteModal' + id).close();
      }
      function changeStatus(id)
      {
         // Trigger form submission
         document.getElementById('statusForm' + id).submit();
         // Close the modal
         document.getElementById('statusModal' + id).close();
      }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://demo.themesberg.com/windster/app.bundle.js"></script>
 </div>

</body>
</html>
