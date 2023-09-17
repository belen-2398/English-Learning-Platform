@extends('layouts.admin')
@section('title', 'Mixed Exercise Create')
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
        <h2 class="head-title">Update mixed exercise</h2>
        <a href="{{ route('mixed-exercises.index', $lessonId) }}" class="color-button float-end p-3">Back</a>
    </div>
    <form action="{{ route('mixed-exercises.update', $mixedExercise->id) }}" method="POST"
        class="flex-cols justify-center pb-10">
        @csrf
        @method('PUT')
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
                            <input type="text" id="name" name="name" value="{{ $mixedExercise->name }}"
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
                            <input type="number" name="order" id="order" value="{{ $mixedExercise->order }}"
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
                            <input type="checkbox" name="status" id="status" {{ $mixedExercise->status === 1 ? 'checked' : '' }} class="mr-2 leading-tight">
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
                            @if ($mixedExercise->type === 'match')
                                <option value="match" selected>Match</option>
                            @elseif ($mixedExercise->type === 'fill')
                                <option value="fill" selected>Fill</option>
                            @elseif ($mixedExercise->type === 'select')
                                <option value="select" selected>Select</option>
                            @elseif ($mixedExercise->type === 'order')
                                <option value="order" selected>Order</option>
                            @endif
                        </select>
                    </div>
                </div>  
            </div>
        </div>

        {{-- TODO: add unit tests to test if the button shows etc etc for this and exercises --}}
        @if ($mixedExercise->type === 'match')
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
                                class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->left[0] }}</textarea>
                                <textarea type="text" id="left2" name="left2" placeholder="Cat"
                                class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->left[1] }}</textarea>
                                <textarea type="text" id="left3" name="left3" placeholder="Cow"
                                class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->left[2] }}</textarea>
                                @if (isset($mixedExercise->mxexerciseable->left[3]))
                                    <textarea type="text" id="left4" name="left4"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->left[3] }}</textarea>
                                @else
                                    <textarea type="text" id="left4" name="left4" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left4') }}</textarea>
                                @endif 
                                @if (isset($mixedExercise->mxexerciseable->left[4]))
                                    <textarea type="text" id="left5" name="left5"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->left[4] }}</textarea>
                                @else
                                    <textarea type="text" id="left5" name="left5" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left5') }}</textarea>
                                @endif 
                                @if (isset($mixedExercise->mxexerciseable->left[5]))
                                    <textarea type="text" id="left6" name="left6"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->left[5] }}</textarea>
                                @else
                                    <textarea type="text" id="left6" name="left6" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left6') }}</textarea>
                                @endif 
                                @if (isset($mixedExercise->mxexerciseable->left[6]))
                                    <textarea type="text" id="left7" name="left7"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->left[6] }}</textarea>
                                @else
                                    <textarea type="text" id="left7" name="left7" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left7') }}</textarea>
                                @endif 
                                @if (isset($mixedExercise->mxexerciseable->left[7]))
                                    <textarea type="text" id="left8" name="left8"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->left[7] }}</textarea>
                                @else
                                    <textarea type="text" id="left8" name="left8" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left8') }}</textarea>
                                @endif 
                                @if (isset($mixedExercise->mxexerciseable->left[8]))
                                    <textarea type="text" id="left9" name="left9"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->left[8] }}</textarea>
                                @else
                                    <textarea type="text" id="left9" name="left9" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left9') }}</textarea>
                                @endif 
                                @if (isset($mixedExercise->mxexerciseable->left[9]))
                                    <textarea type="text" id="left10" name="left10"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->left[9] }}</textarea>
                                @else
                                    <textarea type="text" id="left10" name="left10" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('left10') }}</textarea>
                                @endif 
                            </div>
                        </div>
                        <div class="flex-col">
                            <div class="">
                                <label class="uppercase text-gray-500 font-bold my-2 flex justify-center" for="right">
                                    Right Column
                                </label>
                            </div>
                            <div class="" id="column_r">
                                <textarea type="text" id="right1" name="right1" placeholder="Dog"
                                class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->right[0] }}</textarea>
                                <textarea type="text" id="right2" name="right2" placeholder="Cat"
                                class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->right[1] }}</textarea>
                                <textarea type="text" id="right3" name="right3" placeholder="Cow"
                                class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->right[2] }}</textarea>
                                @if (isset($mixedExercise->mxexerciseable->right[3]))
                                    <textarea type="text" id="right4" name="right4"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->right[3] }}</textarea>
                                @else
                                    <textarea type="text" id="right4" name="right4" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right4') }}</textarea>
                                @endif 
                                @if (isset($mixedExercise->mxexerciseable->right[4]))
                                    <textarea type="text" id="right5" name="right5"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->right[4] }}</textarea>
                                @else
                                    <textarea type="text" id="right5" name="right5" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right5') }}</textarea>
                                @endif 
                                @if (isset($mixedExercise->mxexerciseable->right[5]))
                                    <textarea type="text" id="right6" name="right6"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->right[5] }}</textarea>
                                @else
                                    <textarea type="text" id="right6" name="right6" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right6') }}</textarea>
                                @endif 
                                @if (isset($mixedExercise->mxexerciseable->right[6]))
                                    <textarea type="text" id="right7" name="right7"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->right[6] }}</textarea>
                                @else
                                    <textarea type="text" id="right7" name="right7" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right7') }}</textarea>
                                @endif 
                                @if (isset($mixedExercise->mxexerciseable->right[7]))
                                    <textarea type="text" id="right8" name="right8"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->right[7] }}</textarea>
                                     @else
                                    <textarea type="text" id="right8" name="right8" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right8') }}</textarea>
                                @endif 
                                @if (isset($mixedExercise->mxexerciseable->right[8]))
                                    <textarea type="text" id="right9" name="right9"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->right[8] }}</textarea>
                                @else
                                    <textarea type="text" id="right9" name="right9" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right9') }}</textarea>
                                @endif 
                                @if (isset($mixedExercise->mxexerciseable->right[9]))
                                    <textarea type="text" id="right10" name="right10"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->right[9] }}</textarea>
                                @else
                                    <textarea type="text" id="right10" name="right10" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right10') }}</textarea>
                                @endif 
                            </div>
                        </div>
                    </div>
                    <div id="additional-pairs" class="flex-col justify-center my-4">
                        <button type="button" id="addPairBtn" class="uppercase text-white bg-gray-500 p-2 rounded font-semibold my-2 mx-auto flex justify-center">Add Pair</button>
                        <p id="maxPairsMessage" class="text-red-500 p-2 text-center hidden">The maximum number of pairs is 10.</p>
                    </div>
                </div>
            </div>
        @elseif($mixedExercise->type === 'fill')
            <div class="flex-cols justify-center">
                {{-- TODO: let user add breaks --}}
                <div id="fill-section" class="flex-col justify-center my-8 border-dashed border-2 w-2/3 mx-auto py-2 px-8">
                    <p class="text-center text-gray-500 my-3">Add the text or sentences for the user to complete.
                        <br> Write the words to be completed in between two lower dashes on each side ("__bark__").</p>
                    <div class="flex justify-center gap-12 mt-4">
                        <div class="flex-col">
                            <div class="" id="fillText">
                                <textarea type="text" cols="50" rows="20" id="fillText" name="fillText" placeholder="The dog is an animal that __barks__, whereas the cow __moos__ and the cat __meows__."
                                class="bg-gray-200 my-2 whitespace-pre-wrap appearance-none border-2 border-gray-200 rounded py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->text }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="uppercase text-gray-500 font-bold my-2 flex justify-center" for="words_to_fill">Words for the user (put a - in between)</label>
                        <input type="text" name="words_to_fill" id="words_to_fill" value="{{ $mixedExercise->mxexerciseable->words_to_fill }}"
                        class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    </div>
                </div>
            </div>
        @elseif($mixedExercise->type === 'order')
            <div class="flex-cols justify-center">
                <div id="order-section" class="flex-col justify-center my-8 border-dashed border-2 w-2/3 mx-auto py-2 px-8">
                    <p class="text-center text-gray-500 underline my-3">Add up to 10 sentences for the user to order. <br> Put them in order, but add "--" to separate the sentence sections.</p>
                    <div class="flex justify-center gap-12 mt-4">
                        <div class="flex-col">
                            {{-- TODO: acá y en match, dar posibilidad de ocultar pares. Add pair no está funcionando para sentences --}}
                            <label class="uppercase text-gray-500 font-bold my-2 flex justify-center" for="sentences">
                                Sentences
                            </label>
                                <textarea type="text" id="orSentence1" name="orSentence1" placeholder="The dog -- is -- a great friend -- to man."
                                class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->sentences[0] }}</textarea>
                                <textarea type="text" id="orSentence2" name="orSentence2"
                                class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->sentences[1] }}</textarea>
                                @if (isset($mixedExercise->mxexerciseable->sentences[2]))
                                    <textarea type="text" id="orSentence3" name="orSentence3"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->sentences[2] }}</textarea>
                                @else
                                    <textarea type="text" id="orSentence3" name="orSentence3" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right3') }}</textarea>
                                @endif 
                                @if (isset($mixedExercise->mxexerciseable->sentences[3]))
                                    <textarea type="text" id="orSentence4" name="orSentence4"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->sentences[3] }}</textarea>
                               @else
                                    <textarea type="text" id="orSentence4" name="orSentence4" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right4') }}</textarea>
                               @endif 
                               @if (isset($mixedExercise->mxexerciseable->sentences[4]))
                                    <textarea type="text" id="orSentence5" name="orSentence5"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->sentences[4] }}</textarea>
                               @else
                                    <textarea type="text" id="orSentence5" name="orSentence5" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right5') }}</textarea>
                               @endif 
                               @if (isset($mixedExercise->mxexerciseable->sentences[5]))
                                    <textarea type="text" id="orSentence6" name="orSentence6"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->sentences[5] }}</textarea>
                               @else
                                    <textarea type="text" id="orSentence6" name="orSentence6" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right6') }}</textarea>
                               @endif 
                               @if (isset($mixedExercise->mxexerciseable->sentences[6]))
                                    <textarea type="text" id="orSentence7" name="orSentence7"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->sentences[6] }}</textarea>
                               @else
                                    <textarea type="text" id="orSentence7" name="orSentence7" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right7') }}</textarea>
                               @endif 
                               @if (isset($mixedExercise->mxexerciseable->sentences[7]))
                                    <textarea type="text" id="orSentence8" name="orSentence8"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->sentences[7] }}</textarea>
                                @else
                                    <textarea type="text" id="orSentence8" name="orSentence8" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right8') }}</textarea>
                                @endif 
                               @if (isset($mixedExercise->mxexerciseable->sentences[8]))
                                    <textarea type="text" id="orSentence9" name="orSentence9"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->sentences[8] }}</textarea>
                               @else
                                    <textarea type="text" id="orSentence9" name="orSentence9" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right9') }}</textarea>
                               @endif 
                               @if (isset($mixedExercise->mxexerciseable->sentences[9]))
                                    <textarea type="text" id="orSentence10" name="orSentence10"
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->sentences[9] }}</textarea>
                               @else
                                    <textarea type="text" id="orSentence10" name="orSentence10" hidden
                                    class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('right10') }}</textarea>
                               @endif 
                        </div>
                    </div>
                    <div id="additional-order-sentences" class="flex-col justify-center my-4">
                        <button type="button" id="addOrderSentenceBtn" class="uppercase text-white bg-gray-500 p-2 rounded font-semibold my-2 mx-auto flex justify-center">Add Sentence</button>
                        <p id="maxOrderSentencesMessage" class="text-red-500 p-2 text-center hidden">The maximum number of sentences is 10.</p>
                    </div>
                </div>
            </div>
        @elseif($mixedExercise->type === 'select')
            <div class="flex-cols justify-center">
                {{-- TODO: let user add breaks --}}
                <div id="select-section" class="flex-col justify-center my-8 border-dashed border-2 w-2/3 mx-auto py-2 px-8">
                    <p class="text-center text-gray-500 my-3">Add the text or sentences from which the user will have to select.
                        <br> Write the correct words to be selected in between two lower dashes on each side ("__bark__").</p>
                    <div class="flex justify-center gap-12 mt-4">
                        <div class="flex-col">
                            <div class="" id="selectText">
                                <textarea type="text" cols="50" rows="20" id="selectText" name="selectText" placeholder="The dog is an animal that __barks__ / meows, whereas the cow purrs / __moos__ and the cat __meows__ / talks."
                                class="bg-gray-200 my-2 whitespace-pre-wrap appearance-none border-2 border-gray-200 rounded py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->text }}</textarea>
                            </div>
                            <label for="selectAnswers">Answers (write them separated by one dash and in order):</label>
                            <div class="" id="selectAnswers">
                                <textarea type="text" cols="50" rows="5" id="selectAnswers" name="selectAnswers" placeholder="barks - moos - meows"
                                class="bg-gray-200 my-2 whitespace-pre-wrap appearance-none border-2 border-gray-200 rounded py-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $mixedExercise->mxexerciseable->answers }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex items-center">
            <div class="color-button font-semibold text-center flex items-center">
                <button type="submit" id="submitBtn">
                    Save
                </button>
            </div>
        </div>
    </form>  
</div>

<script>
    if (document.getElementById('addPairBtn')) {
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
    }

    if (document.getElementById('addOrderSentenceBtn')) {
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
    }

    document.addEventListener('DOMContentLoaded', function () {
        const submitBtn = document.getElementById('submitBtn');

        submitBtn.addEventListener('click', function() {
            submitBtn.disabled = true;
            this.form.submit();
        });
    });
</script>
@endsection
