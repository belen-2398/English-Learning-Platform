{{-- TODO: edit table on click --}}

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                @if (!isset($varValue))
                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route($actionUrl,
                            ['sort' => request('sort') == 'asc' ? 'desc' : 'asc', 'sort_by' => 'lesson',
                            'query_parameter' => request('query_parameter'),
                            'query' => request('query'),
                            'status_parameter' => request('status_parameter')]) }}">
                            <div class="flex justify-between">
                                <span>Lesson</span>
                                <x-tableOrderBy sortBy="lesson" />
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
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Slides
                </th>
                <th scope="col" class="px-6 py-3">
                    Points
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topics as $topic)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">                   
                    @if (!isset($varValue))
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="hover:underline" href="{{ route('topics.lesson.index', ['lessonId' => $topic->lesson->id]) }}">
                                {{ $topic->lesson->name ?? 'N/A' }}
                            </a>
                        </th> 
                    @endif
                    <td class="px-6 py-4">
                        {{ $topic->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $topic->order }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $topic->category }}
                    </td>
                    <td class="px-6 py-4">
                        @if ($topic->topicSlides->count() > 0)
                            <a href="{{ route('topic-slides.topic.index', ['topicId' => $topic->id]) }}"
                                class="font-medium text-gray-600 dark:text-gray-500 hover:underline">
                                Show Slides
                            </a>
                        @else
                            <p>No slides yet</p>
                            <a href="{{ route('topic-slides.create', ['topicId' => $topic->id]) }}" class="hover:underline">Add one.</a>
                        @endif
                        
                    </td>
                    <td class="px-6 py-4">
                        {{ $topic->points }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $topic->status == 0 ? '' : 'V' }}
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            <a href="{{ route('topics.edit', $topic->id) }}"
                                class="font-medium text-gray-600 dark:text-gray-500 hover:underline">
                                Edit
                            </a>
                            <form action="{{ route('topics.destroy', $topic->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type='submit' class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                onclick="return confirm('Are you sure you want to delete this topic?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
    <div class="m-6">
        {{ $topics->links() }}
    </div>
</div>