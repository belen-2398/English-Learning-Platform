<template>
    <!-- TODO:  add translation button -->
    <!-- TODO: add drag and drop -->
    <div class="mb-10">

        <Head :title="mixedExercise.name" />

        <div class="short-line pb-6">
            <h1> {{ mixedExercise.name }} </h1>
            <h2 class="mt-6 text-xl">
                WELCOME TO THIS EXERCISE
            </h2>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="mt-10 mb-4">
            <div class="flex justify-between mx-8 mb-8 ">
                <div class="flex justify-between items-center">
                    <template v-if="$page.props.auth.user">
                        <button class="color-button rounded" @click="openAddToDictionaryModal()">Add word to
                            dictionary</button>
                    </template>
                    <div class="flex justify-end">
                        <input type="text" v-model="inputWord" placeholder="Enter a word.">
                        <button class="color-button ml-2 rounded" @click="openDefinitionModal(inputWord)">Look up in the
                            dictionary</button>
                    </div>
                </div>

                <Link as="button" :href="route('user.lessons.show', { lesson: mixedExercise.lesson_id })"
                    class="bg-[var(--color-medium2)] p-2 text-lg rounded text-white" type="submit">
                Go back                 
                </Link>
            </div>

            <div v-if="mixedExercise.type === 'match'">
                <MatchExerciseComponent :exercise="mixedExercise.mxexerciseable">
                </MatchExerciseComponent>
            </div>
            <div v-else-if="mixedExercise.type === 'fill'">
                <FillExerciseComponent :exercise="mixedExercise.mxexerciseable">
                </FillExerciseComponent>
            </div>
            <div v-else-if="mixedExercise.type === 'order'">
                <OrderExerciseComponent :exercise="mixedExercise.mxexerciseable">
                </OrderExerciseComponent>
            </div>
            <div v-else-if="mixedExercise.type === 'select'">
                <SelectExerciseComponent :exercise="mixedExercise.mxexerciseable">
                </SelectExerciseComponent>
            </div>
        </div>
    </div>
    <Definition :word="inputWord" :data="data" :showModal="showDefinitionModal" :loading="loading"
        @closeModal="closeDefinitionModal">
    </Definition>
    <AddToDictionary :showModal="showAddToDictionaryModal" @closeModal="closeAddToDictionaryModal">
    </AddToDictionary>
</template>

<script>
import { defineComponent } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import axios from 'axios';
import Definition from '../../Components/Modals/Dictionary/Definition.vue';
import AddToDictionary from '../../Components/Modals/Dictionary/AddToDictionary.vue';
import MatchExerciseComponent from '../../Components/Exercises/MatchExerciseComponent.vue';
import FillExerciseComponent from '../../Components/Exercises/FillExerciseComponent.vue';
import OrderExerciseComponent from '../../Components/Exercises/OrderExerciseComponent.vue';
import SelectExerciseComponent from '../../Components/Exercises/SelectExerciseComponent.vue';

export default defineComponent({
    name: 'Topic',
    components: {
        Head,
        Link,
        Definition,
        AddToDictionary,
        MatchExerciseComponent,
        FillExerciseComponent,
        OrderExerciseComponent,
        SelectExerciseComponent
    },
    props: {
        lesson: Object,
        mixedExercise: Object,
    },
    data() {
        return {
            loading: false,
            showDefinitionModal: false,
            inputWord: '',
            data: null,
            showAddToDictionaryModal: false,
        };
    },
    methods: {
        getDefinition() {
            this.loading = true;
            setTimeout(() => {
                axios.get('/get-definition/' + this.word)
                    .then(response => {
                        this.data = response.data.data;
                        this.loading = false;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            })
        },
        openDefinitionModal(inputWord) {
            this.word = inputWord;
            this.getDefinition();
            this.showDefinitionModal = true;
        },
        closeDefinitionModal() {
            this.showDefinitionModal = false;
        },
        openAddToDictionaryModal() {
            this.showAddToDictionaryModal = true;
        },
        closeAddToDictionaryModal() {
            this.showAddToDictionaryModal = false;
        },
    },
    layout: FrontendLayout,
});
</script>