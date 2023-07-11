@extends('layouts.admin')
@section('title', 'Exercise Update')
@section('content')
<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="m-6 p-4 flex justify-between">
        <h2 class="head-title">Update exercise</h2>
        <a href="{{ route('exercises.index') }}" class="color-button float-end p-3">Back</a>
    </div>
    <form action="{{ route('exercises.update', $exercise->id) }}" method="POST"
        class="flex-cols justify-center pb-10">
        @csrf
        @method('PUT')
        <div class="flex justify-between gap-1 mx-12 mt-4">
            <div class="flex items-center mb-6 w-1/4 justify-between">
                <div class="">
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="level">
                        Level
                    </label>
                </div>
                <div class="w-3/4">
                    <select name="level" id="level"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                        <option value="">Choose a level</option>
                        <option value="A1" {{ $exercise->level === 'A1' ? 'selected' : '' }}>A1</option>
                        <option value="A2" {{ $exercise->level === 'A2' ? 'selected' : '' }}>A2</option>
                        <option value="B1" {{ $exercise->level === 'B1' ? 'selected' : '' }}>B1</option>
                        <option value="B2" {{ $exercise->level === 'B2' ? 'selected' : '' }}>B2</option>
                        <option value="C1" {{ $exercise->level === 'C1' ? 'selected' : '' }}>C1</option>
                        <option value="C2" {{ $exercise->level === 'C2' ? 'selected' : '' }}>C2</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center mb-6 w-1/4 justify-between">
                <div class="">
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="lesson_id">
                        Lesson
                    </label>
                </div>
                <div class="w-3/4">
                    <select name="lesson_id" id="lesson_id"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                        <option value="">Choose a lesson</option>
                        @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}" {{ $lesson->id === $exercise->lesson_id ? 'selected' : '' }}>
                                {{ $lesson->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex items-center mb-6 w-1/4 justify-between">
                <div class="">
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="lesson_id">
                        Topic
                    </label>
                </div>
                <div class="w-3/4">
                    <select name="topic_id" id="topic_id"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    <option value="">Choose a topic</option>
                    @foreach ($topics as $topic)
                        <option value="{{ $topic->id }}" {{ $topic->id === $exercise->topic_id ? 'selected' : '' }}>
                            {{ $topic->name }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
        </div>
        <div class="flex justify-between gap-1 mx-12 mt-4">
            <div class="flex items-center mb-6 w-1/4 justify-between">
                <div class="">
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="name">
                        Name
                    </label>
                </div>
                <div class="md:w-3/4">
                    <input type="text" id="name" name="name" value="{{ $exercise->name }}"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
            </div>
            <div class="md:flex md:items-center mb-6 w-1/4 justify-between">
                <div class="">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md pr-2" for="category">
                        Category
                    </label>
                </div>
                <div class="md:w-3/4">
                    <select name="category" id="category"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                        <option value="">Choose a category</option>
                        <option value="grammar" {{ $exercise->category === 'grammar' ? 'selected' : '' }}>Grammar</option>
                        <option value="vocabulary" {{ $exercise->category === 'vocabulary' ? 'selected' : '' }}>Vocabulary</option>
                        <option value="mixed" {{ $exercise->category === 'mixed' ? 'selected' : '' }}>Mixed</option>
                    </select>
                </div>
            </div>
            <div class="md:flex md:items-center mb-6 w-1/4 justify-between">
                <div class="">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md pr-2" for="type">
                        Type
                    </label>
                </div>
                <div class="md:w-3/4">
                    <select name="type" id="type"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    <option value="">Choose a type</option>
                    <option value="match" {{  $exercise->type === 'match' ? 'selected' : '' }}>Match</option>
                    <option value="fill" {{  $exercise->type === 'fill' ? 'selected' : '' }}>Fill</option>
                    <option value="select" {{  $exercise->type === 'select' ? 'selected' : '' }}>Select</option>
                    <option value="order" {{  $exercise->type === 'order' ? 'selected' : '' }}>Order</option>
                </select>
                </div>
            </div>
        </div>
        <div class="flex-cols justify-center">
            <div id="match-section" class="flex-col justify-center my-8 border-dashed border-2 w-2/3 mx-auto py-2 px-8">
                <p class="text-center text-gray-500 underline my-3">Edit the pairs or add more. <br> Remember to put them in order.</p>
                <div class="flex justify-center gap-12 mt-4">
                    <div class="flex-col">
                        <label class="uppercase text-gray-500 font-bold my-2 flex justify-center" for="left">
                            Left Column
                        </label>
                        <div class="" id="column_l">
                            <textarea type="text" id="left1" name="left1" placeholder="Dog"
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->left1 }}</textarea>
                            <textarea type="text" id="left2" name="left2" placeholder="Cat"
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->left2 }}</textarea>
                            <textarea type="text" id="left3" name="left3" placeholder="Cow"
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->left3 }}</textarea>
                            <textarea type="text" id="left4" name="left4" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->left4 }}</textarea>
                            <textarea type="text" id="left5" name="left5" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->left5 }}</textarea>
                            <textarea type="text" id="left6" name="left6" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->left6 }}</textarea>
                            <textarea type="text" id="left7" name="left7" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->left7 }}</textarea>
                            <textarea type="text" id="left8" name="left8" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->left8 }}</textarea>
                            <textarea type="text" id="left9" name="left9" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->left9 }}</textarea>
                            <textarea type="text" id="left10" name="left10"  hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->left10 }}</textarea>
                        </div>
                    </div>
                    <div class="flex-col">
                        <div class="">
                            <label class="uppercase text-gray-500 font-bold my-2 flex justify-center" for="right">
                                Right Column
                            </label>
                        </div>
                        <div class="" id="column_r">
                            <textarea type="text" id="right1" name="right1" placeholder="Animal that barks"
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->right1 }}</textarea>
                            <textarea type="text" id="right2" name="right2" placeholder="Animal that meows"
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->right2 }}</textarea>
                            <textarea type="text" id="right3" name="right3" placeholder="Animal that moos"
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->right3 }}</textarea>
                            <textarea type="text" id="right4" name="right4" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->right4 }}</textarea>
                            <textarea type="text" id="right5" name="right5" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->right5 }}</textarea>
                            <textarea type="text" id="right6" name="right6" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->right6 }}</textarea>
                            <textarea type="text" id="right7" name="right7" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->right7 }}</textarea>
                            <textarea type="text" id="right8" name="right8" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->right8 }}</textarea>
                            <textarea type="text" id="right9" name="right9" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->right9 }}</textarea>
                            <textarea type="text" id="right10" name="right10" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $matchExercise->right10 }}</textarea>
                        </div>
                        {{-- TODO: show existing ones that are now hidden. The submit button doesn't work --}}
                    </div>
                </div>
                <div id="additional-pairs" class="flex-col justify-center my-4">
                    <button type="button" id="addPairBtn" class="uppercase text-white bg-gray-500 p-2 rounded font-semibold my-2 mx-auto flex justify-center">Add/Show Pair</button>
                    {{-- TODO: delete pair, show pair until the value is empty then add --}}
                    <p id="maxPairsMessage" class="text-red-500 p-2 text-center hidden">The maximum number of pairs is 10.</p>
                </div>
            </div>
        </div>
        <div class="flex justify-between mx-12">
            <div class="flex items-center mb-6">
                <label class="text-gray-500 font-bold text-right pr-4" for="order">
                    Exercise order
                </label>
                <input type="number" name="order" id="order" value="{{ $exercise->order }}"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
            </div>
            <div class="flex items-center mb-6">
                <label class="text-gray-500 font-bold pr-4" for="status">
                    Status
                </label>
                <input type="checkbox" name="status" id="status" class="mx-2"  {{ $exercise->status === 1 ? 'checked' : '' }}>
                <br>
                <span class="text-sm text-gray-500">
                    Unchecked = Hidden, checked = visible
                </span>   
            </div>
        </div>
        <div class="flex items-center">
            <div class="color-button font-semibold text-center flex items-center">
                <button type="submit" id="submitBtn">
                    Update
                </button>
            </div>
        </div>
    </form>  
</div>

<script>
     document.getElementById('type').addEventListener('change', function() {
        var matchSection = document.getElementById('match-section');
        if (this.value === 'match') {
            matchSection.style.display = 'block';
        } else {
            matchSection.style.display = 'none';
        }
    });
  

    document.getElementById('addPairBtn').addEventListener('click', function () {
        const leftColumnCount = document.querySelectorAll('textarea[id^="left"]:not([hidden])').length;
        const rightColumnCount = document.querySelectorAll('textarea[id^="right"]:not([hidden])').length;


        if (leftColumnCount >= 10 || rightColumnCount >= 10) {
            this.disabled = true;
            document.getElementById('maxPairsMessage').style.display = 'block';
            return;
        }

        const nextPairIndex = Math.max(leftColumnCount, rightColumnCount) + 1;

        const leftTextarea = document.getElementById(`left${nextPairIndex}`);
        const rightTextarea = document.getElementById(`right${nextPairIndex}`);

        leftTextarea.removeAttribute('hidden');
        rightTextarea.removeAttribute('hidden');
    });
</script>
@endsection
