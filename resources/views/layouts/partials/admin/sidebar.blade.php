  
<button data-drawer-target="sidebar" data-drawer-toggle="sidebar" aria-controls="sidebar" type="button"
   class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
       <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
</button>
 
{{-- TODO: make sidbar retractible --}}
 <aside id="sidebar"
   class="sidebar bg-gray-50 fixed top-0 left-0 z-40 w-60 h-screen transition-transform -translate-x-full sm:translate-x-0"
      aria-label="sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto dark:bg-gray-800">
       <ul class="space-y-2 font-medium">
         <li class="mb-6 ml-6">
            {{-- LOGO --}}
            <i class="fa-solid fa-gopuram fa-2xl" style="color: #808080;"></i>
         </li>
         {{-- TODO: los botones deberían ser Lessons, Topics, Topic slides, Mixed Ex y WoD --}}
         @if (auth()->user()->role_as === 2)
            <li {{ Request::is('admin/dashboard') ? 'active':'' }}>
               <a href="{{ url('admin/dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <i class="fa-solid fa-chart-line" style="color: #808080;"></i>
                  <span class="ml-3">Dashboard</span>
               </a>
            </li>
         @elseif (auth()->user()->role_as === 1)
            <li {{ Request::is('not-user/dashboard') ? 'active':'' }}>
               <a href="{{ url('not-user/dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <i class="fa-solid fa-chart-line" style="color: #808080;"></i>
                  <span class="ml-3">Dashboard</span>
               </a>
            </li>
            {{-- TODO: uncomment user dashboard --}}
         {{-- @elseif (auth()->user()->role_as === 0)
            <li {{ Request::is('user/dashboard') ? 'active':'' }}>
               <a href="{{ url('user/dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <i class="fa-solid fa-chart-line" style="color: #808080;"></i>
                  <span class="ml-3">Dashboard</span>
               </a>
            </li> --}}
         @endif 
         
          {{-- <li>
             <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path><path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Inbox</span>
                <span class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
             </a>
          </li> --}}
          {{-- <li>
             <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Users</span>
             </a>
          </li> --}}
          {{-- TODO: for lessons add the levels to a sublist of options inaide of lessons instead of its own page --}}
          <li>
            <a href="{{ url('not-user/levels') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <i class="fa-solid fa-list-ol" style="color: #808080;"></i>
               <span class="flex-1 ml-3 whitespace-nowrap">Levels</span>
            </a>
         </li>
          <li>
             <a href="{{ url('not-user/lessons') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <i class="fa-solid fa-person-chalkboard" style="color: #808080;"></i>
                <span class="flex-1 ml-3 whitespace-nowrap">Lessons</span>
             </a>
          </li>
          <li>
            <a href="{{ url('not-user/topics') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <i class="fa-solid fa-person-chalkboard" style="color: #808080;"></i>
               <span class="flex-1 ml-3 whitespace-nowrap">Topics</span>
            </a>
          </li>
          <li>
            <a href="{{ url('not-user/topic-slides') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <i class="fa-solid fa-person-chalkboard" style="color: #808080;"></i>
               <span class="flex-1 ml-3 whitespace-nowrap">Topic Slides</span>
            </a>
          </li>
          <li>
            <a href="{{ url('not-user/mixed-exercises') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <i class="fa-solid fa-dumbbell" style="color: #808080;"></i>
               <span class="flex-1 ml-3 whitespace-nowrap">Mixed Exercises</span>
            </a>
          </li>
          
          {{-- <li>
            <a href="{{ url('not-user/exercises') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path></svg>
               <span class="flex-1 ml-3 whitespace-nowrap">Exercises</span>
            </a>
          </li>
          <li>
            <a href="{{ url('not-user/sliders') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path></svg>
               <span class="flex-1 ml-3 whitespace-nowrap">Sliders</span>
            </a>
          </li> --}}
          <li>
            <a href="{{ url('not-user/word-of-day') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <i class="fa-solid fa-comment-dots" style="color: #808080;"></i>           
               <span class="flex-1 ml-3 whitespace-nowrap">Words of the Day</span>
            </a>
          </li>

       </ul>
    </div>
 </aside>