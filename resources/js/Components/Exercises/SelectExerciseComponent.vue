<template>
    <div class="flex-col items-center mt-8">
        <div class="mx-20 my-4 bg-[var(--color-lightest)] p-4">
            <div class="flex flex-wrap items-center">
                <template v-for="(section, index) in transformedText" :key="index">
                    <div>
                        <span> {{ section.text }}</span>
                        <template v-if="section.options.length > 0">
                            <select v-model="selectedOptions[index]" class="mx-2 h-10 text-sm mb-2">
                                <option v-for="(option, optionIndex) in section.options" :key="optionIndex">
                                    {{ option }}
                                </option>
                            </select>
                        </template>
                    </div>
                </template>
            </div>
        </div>
        <div class="mx-auto text-center">
            <button @click="checkOrder" class="bg-[var(--color-medium2)] p-2 text-lg rounded">Correct</button>
            <p v-if="showResult" class="mt-2">{{ resultMessage }}</p>
            <div class="flex mx-auto justify-center gap-10">
                <button @click="redo" v-if="showResult" class="hover:underline">Re-do</button>
                <button @click="showAnswers" v-if="showResult" class="hover:underline">Show answers</button>
            </div>
            <p v-if="showAnswersFlag">Correct answer: {{ exercise.answers }}</p>

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
            correctResponses: [],
            showAnswersFlag: false,
            showResult: false,
            resultMessage: "",
            transformedText: [],
            selectedOptions: []
        };
    },
    mounted() {
        this.transformText();
    },
    methods: {
        transformText() {
            const sections = this.exercise.text.split("__");
            for (let i = 0; i < sections.length; i++) {
                if (i % 2 === 1) {
                    const sectionParts = sections[i].split("/");
                    const options = sectionParts.map(option => option.trim());
                    this.transformedText.push({ options: options });
                    this.selectedOptions.push("");
                } else {
                    this.transformedText.push({ text: sections[i], options: [] });
                }
            }
        },
        checkOrder() {
            const cleanedUserResponses = this.selectedOptions
                .map(response => response ? response.trim().toLowerCase() : "")
                .filter(response => response);

            const correctResponses = this.exercise.answers
                .split(" - ")
                .map(answer => answer.trim().toLowerCase());

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
            this.showAnswersFlag = true;
        },
        redo() {
            this.showResult = false;
            this.showAnswersFlag = false;
            this.resultMessage = "";
            this.correctResponses = [];
            this.selectedOptions = [];
        },
    },
};
</script>
