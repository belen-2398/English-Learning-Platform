<template>
    <!-- TODO: ver si se puede drag también en esta y en match o como minimo tachar palabras ya usadas -->
    <div class="flex-col items-center mt-8">
        <div v-if="shuffledWords" class="border-2 py-1 px-4 flex w-3/4 mx-auto my-2">
            <div v-for="(word_to_fill, i) in shuffledWords" :key="i" class="p-2">
                <div v-if="word_to_fill" class="text-lg bg-[var(--color-lightest)] rounded p-2 mx-2">
                    {{ word_to_fill }}
                </div>
            </div>
        </div>
        <div class="mx-20 my-4 bg-[var(--color-lightest)] p-4">
            <template v-if="textHasInputPlaceholder(exercise.text)">
                <div class="flex flex-wrap">
                    <template v-for="(part, index) in splitTextWithInput(exercise.text)">
                        <template v-if="part.isInput">
                            <input :key="`input_${index}`" type="text" :id="`input_${index}`"
                                class="border text-sm w-28 h-6 mx-2 mb-2" v-model="userResponses[index]">
                        </template>
                        <template v-else>
                            <p :key="`text_${index}`">
                                {{ part.text }}
                            </p>
                        </template>
                    </template>
                </div>

            </template>
            <template v-else>
                <p class="text-lg text-center p-2">
                    {{ exercise.text }}
                </p>
            </template>
        </div>
        <div class="mx-auto text-center">
            <button @click="checkOrder" class="bg-[var(--color-medium2)] p-2 text-lg text-white rounded">Correct</button>
            <p v-if="showResult" class="mt-2">{{ resultMessage }}</p>
            <div class="flex mx-auto justify-center gap-10">
                <button @click="redo" v-if="showResult" class="hover:underline">Re-do</button>
                <button @click="showAnswers" v-if="showResult" class="hover:underline">Show answers</button>
            </div>
            <p v-if="showAnswersFlag">Correct answer: {{ correctResponses }}</p>

        </div>

    </div>
</template>

<script>


export default {
    props: {
        exercise: Object,
    },
    data() {
        return {
            userResponses: [],
            correctResponses: [],
            showAnswersFlag: false,
            showResult: false,
            resultMessage: "",
        };
    },
    computed: {
        shuffledWords() {
            const wordsArray = this.exercise.words_to_fill.split("-");
            return this.shuffleArray(wordsArray);
        },
    },
    methods: {
        shuffleArray(array) {
            const shuffledArray = array.slice();
            shuffledArray.sort(() => Math.random() - 0.5);
            return shuffledArray;
        },
        textHasInputPlaceholder(text) {
            return text.includes("__");
        },
        splitTextWithInput(text) {
            const parts = text.split(/__/);
            return parts.map((part, index) => ({
                text: part,
                isInput: index % 2 !== 0 && part !== "",
            }));
        },
        checkOrder() {
            const cleanedUserResponses = this.userResponses
                .map((response) => (response ? response.trim().toLowerCase() : ""))
                .filter(Boolean);

            const correctResponses = this.splitTextWithInput(this.exercise.text)
                .filter((part, index) => index % 2 !== 0)
                .map((part) => part.text.trim().toLowerCase());

            if (JSON.stringify(cleanedUserResponses) === JSON.stringify(correctResponses)) {
                this.resultMessage = "Correct!";
            } else {
                this.resultMessage = "Incorrect!";
            }

            console.log(JSON.stringify(cleanedUserResponses));
            console.log(JSON.stringify(correctResponses));
            this.showResult = true;
        },
        showAnswers() {
            const parts = this.splitTextWithInput(this.exercise.text);
            this.correctResponses = parts
                .map((part) => (part.isInput ? part.text : part.text.replace(/__/g, ""))) //
                .join(" ");

            this.showAnswersFlag = true;
        },
        redo() {
            this.userResponses = [];
            this.showResult = false;
            this.showAnswersFlag = false;
            this.resultMessage = "";
            this.correctResponses = [];
        },
    },
};
</script>
