<template>
    <div>

        <Head title="Review" />
        <div class="short-line">
            <h1 class="pt-6">Review</h1>
            <h2 class="uppercase">Let's review the words you saved.</h2>
        </div>

        <div class="flex-cols m-8">
            <div class="flex justify-between my-6 mx-10">
                <h3 class="mb-6 font-semibold">Drag the definition/translation to match them with the words </h3>
                <button class="color-button hover:text-[var(--color-darker)] items-center flex" @click="reloadPage">
                    Change words
                </button>
            </div>

            <div class="flex mx-6">
                <div class="w-1/5 px-4 border-r-2 text-center">
                    <div v-for="(word, index) in dictionaryWords" :key="index" class="h-20 mb-6">
                        <p class="uppercase mt-5">
                            {{ word.word }}
                        </p>
                    </div>
                </div>

                <div class="w-4/5 px-4">
                    <draggable v-model="draggableWords" group="draggableWords" @start="drag = true" @end="drag = false"
                        item-key="id">
                        <template #item="{ element, index }" class="flex gap-8 mx-10 p-2 border-2">
                            <div v-if="element.definition"
                                class="p-2 hover:bg-[var(--color-light)] text-[var(--color-darker)] cursor-grab h-20 mb-6">
                                <p class="text-justify">{{ element.definition }}</p>
                            </div>
                            <div v-else class="p-2 bg-[var(--color-light)] text-[var(--color-darker)] cursor-grab h-20">
                                <p class="text-justify">
                                    {{ element.translation || 'No translation nor definition provided' }}
                                </p>
                            </div>
                        </template>
                    </draggable>
                </div>
            </div>

            <div class="mx-auto text-center">
                <button @click="checkOrder"
                    class="bg-[var(--color-medium2)] p-2 text-lg text-white rounded">Correct</button>
                <p v-if="showResult" class="mt-2">{{ resultMessage }}</p>
                <div class="flex mx-auto justify-center gap-10">
                    <button @click="reloadPage" v-if="showResult" class="hover:underline">Keep practicing</button>
                    <button @click="showAnswers" v-if="showResult" class="hover:underline">Show answers</button>
                </div>
                <p v-if="showAnswersFlag">Correct answer: {{ answers }}</p>
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

            console.log(userResponses);
            console.log(this.correctResponses);
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