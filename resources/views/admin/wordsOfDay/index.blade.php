
@extends('layouts.admin')
@section('title', 'Word of the Day Index')
@section('content')
        <div class="flex justify-between mb-2">
            <h2 class="head-title">Word of the Day Index</h2>
            <div class="my-4 ml-auto mr-4">
                <a class="color-button" href="{{ route('word-of-day.create') }}">New word</a>
            </div>
        </div>

    @if ($wordsOfDay->count() > 0)
        <div class="flex items-center">
            <x-search :actionUrl="route($actionUrl)">
                <option value="word" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Word</option>
                <option value="type" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Type</option>
                <option value="definition" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Definition</option>
                <option value="examples" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Examples</option>
            </x-search>

            <x-dateFilter :actionUrl='route($actionUrl)'></x-dateFilter>
            
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
                                    'date_parameter' => request('date_parameter')]) }}">
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
                                    'date_parameter' => request('date_parameter')]) }}">
                                    <div class="flex justify-between">
                                        <span>Type</span>
                                        <x-tableOrderBy sortBy="type" />
                                    </div> 
                                </a>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Audio
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <a href="{{ route('word-of-day.index',
                                    ['sort' => request('sort') == 'asc' ? 'desc' : 'asc', 'sort_by' => 'publish_date',
                                    'query_parameter' => request('query_parameter'),
                                    'query' => request('query'),
                                    'date_parameter' => request('date_parameter')]) }}">
                                    <div class="flex justify-between">
                                        <span>Date for posting</span>
                                        <x-tableOrderBy sortBy="publish_date" />
                                    </div> 
                                </a>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Image
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
                                <td>
                                    @if ($wordOfDay->audio)
                                        <audio controls>
                                            <source src="{{ asset($wordOfDay->audio) }}" type="audio/{{ pathinfo($wordOfDay->audio, PATHINFO_EXTENSION) }}">
                                        Your browser does not support the audio element.
                                        </audio>
                                    @else
                                        <p>No audio uploaded.</p>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-xs">
                                    {{ $wordOfDay->formattedDate }}
                                </td>
                                <td class="px-4 py-4">
                                    @if ($wordOfDay->image)
                                        <img src="{{ asset($wordOfDay->image) }}" class="table-image"
                                            alt="{{ $wordOfDay->description }}"> 
                                    @else
                                        <p>No image uploaded.</p>
                                    @endif
                                    
                                </td>
                                <td class="px-4 py-4">
                                    <div>
                                        <a href="{{ route('word-of-day.show', $wordOfDay->id) }}"
                                            class="font-medium text-green-600 dark:text-green-500 hover:underline">
                                            Show
                                        </a>
                                        <br>
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
          @else
              <p class="font-semibold text-center my-6 text-xl">No words of the day yet.</p>
          @endif          
        
@endsection