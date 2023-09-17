@extends('layouts.admin')
@section('title', 'Mixed Exercise Create')
@section('content')
{{-- TODO: all exercise variations hidden at first. Show mixed exercise lesson_id with lesson name --}}
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
        <h2 class="head-title">Create mixed exercise</h2>
        <a href="{{ route('mixed-exercises.index', $lessonId) }}" class="color-button float-end p-3">Back</a>
    </div>
    <form action="{{ route('mixed-exercises.store') }}" method="POST"
        class="flex-cols justify-center pb-10">
        @csrf
        <div class="flex justify-center mt-4">
            <div class="">
                <input type="hidden" name="lesson_id" id="lesson_id" value="{{ $lessonId }}">
                <div class="md:flex md:items-center mb-6 justify-between">
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">
                                Name
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="order">
                                Order
                            </label>
                        </div>
                        <div class="md:w-1/3">
                            <input type="number" name="order" id="order" value="{{ old('order') }}"
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                        </div>
                    </div>
                </div>
                
                <div class="md:flex md:items-center mb-6 justify-between">
                    <div class="md:w-1/2">
                        <div class="flex items-center">
                            <label class="md:w-1/3 block text-gray-500 font-bold" for="status">
                                Status
                            </label>
                            <input type="checkbox" name="status" id="status" class="mr-2 leading-tight">
                        </div>
                        <span class="text-sm text-gray-600">
                           Unchecked = hidden <br> Checked = visible
                        </span>
                    </div>
                    <div class="">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md pr-2" for="type">
                            Type
                        </label>
                    </div>
                    <div class="md:w-3/4">
                        <select name="type" id="type"
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                            <option value="">Choose a type</option>
                            <option value="match" {{ old('type') === 'match' ? 'selected' : '' }}>Match</option>
                            <option value="fill" {{ old('type') === 'fill' ? 'selected' : '' }}>Fill</option>
                            <option value="select" {{ old('type') === 'select' ? 'selected' : '' }}>Select</option>
                            <option value="order" {{ old('type') === 'order' ? 'selected' : '' }}>Order</option>
                        </select>
                    </div>
                </div>
                
            </div>
        </div>
        
        {{-- Match exercises --}}
        <div class="flex-cols justify-center">
            <div id="match-section" class="flex-col justify-center my-8 border-dashed border-2 w-2/3 mx-auto py-2 px-8">
                <p class="text-center text-gray-500 underline my-3">Add 3 to 10 pairs for the user to match. <br> Put them in order.</p>
                <div class="flex justify-center gap-12 mt-4">
                    <div class="flex-col">
                        <label class="uppercase text-gray-500 font-bold my-2 flex justify-center" for="left">
                            Left Column
                        </label>
                        <div class="" id="column_l">
                            <textarea type="text" id="left1" name="left1" placeholder="Dog"
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left1') }}</textarea>
                            <textarea type="text" id="left2" name="left2" placeholder="Cat"
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left2') }}</textarea>
                            <textarea type="text" id="left3" name="left3" placeholder="Cow"
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left3') }}</textarea>
                            <textarea type="text" id="left4" name="left4" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left4') }}</textarea>
                            <textarea type="text" id="left5" name="left5" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left5') }}</textarea>
                            <textarea type="text" id="left6" name="left6" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left6') }}</textarea>
                            <textarea type="text" id="left7" name="left7" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left7') }}</textarea>
                            <textarea type="text" id="left8" name="left8" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left8') }}</textarea>
                            <textarea type="text" id="left9" name="left9" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left9') }}</textarea>
                            <textarea type="text" id="left10" name="left10" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left10') }}</textarea>
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
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right1') }}</textarea>
                            <textarea type="text" id="right2" name="right2" placeholder="Animal that meows"
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right2') }}</textarea>
                            <textarea type="text" id="right3" name="right3" placeholder="Animal that moos"
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right3') }}</textarea>
                            <textarea type="text" id="right4" name="right4" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right4') }}</textarea>
                            <textarea type="text" id="right5" name="right5" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right5') }}</textarea>
                            <textarea type="text" id="right6" name="right6" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right6') }}</textarea>
                            <textarea type="text" id="right7" name="right7" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right7') }}</textarea>
                            <textarea type="text" id="right8" name="right8" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right8') }}</textarea>
                            <textarea type="text" id="right9" name="right9" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right9') }}</textarea>
                            <textarea type="text" id="right10" name="right10"  hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right10') }}</textarea>
                        </div>
                    </div>
                </div>
                <div id="additional-pairs" class="flex-col justify-center my-4">
                    <button type="button" id="addPairBtn" class="uppercase text-white bg-gray-500 p-2 rounded font-semibold my-2 mx-auto flex justify-center">Add Pair</button>
                    <p id="maxPairsMessage" class="text-red-500 p-2 text-center hidden">The maximum number of pairs is 10.</p>
                </div>
            </div>
        </div>
        {{-- Fill exercises --}}
        <div class="flex-cols justify-center">
            {{-- TODO: let user add breaks --}}
            <div id="fill-section" class="flex-col justify-center my-8 border-dashed border-2 w-2/3 mx-auto py-2 px-8">
                <p class="text-center text-gray-500 my-3">Add the text or sentences for the user to complete.
                    <br> Write the words to be completed in between two lower dashes on each side ("__bark__").</p>
                <div class="flex justify-center gap-12 mt-4">
                    <div class="flex-col">
                        <div class="" id="fillText">
                            <textarea type="text" cols="50" rows="20" id="fillText" name="fillText" placeholder="The dog is an animal that __barks__, whereas the cow __moos__ and the cat __meows__."
                            class="bg-gray-200 my-2 whitespace-pre-wrap appearance-none border-2 border-gray-200 rounded py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('fillText') }}</textarea>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="uppercase text-gray-500 font-bold my-2 flex justify-center" for="words_to_fill">Words for the user (put a - in between)</label>
                    <input type="text" name="words_to_fill" id="words_to_fill" value="{{ old('words_to_fill') }}"
                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
            </div>
        </div>
        {{-- Order exercises --}}
        <div class="flex-cols justify-center">
            <div id="order-section" class="flex-col justify-center my-8 border-dashed border-2 w-2/3 mx-auto py-2 px-8">
                <p class="text-center text-gray-500 underline my-3">Add up to 10 sentences for the user to order. <br> Put them in order, but add "--" to separate the sentence sections.</p>
                <div class="flex justify-center gap-12 mt-4">
                    <div class="flex-col">
                        <label class="uppercase text-gray-500 font-bold my-2 flex justify-center" for="sentences">
                            Sentences
                        </label>
                            <textarea type="text" id="orSentence1" name="orSentence1" placeholder="The dog -- is -- a great friend -- to man."
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('orSentence1') }}</textarea>
                            <textarea type="text" id="orSentence2" name="orSentence2"
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('orSentence2') }}</textarea>
                            <textarea type="text" id="orSentence3" name="orSentence3" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('orSentence3') }}</textarea>
                            <textarea type="text" id="orSentence4" name="orSentence4" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('orSentence4') }}</textarea>
                            <textarea type="text" id="orSentence5" name="orSentence5" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('orSentence5') }}</textarea>
                            <textarea type="text" id="orSentence6" name="orSentence6" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('orSentence6') }}</textarea>
                            <textarea type="text" id="orSentence7" name="orSentence7" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('orSentence7') }}</textarea>
                            <textarea type="text" id="orSentence8" name="orSentence8" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('orSentence8') }}</textarea>
                            <textarea type="text" id="orSentence9" name="orSentence9" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('orSentence9') }}</textarea>
                            <textarea type="text" id="orSentence10" name="orSentence10" hidden
                            class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('orSentence10') }}</textarea>
                    </div>
                </div>
                <div id="additional-order-sentences" class="flex-col justify-center my-4">
                    <button type="button" id="addOrderSentenceBtn" class="uppercase text-white bg-gray-500 p-2 rounded font-semibold my-2 mx-auto flex justify-center">Add Sentence</button>
                    <p id="maxOrderSentencesMessage" class="text-red-500 p-2 text-center hidden">The maximum number of sentences is 10.</p>
                </div>
            </div>
        </div>
        {{-- Select exercises --}}
        <div class="flex-cols justify-center">
            {{-- TODO: let user add breaks --}}
            <div id="select-section" class="flex-col justify-center my-8 border-dashed border-2 w-2/3 mx-auto py-2 px-8">
                <p class="text-center text-gray-500 my-3">Add the text or sentences from which the user will have to select.
                    <br> Write the words to be selected in between two lower dashes on each side and a vertical dash in the middle ("__bark / meow / moo__").</p>
                <div class="flex justify-center gap-12 mt-4">
                    <div class="flex-col">
                        <div class="" id="selectText">
                            <textarea type="text" cols="50" rows="20" id="selectText" name="selectText" placeholder="The dog is an animal that __barks / meows__, whereas the cow __purrs / moos__ and the cat __meows / talks__."
                            class="bg-gray-200 my-2 whitespace-pre-wrap appearance-none border-2 border-gray-200 rounded py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('fillText') }}</textarea>
                        </div>
                        <label for="selectAnswers">Answers (write them separated by one dash and in order):</label>
                        <div class="" id="selectAnswers">
                            <textarea type="text" cols="50" rows="5" id="selectAnswers" name="selectAnswers" placeholder="barks - moos - meows"
                            class="bg-gray-200 my-2 whitespace-pre-wrap appearance-none border-2 border-gray-200 rounded py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('fillAnswers') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit btn --}}
        <div class="flex items-center">
            <div class="color-button font-semibold text-center flex items-center">
                <button type="submit" id="submitBtn">
                    Create
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

        var fillSection = document.getElementById('fill-section');
        
        if (this.value === 'fill') {
            fillSection.style.display = 'block';
        } else {
            fillSection.style.display = 'none';
        }

        var orderSection = document.getElementById('order-section');
        
        if (this.value === 'order') {
            orderSection.style.display = 'block';
        } else {
            orderSection.style.display = 'none';
        }

        var selectSection = document.getElementById('select-section');
        
        if (this.value === 'select') {
            selectSection.style.display = 'block';
        } else {
            selectSection.style.display = 'none';
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

    document.getElementById('addOrderSentenceBtn').addEventListener('click', function () {
        const orSentenceCount = document.querySelectorAll('textarea[id^="orSentence"]:not([hidden])').length;

        if (orSentenceCount >= 10) {
            this.disabled = true;
            document.getElementById('maxOrderSentencesMessage').style.display = 'block';
            return;
        }

        const nextOrderSentenceIndex = orSentenceCount + 1;

        const orSentenceTextarea = document.getElementById(`orSentence${nextOrderSentenceIndex}`);

        orSentenceTextarea.removeAttribute('hidden');
    });

    document.addEventListener('DOMContentLoaded', function () {
        const submitBtn = document.getElementById('submitBtn');

        // Prevent double submission
        submitBtn.addEventListener('click', function() {
            submitBtn.disabled = true;
            this.form.submit();
        });
    });
</script>
@endsection
