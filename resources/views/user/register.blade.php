@extends('layout.admin')
@push('title')
  Registration || Barta-App
@endpush
@section('maincontent')
  <body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <a
          href="/"
          class="text-center text-6xl font-bold text-gray-900"
          ><h1>Barta</h1></a>
          
 
        @if ( isset($message) )
        <div class="bg-red-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
          <strong class="font-bold">Sorry!</strong>
          <span class="block sm:inline">{{ $message }}</span>
          <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
              <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <title>Close</title>
                  <path d="M6.293 6.293a1 1 0 011.414 0L10 10.586l2.293-2.293a1 1 0 111.414 1.414L11.414 12l2.293 2.293a1 1 0 01-1.414 1.414L10 13.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 12 6.293 9.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
              </svg>
          </span>
      </div>
      @endif
  
     
        <h1
          class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
          Create a new account
        </h1>

          @if ($errors->any())
              @foreach ($errors->all() as $error )
                <li class="text-red-500">{{ $error }}</li>
              @endforeach
          @endif
      </div>

      

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="/register" method="POST">
          <!-- Name -->
          <div>
            <label
              for="name"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Full Name</label
            >
            <div class="mt-2">
              @csrf
              <input
                id="name"
                name="name"
                type="text"
                autocomplete="name"
                placeholder="Alp Arslan"
                
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
            </div>
          </div>

          <!-- Username -->
          <div>
            <label
              for="username"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Username</label
            >
            <div class="mt-2">
              <input
                id="username"
                name="username"
                type="text"
                autocomplete="username"
                placeholder="alparslan1029"
                
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
            </div>
          </div>

          <!-- Email -->
          <div>
            <label
              for="email"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Email address</label
            >
            <div class="mt-2">
              <input
                id="email"
                name="email"
                type="email"
                autocomplete="email"
                placeholder="alp.arslan@mail.com"
                
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
            </div>
          </div>

          <!-- Password -->
          <div>
            <label
              for="password"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Password</label
            >
            <div class="mt-2">
              <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                placeholder="••••••••"
                
                class="block w-full rounded-md border-0 p-2 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
            </div>
          </div>

          <div>
            <button
              type="submit"
              class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
              Register
            </button>
          </div>
        </form>

        <p class="mt-10 text-center text-sm text-gray-500">
          Already a member?
          <a
            href="/login"
            class="font-semibold leading-6 text-black hover:text-black"
            >Sign In</a
          >
        </p>
      </div>
    </div>
  </body>
@endsection