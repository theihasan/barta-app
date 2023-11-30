@extends('layout.app')
@push('title')
  Profile || Barta-App
@endpush
@section('main-section')


<main class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 min-h-screen">
  <!-- Cover Container -->
  <section
    class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[400px] space-y-8 flex items-center flex-col justify-center">
    <!-- Profile Info -->
    <div
      class="flex gap-4 justify-center flex-col text-center items-center">
      
      @if(isset($profilePicture))
          <img
          class="h-32 w-32 rounded-full"
          src="{{$profilePicture}}"
          alt="Ahmed Shamim Hasan Shaon" />
      @endif
      <div>
          @if (Auth::user()->id)
            <h1 class="font-bold md:text-2xl"> {{Auth::user()->name}} </h1>
            <p class="text-gray-700">{{Auth::user()->bio}}</p>
          @endif
      </div>
    </div>
    <a
      href="/edit-profile"
      type="button"
      class="-m-2 flex gap-2 items-center rounded-full px-4 py-2 font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-5 h-5">
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
      </svg>
      Edit Profile
    </a>
  </section>
  <section
  id="newsfeed"
  class="space-y-6">
  <!-- Barta Card -->

      @if (session('delete-success'))
          <div class="bg-green-100 border border-green-400 text-black-700 px-4 py-3 rounded relative" role="alert">
              <strong class="font-bold">Yeah</strong>
              <span class="block sm:inline">{{ session('delete-success') }}</span>
          </div> 
    @endif
  
@foreach ($userInfos as $userInfo)
  

          <article
          class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
          <!-- Barta Card Top -->
          <header>
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-3">
              
                <!-- User Info -->
             
                <!-- /User Info -->
              </div>

              <!-- Card Action Dropdown -->
            @if ($userInfo->user_id == Auth::user()->id)
              <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                <div class="relative inline-block text-left">
                  <div>
                    <button
                      @click="open = !open"
                      type="button"
                      class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                      id="menu-0-button">
                      <span class="sr-only">Open options</span>
                      <svg
                        class="h-5 w-5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true">
                        <path
                          d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"></path>
                      </svg>
                    </button>
                  </div>
                  <!-- Dropdown menu -->
                
                      <div
                      x-show="open"
                      @click.away="open = false"
                      class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                      role="menu"
                      aria-orientation="vertical"
                      aria-labelledby="user-menu-button"
                      tabindex="-1">
                    <a
                        href="{{route('post.edit',['postuuid' => $userInfo->uuid])}}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        role="menuitem"
                        tabindex="-1"
                        id="user-menu-item-0"
                    >Edit</a>
                    <a
                        href="{{route('post.delete',['postuuid' => $userInfo->uuid])}}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        role="menuitem"
                        tabindex="-1"
                        id="user-menu-item-1"
                        onclick="confirm('Are You sure to delete this item? It cannot recover in future')"
                    >Delete</a>
                  </div>
                </div>
              </div>
            @endif
              <!-- /Card Action Dropdown -->
            </div>
          </header>

          <!-- Content -->
          <a href="{{route('post.single', ['postuuid' => $userInfo->uuid])}}">
            <div class="py-4 text-gray-700 font-normal text-justify">
              {{$userInfo->post_content}}
             
            
              @foreach ($userInfo->media as $image)
               
                  <img class="object-contain h-48 w-96 my-10" 
                  src="{{$image->getUrl()}}" 
                  alt="{{$userInfo->name}}">
              @endforeach

            </div>
        </a>
        

          <!-- Date Created & View Stat -->
          <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
            <span class="">{{$userInfo->created_at->diffForHumans(parts:2)}}</span>
            <span class="">•</span>
            <span class="">{{$userInfo->comments->count()}} comments</span>
            <span class="">•</span>
            <span>{{$userInfo->views}} views</span>
          </div>

        
          <!-- /Barta Card Bottom -->
        </article>
    
  @endforeach



      




  <!-- /Barta Card With Image -->
</section>

</main>




@endsection