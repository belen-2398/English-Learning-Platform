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
                    Prompt
                </th>
                <th scope="col" class="px-6 py-3">
                    Type
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
            @if ($mixedExercises->count() > 0)
                    @foreach ($mixedExercises as $mixedExercise)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            @if (!isset($varValue))
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a class="hover:underline" href="{{ route('mixed-exercises.lesson.index', ['lessonId' => $mixedExercise->lesson->id]) }}">
                                        {{ $mixedExercise->lesson->name ?? 'N/A' }}
                                    </a>
                                </td> 
                            @endif
                            <td class="px-6 py-4">
                                {{ $mixedExercise->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $mixedExercise->order }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $mixedExercise->prompt ?? 'No prompt' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $mixedExercise->type }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $mixedExercise->status == 0 ? '' : 'V' }}
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <a href="{{ route('mixed-exercises.show', $mixedExercise->id) }}"
                                        class="font-medium text-green-600 dark:text-green-500 hover:underline">
                                        Show
                                    </a>
                                    <br>
                                    <a href="{{ route('mixed-exercises.edit', $mixedExercise->id) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('mixed-exercises.destroy', $mixedExercise->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type='submit' class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                        onclick="return confirm('Are you sure you want to delete this exercise?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
            @else
                <tr class="bg-white dark:bg-gray-900 font-semibold">
                    <td id="noContentYetMsg" class="px-6 pt-4">No mixed exercises for this lesson yet.</td>
                </tr>
            @endif
        </tbody>
    </table>
    @if ($mixedExercises->count() > 0)
        <div class="m-6">
            {{ $mixedExercises->links() }}
        </div>
    @endif
</div>  