<template>
    <div class="flex-col items-center mt-8">
        <div class="border-2 p-1 flex w-3/4 mx-auto my-2">
            <div v-for="(rightItem, i) in shuffledRightItems" :key="i">
                <div v-if="rightItem" class="text-lg text-center mx-10">
                    {{ rightItem }}
                </div>
            </div>
        </div>
        <ul class="flex-cols columns-3 mx-20 my-4">
            <div v-for="(leftItem, i) in exercise.left" :key="i">
                <div class="flex" v-if="leftItem">
                    <p class="text-xl text-center w-3/4 mb-4 p-2 rounded bg-[var(--color-lightest)]">
                        {{ leftItem }}
                    </p>
                    <input type="text" :id="'leftItem_' + i" class="border w-3/4 mx-2 mb-4" v-model="userResponses[i]">
                </div>
            </div>
        </ul>
        <div class="mx-auto text-center">
            <button @click="checkOrder" class="bg-[var(--color-medium2)] p-2 text-lg rounded">Correct</button>
            <p v-if="showResult" class="mt-2">{{ resultMessage }}</p>
            <div class="flex mx-auto justify-center gap-10">
                <button @click="redo" v-if="showResult" class="hover:underline">Re-do</button>
                <button @click="showAnswers" v-if="showResult" class="hover:underline">Show answers</button>
            </div>
            <p v-if="showAnswersFlag">Correct order: {{ correctResponses }}</p>

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
        shuffledRightItems() {
            return this.shuffleArray(this.exercise.right);
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

            const correctResponses = this.exercise.right
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
            this.correctResponses = this.exercise.right
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
