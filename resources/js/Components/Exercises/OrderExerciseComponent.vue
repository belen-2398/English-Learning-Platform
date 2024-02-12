<template>
    <div class="flex flex-col items-center justify-center mt-8">
        <div class="mx-5 md:mx-20 my-4 p-4">
            <ol class="flex flex-col justify-center list-decimal gap-3">
                <li v-for="(sentence, index) in shuffledSentences" :key="index">
                    <div class="flex flex-wrap items-center">
                        <template v-for="(section, sectionIndex) in sentence.sections" :key="sectionIndex">
                            <p class="mx-1">{{ section }}</p>
                            <div v-if="sectionIndex < sentence.sections.length - 1">
                                <p class="mx-1">/</p>
                            </div>
                        </template>
                    </div>
                    <input type="text" class="mb-2" v-model="userResponses[index]" aria-label="Your answer">
                </li>
            </ol>
        </div>
        <div class="mx-auto text-center">
            <button @click="checkOrder" class="bg-accentColor p-2 md:text-lg rounded text-white">Correct</button>
            <p v-if="showResult" class="mt-2">{{ resultMessage }}</p>
            <div class="flex mx-auto justify-center gap-10">
                <button @click="redo" v-if="showResult" class="hover:underline">Re-do</button>
                <button @click="showAnswers" v-if="showResult" class="hover:underline">Show answers</button>
            </div>
            <div v-if="showAnswersFlag" class="m-2 border-2 gap-1 p-1 px-10">
                <p>Correct answers:</p>
                <ol class="list-decimal text-left">
                    <template v-for="answer in correctResponses" >
                        <li> {{ answer }}</li>
                    </template>
                </ol>
            </div>
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
