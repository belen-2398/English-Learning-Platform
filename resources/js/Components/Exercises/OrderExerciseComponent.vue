<template>
    <div class="flex-col items-center mt-8">
        <div class="mx-20 my-4 bg-[var(--color-lightest)] p-4">
            <ol>
                <li v-for="(sentence, index) in shuffledSentences" :key="index" class="flex flex-wrap items-center">
                    <template v-for="(section, sectionIndex) in sentence.sections" :key="sectionIndex">
                        <p class="mx-2">{{ section }}</p>
                        <p class="mx-2">/</p>
                        <!-- TODO: no / at the end of the sentence -->
                    </template>
                    <p class="mr-10">:</p>
                    <input type="text" class="mb-2" v-model="userResponses[index]">
                </li>
            </ol>
        </div>
        <div class="mx-auto text-center">
            <button @click="checkOrder" class="bg-[var(--color-medium2)] p-2 text-lg rounded text-white">Correct</button>
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
        shuffledSentences() {
            // if (!this.exercise.sentences) {
            //     return [];
            // }
            return this.exercise.sentences
                .filter(sentence => sentence && sentence.trim() !== "")
                .map((sentence) => {
                    const sections = sentence.split(" -- ");
                    return { original: sentence, sections: this.shuffleArray(sections) };
                });
        },
    },
    methods: {
        shuffleArray(array) {
            return array.slice().sort(() => Math.random() - 0.5);
        },
        checkOrder() {
            const cleanedUserResponses = this.userResponses
                .map((response) => (response ? response.trim().toLowerCase() : ""))
                .filter(Boolean)
                .join("")
                .replace(/\s+/g, "")
                .replace(/[^\w\s]/gi, "");

            const correctResponses = this.exercise.sentences
                .filter(sentence => sentence && sentence.trim() !== "")
                .map(sentence => sentence.replace(/--/g, "").trim().toLowerCase())
                .join("")
                .replace(/\s+/g, "")
                .replace(/[^\w\s]/gi, "");

            if (JSON.stringify(cleanedUserResponses) === JSON.stringify(correctResponses)) {
                this.resultMessage = "Correct!";
            } else {
                this.resultMessage = "Incorrect!";
            }

            this.showResult = true;
        },
        showAnswers() {
            this.correctResponses = this.exercise.sentences
                .filter(sentence => sentence && sentence.trim() !== "")
                .map(sentence => sentence.replace(/--/g, "").trim());

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
