
@extends('layouts.admin')
@section('title', 'Word of the Day Index')
@section('content')
{{-- TODO: way to show only word a day and having a backlog of posibilities so that it is changed automatically --}}
        <div class="flex justify-between mb-2">
            <h2 class="head-title">Word of the Day Index</h2>
            <div class="my-4 ml-auto mr-4">
                <a class="color-button" href="{{ route('word-of-day.create') }}">New word</a>
            </div>
        </div>
        <div class="flex items-center">
            <x-search :actionUrl="route('word-of-day.index')">
                <option value="word" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Word</option>
                <option value="type" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Type</option>
                <option value="definition" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Definition</option>
                <option value="examples" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Examples</option>
            </x-search>
    
            <x-status :actionUrl='$wordsOfDayIndex' /> 
            <x-dictionary :actionUrl='$wordsOfDayIndex' />            
        </div>
                    
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">
                            <a href="{{ route('word-of-day.index',
                                ['sort' => request('sort') == 'asc' ? 'desc' : 'asc', 'sort_by' => 'word',
                                'query_parameter' => request('query_parameter'),
                                'query' => request('query'),
                                'status_parameter' => request('status_parameter'),
                                'dictionary_parameter' => request('dictionary_parameter')]) }}">
                                <div class="flex justify-between">
                                    <span>Word</span>
                                    <x-tableOrderBy sortBy="word" />
                                </div> 
                            </a>
                        </th>
                        <th scope="col" class="px-4 py-3">
                            <a href="{{ route('word-of-day.index',
                                ['sort' => request('sort') == 'asc' ? 'desc' : 'asc', 'sort_by' => 'type',
                                'query_parameter' => request('query_parameter'),
                                'query' => request('query'),
                                'status_parameter' => request('status_parameter'),
                                'dictionary_parameter' => request('dictionary_parameter')]) }}">
                                <div class="flex justify-between">
                                    <span>Type</span>
                                    <x-tableOrderBy sortBy="type" />
                                </div> 
                            </a>
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Pronunciation
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Audio
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Definition
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Examples
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-4 py-3">
                            In dictionary?
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wordsOfDay as $wordOfDay)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $wordOfDay->word }}
                            </th>
                            <td class="px-4 py-4">
                                {{ $wordOfDay->type }}
                            </td>
                            <td class="px-4 py-4">
                                {{ $wordOfDay->pronunciation }}
                            </td>
                            <td>
                                @if ($wordOfDay->audio)
                                    <audio controls>
                                        <source src="{{ asset($wordOfDay->audio) }}" type="audio/{{ pathinfo($wordOfDay->audio, PATHINFO_EXTENSION) }}">
                                    Your browser does not support the audio element.
                                    </audio>
                                @else
                                    No audio uploaded.
                                @endif
                                
                            </td>
                            <td class="px-4 py-4">
                                {{ Str::limit($wordOfDay->definition, 50, '...') }}
                                @if (strlen($wordOfDay->definition) > 50)
                                    <button type="button" id="fullTextBtn" data-modal-target="fullTextModal{{ $wordOfDay->id }}"
                                        data-modal-toggle="fullTextModal{{ $wordOfDay->id }}"
                                        class="block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded text-xs px-1 py-1 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                        See more
                                    </button>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                {{ Str::limit($wordOfDay->examples, 50, '...') }}
                                @if (strlen($wordOfDay->examples) > 50)
                                    <button type="button" id="fullTextBtn2" data-modal-target="fullTextModal2{{ $wordOfDay->id }}"
                                        data-modal-toggle="fullTextModal2{{ $wordOfDay->id }}"
                                        class="block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded text-xs px-1 py-1 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                        See more
                                    </button>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                <img src="{{ $wordOfDay->image ? asset($wordOfDay->image) : 'No image uploaded.' }}" class="table-image"
                                    alt="{{ $wordOfDay->description }}"> 
                            </td>
                            <td class="px-4 py-4">
                                {{ $wordOfDay->addToDictionary == 0 ? 'N' : 'Y' }}
                            </td>
                            <td class="px-4 py-4">
                                {{ $wordOfDay->status == 0 ? '' : 'V' }}
                            </td>
                            <td class="px-4 py-4">
                                <div>
                                    <a href="{{ route('word-of-day.edit', $wordOfDay->id) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('word-of-day.destroy', $wordOfDay->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type='submit' class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                        onclick="return confirm('Are you sure you want to delete this word?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="m-6">
                {{ $wordsOfDay->links() }}
            </div>
        
        </div>
    @foreach ($wordsOfDay as $wordOfDay)
        <x-fullText element="{{ $wordOfDay->id }}">
            <x-slot name="title">
                {{ $wordOfDay->word }}
            </x-slot>
        
            <x-slot name="description">
                    {{ $wordOfDay->definition  }}
            </x-slot>
        </x-fullText>
        <x-fullText2 element="{{ $wordOfDay->id }}">
            <x-slot name="title">
                {{ $wordOfDay->word }}
            </x-slot>
        
            <x-slot name="description">
                    {{ $wordOfDay->examples  }}
            </x-slot>
        </x-fullText2>
    @endforeach
@endsection