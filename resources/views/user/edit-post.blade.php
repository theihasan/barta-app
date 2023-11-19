@extends('layout.app')
@push('title')
    Edit-Post || Barta-App
@endpush
@section('main-section')
<main
      class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
     
      @if ($errors->has('postcontent'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
          <strong class="font-bold">Error!</strong>
          <span class="block sm:inline">{{ $errors->first('postcontent') }}</span>
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
        action="/edit/{{$post->uuid}}"
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
                name="postcontent"
                rows="2"
                placeholder="What's going on, @if (Auth::check()) {{ Auth::user()->name }} @endif">{{$post->post_content}}</textarea>
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
      <!-- /Barta Create Post Card -->

      <!-- Newsfeed -->
    
     
                  
            
    
  
      
      
        <!-- /Barta Card With Image -->
      </section>
      <!-- /Newsfeed -->
    </main>
@endsection

    

    