<form method="GET" action="{{ route($actionUrl,
    [
        $varName  => $varValue
    ]) }}">
    <button id="statusDropdownBtn" data-dropdown-toggle="statusDropdown" type="button"
        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
        {{ request('status_parameter') === 'visible' ? 'Visible' : (request('status_parameter') === 'not-visible' ? 'Not visible' : 'Status') }} 
        <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
        </path></svg>
    </button>
    <!-- Dropdown menu -->
    <div id="statusDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="statusDropdownBtn">
            @if (request('status_parameter'))
                <li>
                    <a href="{{ route($actionUrl,
                    [
                        $varName  => $varValue
                    ]) }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        All
                    </a>
                </li>
            @endif
            @if (request('status_parameter') !== 'visible' || !request('status_parameter'))
                <li>
                    <a href="{{ route($actionUrl,
                    ['status_parameter' => 'visible',
                    $varName  => $varValue]) }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Visible
                    </a>
                </li>
            @endif
            @if (request('status_parameter') !== 'not-visible' || !request('status_parameter'))
                <li>
                    <a href="{{ route($actionUrl, 
                    ['status_parameter' => 'not-visible',
                    $varName  => $varValue]) }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Not visible
                    </a>
                </li>
            @endif
        </ul>
    </div>
</form>