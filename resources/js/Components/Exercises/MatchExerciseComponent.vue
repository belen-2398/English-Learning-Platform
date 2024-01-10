<template>
    <div class="flex-col items-center mt-8">
        <div class="border-2 p-1 flex w-3/4 mx-auto md:gap-4 flex-wrap justify-center">
            <div v-for="(leftItem, i) in shuffledLeftItems" :key="i">
                <div v-if="leftItem" class="md:text-lg mx-8 my-3">
                    {{ leftItem }}
                </div>
            </div>
        </div>
        <ul class="flex-cols md:columns-3 mx-4 md:mx-20 my-8">
            <div v-for="(rightItem, i) in exercise.right" :key="i">
                <div class="flex" v-if="rightItem">
                    <p class="text-center w-3/4 gap-4 p-2 rounded bg-bgColor">
                        {{ rightItem }}
                    </p>
                    <input type="text" :id="'leftItem_' + i" class="border w-3/4 mx-2 mb-4" v-model="userResponses[i]">
                </div>
            </div>
        </ul>
        <div class="mx-auto text-center">
            <button @click="checkOrder" class="bg-accentColor p-2 text-lg rounded text-white">Correct</button>
            <p v-if="showResult" class="mt-2">{{ resultMessage }}</p>
            <div class="flex mx-auto justify-center gap-10">
                <button @click="redo" v-if="showResult" class="hover:underline">Re-do</button>
                <button @click="showAnswers" v-if="showResult" class="hover:underline">Show answers</button>
            </div>
            <div v-if="showAnswersFlag" class="my-2 border-2 w-2/3 md:w-1/3 mx-auto p-1">
                <p>Correct answer:</p>
                <ul v-for="answer in correctResponses">
                    <li> {{ answer }}</li>
                </ul>
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
        shuffledLeftItems() {
            return this.shuffleArray(this.exercise.left);
        },
    },
    methods: {
        shuffleArray(array) {
            const shuffledArray = array.slice();
            shuffledArray.sort(() => Math.random() - 0.5);
            return shuffledArray;
        },
        checkOrder() {
            const cleanedUserResponses = this.userResponses
                .map((response) => (response ? response.trim().toLowerCase() : ""))
                .filter(Boolean);

            const correctResponses = this.exercise.left
                .map((response) => (response ? response.trim().toLowerCase() : ""))
                .filter(Boolean);

            if (JSON.stringify(cleanedUserResponses) === JSON.stringify(correctResponses)) {
                this.resultMessage = "Correct!";
            } else {
                this.resultMessage = "Incorrect!";
            }

            this.showResult = true;
        },
        showAnswers() {
            this.correctResponses = this.exercise.left
                .map((response) => (response ? response.trim() : ""))
                .filter(Boolean);

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
