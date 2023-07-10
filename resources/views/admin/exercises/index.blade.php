
@extends('layouts.admin')
@section('title', 'Exercise Index')
@section('content')
{{-- TODO: edit table on click --}}

    <div class="flex justify-between mb-2">
        <h2 class="head-title">Exercise Index</h2>
        <div class="my-4 ml-auto mr-4">
            <a class="color-button" href="{{ route('exercises.create') }}">New exercise</a>
        </div>
    </div>
    <div class="flex items-center">
        <x-search :actionUrl="route('exercises.index')">
                <option value="level" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Level</option>
                <option value="name" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Name</option>
                <option value="category" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Category</option>
                <option value="type" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Type</option>
            </x-search>
        <x-status :actionUrl='$exercisesIndex' />           
    </div>
                
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('exercises.index',
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
                        Lesson
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Topic
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('exercises.index',
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
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('exercises.index',
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
                @foreach ($exercises as $exercise)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $exercise->level }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($exercise->lesson) {{ $exercise->lesson->name }}  @endif
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($exercise->topic) {{ $exercise->topic->name }}  @endif
                        </th>
                        <td class="px-6 py-4">
                            {{ $exercise->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $exercise->category }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $exercise->type }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $exercise->status == 0 ? '' : 'V' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $exercise->order }}
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <a href="{{ route('exercises.edit', $exercise->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    Edit
                                </a>
                                <form action="{{ route('exercises.destroy', $exercise->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type='submit' class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                    onclick="return confirm('Are you sure you want to delete this exercise?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="m-6">
            {{ $exercises->links() }}
        </div>
    </div>
@endsection