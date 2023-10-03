@extends('layouts.admin')
@section('title', 'Admin User Index')
@section('content')

    <div class="flex justify-between mb-2">
        <h2 class="head-title">User Index</h2>
    </div>

    <div class="flex items-center">
        <x-search :actionUrl="route($actionUrl)">
            <option value="name" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Name</option>
            <option value="email" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">E-Mail</option>
        </x-search>              
    </div>

    {{-- TODO: edit role on click --}}
    {{-- TODO: add percentage of completed topics --}}

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <a href="{{ route($actionUrl,
                        ['sort' => request('sort') == 'asc' ? 'desc' : 'asc', 'sort_by' => 'name',
                            'query_parameter' => request('query_parameter'),
                            'query' => request('query')]) }}">
                        <div class="flex justify-between">
                            <span>Name</span>
                            <x-tableOrderBy sortBy="name" />
                        </div> 
                    </a>
                </th>
                <th scope="col" class="px-6 py-3">
                    <a href="{{ route($actionUrl,
                    ['sort' => request('sort') == 'asc' ? 'desc' : 'asc', 'sort_by' => 'email',
                        'query_parameter' => request('query_parameter'),
                        'query' => request('query')]) }}">
                        <div class="flex justify-between">
                            <span>E-Mail</span>
                            <x-tableOrderBy sortBy="email" />
                        </div> 
                    </a>
                </th>
                <th scope="col" class="px-6 py-3">
                    <a href="{{ route($actionUrl,
                    ['sort' => request('sort') == 'asc' ? 'desc' : 'asc', 'sort_by' => 'role_as',
                        'query_parameter' => request('query_parameter'),
                        'query' => request('query')]) }}">
                        <div class="flex justify-between">
                            <span>Role</span>
                            <x-tableOrderBy sortBy="role_as" />
                        </div> 
                    </a>
                </th>
                {{-- <th scope="col" class="px-6 py-3">
                    Percentage of completed topics
                </th> --}}
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">              
                    <td class="px-6 py-4">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        @if ($user->role_as === 0)
                            User
                        @elseif($user->role_as === 1)
                            Teacher
                        @elseif($user->role_as === 2)
                            Admin
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            @if ($user->role_as !== 2)
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="font-medium text-gray-600 dark:text-gray-500 hover:underline">
                                    Edit role
                                </a>
                            @endif
                            
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="m-6">
        {{ $users->links() }}
    </div>
</div>

@endsection
