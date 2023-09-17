@extends('layouts.admin')
@section('title', 'Lesson Index')
@section('content')

<div class="flex justify-between mb-2">
    <h2 class="head-title">Levels</h2>
</div>
<div class="">
    <div class="border-2 border-gray-400 px-6 py-6 grid grid-cols-2 grid-rows-3 gap-6">
        <a href="{{ route('lessons.level.index', ['level' => 'A1']) }}">
            <div class="bg-green-200 py-10 hover:bg-gray-200">
                <h3 class="text-xl text-center">A1</h3>
            </div>
        </a>
        <a href="{{ route('lessons.level.index', ['level' => 'A2']) }}">
            <div class="bg-green-200 py-10 hover:bg-gray-200">
                <h3 class="text-xl text-center">A2</h3>
            </div>
        </a>
        <a href="{{ route('lessons.level.index', ['level' => 'B1']) }}">
            <div class="bg-green-200 py-10 hover:bg-gray-200">
                <h3 class="text-xl text-center">B1</h3>
            </div>
        </a>
        <a href="{{ route('lessons.level.index', ['level' => 'B2']) }}">
            <div class="bg-green-200 py-10 hover:bg-gray-200">
                <h3 class="text-xl text-center">B2</h3>
            </div>
        </a>
        <a href="{{ route('lessons.level.index', ['level' => 'C1']) }}">
            <div class="bg-green-200 py-10 hover:bg-gray-200">
                <h3 class="text-xl text-center">C1</h3>
            </div>
        </a>
        <a href="{{ route('lessons.level.index', ['level' => 'C2']) }}">
            <div class="bg-green-200 py-10 hover:bg-gray-200">
                <h3 class="text-xl text-center">C2</h3>
            </div>
        </a>
    </div>

</div>

@endsection