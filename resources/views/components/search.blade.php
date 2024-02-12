<form method="GET" action="{{ $actionUrl }}">
    <div class="flex m-4 items-center">
        <div>
            <select name="query_parameter" id="query_parameter"
                class="bg-gray-200 rounded p-2.5 text-sm text-gray-700 focus:bg-white">
                <option value="">
                    Select Parameter
                </option>    
                {{ $slot }}
            </select>  
        </div>
        <div class="relative w-full">
            <input type="search" name="query" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-r-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500" placeholder="Search..." aria-label="Your search input" required>
            <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-gray-700 rounded-r-lg border border-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</form>
