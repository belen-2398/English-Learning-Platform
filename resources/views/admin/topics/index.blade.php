@extends('layouts.admin')
@section('title', 'Topic Index')
@section('content')
{{-- TODO: edit table on click --}}

    <div class="flex justify-between mb-2">
        <h2 class="head-title">Topic Index</h2>
        <div class="my-4 ml-auto mr-4">
            <a class="color-button" href="{{ route('topics.create') }}">New topic</a>
        </div>
    </div>

    <div class="flex items-center">
        <x-search :actionUrl="route('topics.index')">
            <option value="lesson" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Lesson</option>
            <option value="name" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Name</option>
            <option value="category" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Category</option>
            <option value="points" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Points</option>
        </x-search>

        <x-status :actionUrl='$topicsIndex' />           
    </div>
    
                
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Lesson
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('topics.index',
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
                        <a href="{{ route('topics.index',
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
                        Points
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Explanation
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topics as $topic)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">                   
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $topic->lesson->name ?? 'N/A' }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $topic->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $topic->category }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $topic->order }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $topic->points }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $topic->status == 0 ? '' : 'V' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Str::limit($topic->explanation1, 50, '...') }}
                            @if (strlen($topic->explanation1) > 50)
                                <button type="button" id="fullTextBtn" data-modal-target="fullTextModal{{ $topic->id }}"
                                    data-modal-toggle="fullTextModal{{ $topic->id }}"
                                    class="block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded text-xs px-1 py-1 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                    See more
                                </button>
                            @endif
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

    @foreach ($topics as $topic)
        <x-fullText element="{{ $topic->id }}">
            <x-slot name="title">
                {{ $topic->name }}
            </x-slot>
        
            <x-slot name="description">
                {{ $topic->explanation1  }} <br>
                {{ $topic->explanation2  }} <br>
                {{ $topic->explanation3  }} <br>
                {{ $topic->explanation4  }} <br>
                {{ $topic->explanation5  }} <br>
            </x-slot>
        </x-fullText>
    @endforeach

@endsection
