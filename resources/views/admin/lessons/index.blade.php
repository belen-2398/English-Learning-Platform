
@extends('layouts.admin')
@section('title', 'Lesson Index')
@section('content')
{{-- TODO: edit table on click --}}

    <div class="flex justify-between mb-2">
        <h2 class="head-title">Lesson Index</h2>
        <div class="my-4 ml-auto mr-4">
            <a class="color-button" href="{{ route('lessons.create') }}">New lesson</a>
        </div>
    </div>
    <div class="flex items-center">
        <x-search :actionUrl="route('lessons.index')">
                <option value="level" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Level</option>
                <option value="name" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Name</option>
                <option value="description" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Description</option>
        </x-search>
        <x-status :actionUrl='$lessonsIndex' />           
    </div>
                
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('lessons.index',
                            ['sort' => request('sort') == 'asc' ? 'desc' : 'asc', 'sort_by' => 'level',
                            'query_parameter' => request('query_parameter'),
                            'query' => request('query'),
                            'status_parameter' => request('status_parameter')]) }}">
                            <div class="flex justify-between">
                                <span>Level</span>
                                <x-tableOrderBy sortBy="level" />
                            </div> 
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('lessons.index',
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
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Mixed exercises
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('lessons.index',
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
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lessons as $lesson)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $lesson->level }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $lesson->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Str::limit($lesson->description, 50, '...') }}
                            @if (strlen($lesson->description) > 50)
                                <button type="button" id="fullTextBtn" data-modal-target="fullTextModal{{ $lesson->id }}"
                                    data-modal-toggle="fullTextModal{{ $lesson->id }}"
                                    class="block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded text-xs px-1 py-1 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                    See more
                                </button>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $lesson->status == 0 ? '' : 'V' }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($lesson->mixedExercises()->count() > 0)
                               <a href="{{ route('mixed-exercises.index', $lesson->id) }}">See mixed exercises.</a>
                            @else
                                <p>No mixed exercises.</p>
                                <a href="{{ route('mixed-exercises.create', $lesson->id) }}" class="hover:underline">Add one.</a>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $lesson->order }}
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <a href="{{ route('lessons.edit', $lesson->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    Edit
                                </a>
                                <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type='submit' class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                    onclick="return confirm('Are you sure you want to delete this lesson?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="m-6">
            {{ $lessons->links() }}
        </div>
    </div>
    @foreach ($lessons as $lesson)
        <x-fullText element="{{ $lesson->id }}">
            <x-slot name="title">
                {{ $lesson->name }}
            </x-slot>
        
            <x-slot name="description">
                {{ $lesson->description  }} <br>
            </x-slot>
        </x-fullText>
    @endforeach

@endsection