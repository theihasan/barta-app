@extends('layout.app')
@push('title')
    Homepage || Barta-App
@endpush



@section('main-section')
<main
      class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
      <!-- Barta Create Post Card -->
        @if ($errors->has('postcontent'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $errors->first('postcontent') }}</span>
            </div>          
        @endif
        
        @if (session('post-success'))
            <div class="bg-green-100 border border-green-400 text-black-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Yeah</strong>
                <span class="block sm:inline">{{ session('post-success') }}</span>
            </div> 
        @endif

        @if (session('delete-success'))
        <div class="bg-green-100 border border-green-400 text-black-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Yeah</strong>
            <span class="block sm:inline">{{ session('delete-success') }}</span>
        </div> 
        @endif

      <!-- /Barta Create Post Card -->

      <!-- Newsfeed -->
      <section
        id="newsfeed"
        class="space-y-6">
        <!-- Barta Card -->

  
          @foreach ( $posts as $post )
                <article
                class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
                <!-- Barta Card Top -->
                <header>
                  <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                    
                      <!-- User Info -->
                      <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                        <img class="h-8 w-8 rounded-full" 
                        src=
                        "
                        @if ($post->user->getFirstMediaUrl('profile_picture') )
                        {{ $post->user->getFirstMediaUrl('profile_picture') }}
                        
                        @else 
                        https://avatars.githubusercontent.com/u/831997
                        
                        @endif
                        " 
                        alt="{{ $post->user->name }}" />
                        <a
                          href="/profile/{{$post->user->username}}"
                          class="hover:underline font-semibold line-clamp-1">
                          {{ $post->user->name }}
                        </a>
      
                        <a
                          href="/profile/{{$post->username}}"
                          class="hover:underline text-sm text-gray-500 line-clamp-1">
                          {{$post->user->username}}
                        </a>
                      </div>
                      <!-- /User Info -->
                    </div>
      
                    <!-- Card Action Dropdown -->
                  @if ($post->user_id == Auth::user()->id)
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
                              href="/edit/{{$post->uuid}}"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                              role="menuitem"
                              tabindex="-1"
                              id="user-menu-item-0"
                          >Edit</a>
                          <a
                              href="/delete/{{$post->uuid}}"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                              role="menuitem"
                              tabindex="-1"
                              id="user-menu-item-1"
                              onclick="alert('Are You sure to delete this item? It cannot recover in future')"
                          >Delete</a>
                        </div>
                      </div>
                    </div>
                  @endif
                    <!-- /Card Action Dropdown -->
                  </div>
                </header>
  
                <!-- Content -->
                <a href="{{route('post.single',['postuuid' => $post->uuid])}}">
                  <div class="py-4 text-gray-700 font-normal">
                      {{ $post->post_content }}
                      @foreach ($post->media as $image)
                      <img class="object-fill h-48 w-96" src="{{ $image->getUrl() }}" alt="Post Image">
                  @endforeach
                  </div>
              </a>
              

                <!-- Date Created & View Stat -->
                <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
                  <span class=""> 
                    @if ($post->formatted_updated_at)
                      {{$post->formatted_updated_at}}
                    @else
                      {{$post->formatted_created_at}}
                    @endif
                  </span>
                  <span class="">•</span>
                  <span>{{$post->views}}</span>
                </div>
      
              
                <!-- /Barta Card Bottom -->
              </article>
          @endforeach
        <!-- /Barta Card With Image -->
      </section>
      <!-- /Newsfeed -->
    </main>
@endsection

    

    


