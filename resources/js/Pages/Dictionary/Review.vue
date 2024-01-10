<template>
    <div>

        <Head title="Review" />
        <div class="short-line">
            <h1 class="pt-6 font-semibold">Review</h1>
            <h2 class="uppercase">Revise your saved words.</h2>
        </div>

        <div class="flex-cols mt-8 md:m-8">
            <div class="flex justify-between my-6 mx-10 text-justify gap-6">
                <h3 class="font-semibold text-sm md:text-lg">Drag the definition or translation to match them with the words
                </h3>
                <button class="color-button hover:text-darkerColor items-center flex" @click="reloadPage">
                    Shuffle
                </button>
            </div>


            <div class="flex mx-6">
                <div class="md:w-1/5 px-4 border-r-2 text-center">
                    <div v-for="(word, index) in dictionaryWords" :key="index" class="h-20 mb-4 flex">
                        <p class="uppercase items-center mx-auto my-auto">
                            {{ word.word }}
                        </p>
                    </div>
                </div>

                <div class="md:w-4/5 px-4">
                    <draggable v-model="draggableWords" group="draggableWords" @start="drag = true" @end="drag = false"
                        item-key="id">
                        <template #item="{ element }">
                            <div v-if="element.definition"
                                class="p-2 hover:bg-lightColor flex text-darkerColor cursor-grab h-20 mb-4">
                                <p class="text-justify text-sm md:text-base items-center my-auto">{{ processText(element.definition) }}
                                </p>
                            </div>
                            <div v-else class="p-2 hover:bg-lightColor flex text-darkerColor cursor-grab h-20 mb-4">
                                <p class="text-justify text-sm md:text-base items-center my-auto">
                                    {{ element.translation || 'No translation nor definition provided' }}
                                </p>
                            </div>
                        </template>
                    </draggable>
                </div>
            </div>

            <div class="mx-auto text-center mb-2">
                <button @click="checkOrder" class="bg-accentColor p-2 text-lg text-white rounded">Correct</button>
                <p v-if="showResult" class="mt-2">{{ resultMessage }}</p>
                <div class="flex mx-auto justify-center gap-10">
                    <button @click="reloadPage" v-if="showResult" class="hover:underline">Keep practicing</button>
                    <button @click="showAnswers" v-if="showResult" class="hover:underline">Show answers</button>
                </div>
                <div v-if="showAnswersFlag" class="my-2 border-2 w-2/3 md:w-1/3 mx-auto p-1">
                    <p>Correct answer:</p>
                    <ul v-for="answer in answers">
                        <li> {{ answer }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import { Head } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import draggable from 'vuedraggable';

export default {
    name: 'Review',
    components: {
        Head,
        draggable,
    },
    props: {
        dictionaryWords: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            draggableWords: [],
            userResponses: [],
            correctResponses: [],
            answers: this.dictionaryWords.map(item => {
                if (item.definition) {
                    return `${item.word} - ${item.definition}`;
                } else if (item.translation) {
                    return `${item.word} - ${item.translation}`;
                } else {
                    return `${item.word} - No definition or translation provided`;
                }
            }),
            showAnswersFlag: false,
            showResult: false,
            resultMessage: "",
        };
    },
    methods: {
        processText(text) {
            const limitedText = text.slice(0, 250);
            const sanitizedText = limitedText.replace(/<[^>]+>/g, ' ');
            const finalText = limitedText.length < text.length ? sanitizedText + '...' : sanitizedText;

            return finalText;
        },
        shuffleArray(array) {
            const shuffledArray = [...array];
            for (let i = shuffledArray.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [shuffledArray[i], shuffledArray[j]] = [shuffledArray[j], shuffledArray[i]];
            }
            return shuffledArray;
        },
        reloadPage() {
            window.location.reload();
        },
        checkOrder() {
            const userResponses = this.draggableWords.map(item => item.word);

            const correctResponses = this.dictionaryWords.map(item => item.word);

            const isCorrect = JSON.stringify(userResponses) === JSON.stringify(correctResponses);

            if (isCorrect) {
                this.resultMessage = "Correct!";
            } else {
                this.resultMessage = "Incorrect!";
            }
            this.showResult = true;
        },
        showAnswers() {

            this.showAnswersFlag = true;
        },
    },
    created() {
        this.draggableWords = this.shuffleArray(this.dictionaryWords);
    },
    layout: FrontendLayout,
};
</script>