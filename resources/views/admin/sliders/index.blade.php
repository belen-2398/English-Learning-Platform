@extends('layouts.admin')
@section('title', 'Slider Index')
@section('content')

{{-- TODO: fix links and give options --}}

    <div class="flex justify-between mb-2">
        <h2 class="head-title">Slider Index</h2>
        <div class="my-4 ml-auto mr-4">
            <a class="color-button" href="{{ route('sliders.create') }}">New Slider</a>
        </div>
    </div>

    <div class="flex items-center">
        <x-search :actionUrl="route('sliders.index')">
            <option value="title" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Title</option>
            <option value="" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Other</option>
        </x-search>

        <x-status :actionUrl='$slidersIndex' />           
    </div>
                    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('sliders.index',
                            ['sort' => request('sort') == 'asc' ? 'desc' : 'asc', 'sort_by' => 'title',
                            'query_parameter' => request('query_parameter'),
                            'query' => request('query'),
                            'status_parameter' => request('status_parameter')]) }}">
                            <div class="flex justify-between">
                                <span>Title</span>
                                <x-tableOrderBy sortBy="title" />
                            </div> 
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Link
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Image
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
                @foreach ($sliders as $slider)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $slider->title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ Str::limit($slider->description, 50, '...') }}
                            @if (strlen($slider->description) > 50)
                            <button type="button" id="fullTextBtn" data-modal-target="fullTextModal{{ $slider->id }}"
                                data-modal-toggle="fullTextModal{{ $slider->id }}"
                                class="block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded text-xs px-1 py-1 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                See more
                            </button>
                        @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $slider->link }}
                        </td>
                        <td class="px-6 py-4">
                            <img src="{{ asset("$slider->image") }}" class="table-image"
                                alt="{{ $slider->title }}"> 
                        </td>
                        <td class="px-6 py-4">
                            {{ $slider->status == 0 ? '' : 'V' }}
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <a href="{{ route('sliders.edit', $slider->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    Edit
                                </a>
                                <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type='submit' class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                    onclick="return confirm('Are you sure you want to delete this slider?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="m-6">
            {{ $sliders->links() }}
        </div>
    </div>

    @foreach ($sliders as $slider)
        <x-fullText element="{{ $slider->id }}">
            <x-slot name="title">
                {{ $slider->title }}
            </x-slot>
        
            <x-slot name="description">
                {{ $slider->description  }}
            </x-slot>
        </x-fullText>
    @endforeach
@endsection