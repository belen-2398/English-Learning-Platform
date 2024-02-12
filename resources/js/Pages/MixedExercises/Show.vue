<template>
    <!-- TODO:  add translation button -->
    <!-- TODO: add drag and drop -->
    <div class="mb-10">

        <Head :title="mixedExercise.name" />

        <div class="short-line pb-6">
            <h1> {{ mixedExercise.name }} </h1>
            <h2 class="mt-6 text-xl uppercase">
                Complete the exercise
            </h2>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="md:mt-10 mb-4">
            <div class="md:flex md:flex-row md:justify-between md:mx-8 mb-8 ">
                <div class="md:flex md:flex-row md:justify-between items-center">
                    <div class="flex justify-end bg-lightColor p-2 mx-1">
                        <input type="text" class="w-auto" v-model="inputWord" placeholder="Enter a word..." aria-label="Word to look up in the dictionary">
                        <button class="color-button ml-2 rounded text-sm md:text-base" @click="openDefinitionModal(inputWord)">Look up in the dictionary</button>
                    </div>
                    <div v-if="$page.props.auth.user" class="flex justify-center mx-auto">
                        <button class="bg-mainColor text-bgColor mx-auto md:ml-2 mt-2 md:mt-0 p-2 rounded" @click="openAddToDictionaryModal()">Add a
                            word to your dictionary
                        </button>
                    </div>
                </div>

                <Link as="button" :href="route('user.lessons.show', { lesson: mixedExercise.lesson_id })"
                    class="hidden md:block bg-accentColor p-2 md:text-lg rounded text-white" type="submit">
                Go back
                </Link>
            </div>
            <div v-if="mixedExercise.prompt" class="mx-1.5">
                <h4>{{ mixedExercise.prompt }}</h4>
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