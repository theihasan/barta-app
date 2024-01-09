@extends('layout.app')
@push('title')
    Edit-Post || Barta-App
@endpush

@section('main-section')
<main
      class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
     
      @if ($errors->has('post_content'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
          <strong class="font-bold">Error!</strong>
          <span class="block sm:inline">{{ $errors->first('post_content') }}</span>
      </div>          
      @endif
      @if (session('post-updated'))
            <div class="bg-green-100 border border-green-400 text-black-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Yeah</strong>
                <span class="block sm:inline">{{ session('post-updated') }}</span>
            </div> 
        @endif
      <!-- Barta Create Post Card -->
      
      <form
        action="{{route('post.update', ['postuuid' => $post->uuid])}}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3">
       @method('PUT')
        <!-- Create Post Card Top -->
        <div>
          <div class="flex items-start /space-x-3/">
            

            <!-- Content -->
            <div class="text-gray-700 font-normal w-full">
                @csrf
              <textarea
                class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
                name="post_content"
                id="postcontent"
                rows="2"
                placeholder="What's going on, @if (Auth::check()) {{ Auth::user()->name }} @endif">{{$post->post_content}}</textarea>

                <div>
                  <input
                    type="file"
                    name="picture"
                    id="picture"
                    class="hidden" />
  
                  <label
                    for="picture"
                    class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800 cursor-pointer">
                    <span class="sr-only">Picture</span>
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-6 h-6">
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                  </label>
                </div>
              
            
              </div>
          </div>
        </div>

        <!-- Create Post Card Bottom -->
        <div>
          <!-- Card Bottom Action Buttons -->
          <div class="flex items-center justify-end">
         

            <div>
              <!-- Post Button -->
              <button
                type="submit"
                class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                Post
              </button>
              <!-- /Post Button -->
            </div>
          </div>
          <!-- /Card Bottom Action Buttons -->
        </div>
        <!-- /Create Post Card Bottom -->
      </form>
  
      <img src="{{$image}}" alt="{{$image}}" id="preview">
      <!-- /Barta Create Post Card -->

      <!-- Newsfeed -->

        <!-- /Barta Card With Image -->
      </section>

      
   
      <!-- /Newsfeed -->
    </main>
@endsection

    

    