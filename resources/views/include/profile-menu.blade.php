<div
             class="relative ml-3"
             x-data="{ open: false }">
             <div>
               <button
                 @click="open = !open"
                 type="button"
                 class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                 id="user-menu-button"
                 aria-expanded="false"
                 aria-haspopup="true">
                 <span class="sr-only">Open user menu</span>
                 <img
                   class="h-8 w-8 rounded-full"
                   src="https://avatars.githubusercontent.com/u/831997"
                   alt="Ahmed Shamim Hasan Shaon" />
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
             href="/profile"
             class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
             role="menuitem"
             tabindex="-1"
             id="user-menu-item-0"
             >Your Profile</a
           >
           <a
             href="/edit-profile"
             class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
             role="menuitem"
             tabindex="-1"
             id="user-menu-item-1"
             >Edit Profile</a
           >
           <a
             href="/logout"
             class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
             role="menuitem"
             tabindex="-1"
             id="user-menu-item-2"
             >Sign out</a
           >
         </div>
         
           
           </div>
         </div>