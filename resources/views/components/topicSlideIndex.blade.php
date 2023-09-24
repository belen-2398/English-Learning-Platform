{{-- TODO: edit table on click --}}
@if ($topicSlides->count() > 0)
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        @if (!isset($varValue))
                            <th scope="col" class="px-6 py-3">
                                <a href="{{ route($actionUrl,
                                    ['sort' => request('sort') == 'asc' ? 'desc' : 'asc', 'sort_by' => 'topic',
                                    'query_parameter' => request('query_parameter'),
                                    'query' => request('query'),
                                    'status_parameter' => request('status_parameter')]) }}">
                                    <div class="flex justify-between">
                                        <span>Topic</span>
                                        <x-tableOrderBy sortBy="topic" />
                                    </div> 
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <a href="{{ route($actionUrl,
                                    ['sort' => request('sort') == 'asc' ? 'desc' : 'asc', 'sort_by' => 'name',
                                    'query_parameter' => request('query_parameter'),
                                    'query' => request('query'),
                                    'status_parameter' => request('status_parameter')]) }}">
                                    <div class="flex justify-between">
                                        <span>Name</span>
                                        <x-tableOrderBy sortBy="name" />
                                    </div> 
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <a href="{{ route($actionUrl,
                                    ['sort' => request('sort') == 'asc' ? 'desc' : 'asc', 'sort_by' => 'order',
                                    'query_parameter' => request('query_parameter'),
                                    'query' => request('query'),
                                    'status_parameter' => request('status_parameter')]) }}">
                                    <div class="flex justify-between">
                                        <span>Order</span>
                                        <x-tableOrderBy sortBy="order" />
                                    </div> 
                                </a>
                            </th>
                        @else
                            <th scope="col" class="px-6 py-3">
                                <a href="{{ route($actionUrl,
                                    ['sort' => request('sort') == 'asc' ? 'desc' : 'asc', 'sort_by' => 'name',
                                        'query_parameter' => request('query_parameter'),
                                        'query' => request('query'),
                                        'status_parameter' => request('status_parameter'),
                                        $varName  => $varValue]) }}">
                                    <div class="flex justify-between">
                                        <span>Name</span>
                                        <x-tableOrderBy sortBy="name" />
                                    </div> 
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <a href="{{ route($actionUrl,
                                ['sort' => request('sort') == 'asc' ? 'desc' : 'asc', 'sort_by' => 'order',
                                    'query_parameter' => request('query_parameter'),
                                    'query' => request('query'),
                                    'status_parameter' => request('status_parameter'),
                                    $varName  => $varValue]) }}">
                                    <div class="flex justify-between">
                                        <span>Order</span>
                                        <x-tableOrderBy sortBy="order" />
                                    </div> 
                                </a>
                            </th>
                        @endif
                        <th scope="col" class="px-6 py-3">
                            Prompt
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Explanation/Exercise
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topicSlides as $topicSlide)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">                   
                            @if (!isset($varValue))
                                <th class="px-6 py-4">
                                    <a class="hover:underline" href="{{ route('topic-slides.topic.index', ['topicId' => $topicSlide->topic->id]) }}">
                                        {{ $topicSlide->topic->name ?? 'N/A' }}
                                    </a>
                                </th>
                            @endif
                            <td class="px-6 py-4">
                                {{ $topicSlide->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $topicSlide->order }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $topicSlide->prompt ?? 'No prompt' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $topicSlide->status == 0 ? '' : 'V' }}
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    @if ($topicSlide->exercise)
                                        <a href="{{ route('exercises.show', $topicSlide->exercise->id) }}"
                                            class="font-medium text-blue-600 dark:text-gray-500 hover:underline">
                                            Show exercise
                                        </a>
                                        <br>
                                        <a href="{{ route('exercises.edit', $topicSlide->exercise->id) }}"
                                            class="font-medium text-gray-600 dark:text-gray-500 hover:underline">
                                            Edit exercise
                                        </a>
                                    @elseif ($topicSlide->explanation)
                                        <a href="{{ route('explanations.show', $topicSlide->explanation->id) }}"
                                            class="font-medium text-blue-600 dark:text-gray-500 hover:underline">
                                            Show explanation
                                        </a>
                                        <br>
                                        <a href="{{ route('explanations.edit', $topicSlide->explanation->id) }}"
                                            class="font-medium text-gray-600 dark:text-gray-500 hover:underline">
                                            Edit explanation
                                        </a>
                                    @else
                                        <p>No exercise or explanation. Delete the slide and create it again.</p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="">
                                    <a href="{{ route('topic-slides.edit', $topicSlide->id) }}"
                                        class="font-medium text-gray-600 dark:text-gray-500 hover:underline">
                                        Edit data
                                    </a>
                                    <form action="{{ route('topic-slides.destroy', $topicSlide->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type='submit' class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                        onclick="return confirm('Are you sure you want to delete this slide?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
    @else
        <p>No slides yet.</p>
    @endif
    <div class="m-6">
        {{ $topicSlides->links() }}
    </div>