@extends('layout.app')
@push('title')
  Edit Profile || Barta-App
@endpush
@section('main-section')
<main
class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
<!-- Profile Edit Form -->

<form action="/profile-update" method="POST">
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
      <h2 class="text-xl font-semibold leading-7 text-gray-900">
        Edit Profile
      </h2>
      <p class="mt-1 text-sm leading-6 text-gray-600">
        This information will be displayed publicly so be careful what you
        share.
      </p>


      @if (session('profileupdate'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                  <strong class="font-bold">Yahoo!</strong>
                  <span class="block sm:inline">{{ session('profileupdate') }}</span>
                  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                      <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                          <title>Close</title>
                          <path d="M6.293 6.293a1 1 0 011.414 0L10 10.586l2.293-2.293a1 1 0 111.414 1.414L11.414 12l2.293 2.293a1 1 0 01-1.414 1.414L10 13.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 12 6.293 9.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                      </svg>
                  </span>
          </div>
      @endif
      @if ($errors->any())
        @foreach ($errors->all() as $error)
          <li class="text-red-500">{{ $error }}</li>
        @endforeach
      @endif

      <div class="mt-10 border-b border-gray-900/10 pb-12">

        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-full">
            <label
              for="first-name"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Name</label
            >
            <div class="mt-2">
              @csrf
              <input
                type="text"
                name="name"
                id="name"
                autocomplete="given-name"
                value="{{$user->name}}"
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
            </div>
          </div>


          <div class="col-span-full">
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
                value="{{$user->email}}"
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
            </div>
          </div>

          <div class="col-span-full">
            <label
              for="password"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Password</label
            >
            <div class="mt-2">
              <input
                type="password"
                name="password"
                id="password"
                autocomplete="password"
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
            </div>
          </div>
        </div>
      </div>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="col-span-full">
          <label
            for="bio"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Bio</label
          >
          <div class="mt-2">
            <textarea
              id="bio"
              name="bio"
              rows="3"
              class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 
              ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset 
              focus:ring-gray-600
               sm:text-sm sm:leading-6">{{$user->bio}}</textarea
            >
          </div>
          <p class="mt-3 text-sm leading-6 text-gray-600">
            Write a few sentences about yourself.
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">
    <button
      type="button"
      class="text-sm font-semibold leading-6 text-gray-900">
      Cancel
    </button>
    <button
      type="submit"
      class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
      Save
    </button>
  </div>
</form>
<!-- /Profile Edit Form -->
</main>
@endsection