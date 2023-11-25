
  
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0" />
      <title>@stack('title','Barta-App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>@stack('title','Barta-App')</title>
    <!-- AlpineJS CDN -->
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link
      rel="preconnect"
      href="https://fonts.googleapis.com" />
    <link
      rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet" />

    <style>
      * {
        font-family: 'Inter', sans-serif;
      }
    </style>
  </head>

  <body class="bg-gray-100">
    <header>
      <!-- Navigation -->
   
     <nav
     x-data="{ mobileMenuOpen: false, userMenuOpen: false }"
     class="bg-white shadow">
     <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
       <div class="flex h-16 justify-between">
         <div class="flex">
           <div class="flex flex-shrink-0 items-center">
             <a href="/home">
               <h2 class="font-bold text-2xl">Barta</h2>
             </a>
           </div>

         </div>
         <div class="hidden sm:ml-6 sm:flex gap-2 sm:items-center">
         

           <!-- Profile dropdown -->
           @if(Auth::check())
           @include('include.profile-menu')
           @endif
           
           
           
         <div class="-mr-2 flex items-center sm:hidden">
           <!-- Mobile menu button -->
           <button
             @click="mobileMenuOpen = !mobileMenuOpen"
             type="button"
             class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500"
             aria-controls="mobile-menu"
             aria-expanded="false">
             <span class="sr-only">Open main menu</span>
             <!-- Icon when menu is closed -->
             <svg
               x-show="!mobileMenuOpen"
               class="block h-6 w-6"
               xmlns="http://www.w3.org/2000/svg"
               fill="none"
               viewBox="0 0 24 24"
               stroke-width="1.5"
               stroke="currentColor"
               aria-hidden="true">
               <path
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
             </svg>

             <!-- Icon when menu is open -->
             <svg
               x-show="mobileMenuOpen"
               xmlns="http://www.w3.org/2000/svg"
               fill="none"
               viewBox="0 0 24 24"
               stroke-width="1.5"
               stroke="currentColor"
               class="w-6 h-6">
               <path
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 d="M6 18L18 6M6 6l12 12" />
             </svg>
           </button>
         </div>
       </div>
     </div>

    
   </nav>
    
    </header>
