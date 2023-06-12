@if (request('sort') == 'asc' && request('sort_by') == $sortBy)
    <svg class="w-4 h-4 inline-block ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M4.243 11.757a1 1 0 011.32-.083l.094.083L10 16.586l4.343-4.343a1 1 0 111.32 1.497l-.094.083-5 5a1 1 0 01-1.32 0l-5-5a1 1 0 01-.083-1.32l.083-.094z" clip-rule="evenodd" transform="rotate(180 10 10)"></path>
    </svg>
@elseif (request('sort') == 'desc' && request('sort_by') == $sortBy)
    <svg class="w-4 h-4 inline-block ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M4.243 11.757a1 1 0 011.32-.083l.094.083L10 16.586l4.343-4.343a1 1 0 111.32 1.497l-.094.083-5 5a1 1 0 01-1.32 0l-5-5a1 1 0 01-.083-1.32l.083-.094z" clip-rule="evenodd"></path>
    </svg>
@else
    <span class="inline-block">
        <svg class="w-3 inline-block ml-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.243 11.757a1 1 0 011.32-.083l.094.083L10 16.586l4.343-4.343a1 1 0 111.32 1.497l-.094.083-5 5a1 1 0 01-1.32 0l-5-5a1 1 0 01-.083-1.32l.083-.094z" clip-rule="evenodd" transform="rotate(180 10 10)"></path>
            <path fill-rule="evenodd" d="M4.243 11.757a1 1 0 011.32-.083l.094.083L10 16.586l4.343-4.343a1 1 0 111.32 1.497l-.094.083-5 5a1 1 0 01-1.32 0l-5-5a1 1 0 01-.083-1.32l.083-.094z" clip-rule="evenodd"></path>
        </svg>
    </span>
@endif