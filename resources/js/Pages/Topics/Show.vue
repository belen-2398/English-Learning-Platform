<template>
    <!-- TODO: change exercises, add translation button -->
    <div class="mb-10">

        <Head :title="topic.name" />

        <div class="short-line pb-6">
            <h1> {{ topic.name }} </h1>
            <h2 class="mt-6 text-xl">
                WELCOME TO THIS TOPIC
            </h2>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="mt-10 mb-4">
            <div class="mb-8 mx-20 flex justify-between items-center">
                <template v-if="$page.props.auth.user">
                    <button class="color-button rounded" @click="openAddToDictionaryModal()">Add word to dictionary</button>
                </template>
                <div class="flex justify-end">
                    <input type="text" v-model="inputWord" placeholder="Enter a word.">
                    <button class="color-button ml-2 rounded" @click="openDefinitionModal(inputWord)">Look up in the
                        dictionary</button>
                </div>

            </div>
            <Splide :options="splideOptions" aria-label="Topic">
                <SplideSlide class="mx-10">
                    <div class="slide1 bg-[var(--color-medium1)] mx-auto items-center h-96 hover:bg-[var(--color-medium1)]">
                        <p class="my-auto text-3xl">
                            Click on the right to start.
                        </p>
                    </div>
                </SplideSlide>
                <SplideSlide class="mx-10">
                    <div class="slide1 mx-auto items-center h-96">
                        <p class="my-auto text-3xl text-center mx-10">
                            {{ topic.explanation1 }}
                        </p>
                    </div>
                </SplideSlide>
                <SplideSlide v-if="exercises[0]" class="mx-10">
                    <div class="slide1 mx-auto items-center h-96">
                        <p class="my-auto text-3xl text-center mx-10">
                            {{ exercises[0].name }}
                        </p>
                    </div>
                </SplideSlide>
                <SplideSlide v-if="topic.explanation2" class="mx-10">
                    <div class="slide1 mx-auto items-center h-96">
                        <p class="my-auto text-3xl text-center mx-10">
                            {{ topic.explanation2 }}
                        </p>
                    </div>
                </SplideSlide>
                <SplideSlide v-if="exercises[1]" class="mx-10">
                    <div class="slide1 mx-auto items-center h-96">
                        <p class="my-auto text-3xl text-center mx-10">
                            {{ exercises[1].name }}
                        </p>
                    </div>
                </SplideSlide>
                <SplideSlide v-if="topic.explanation3" class="mx-10">
                    <div class="slide1 mx-auto items-center h-96">
                        <p class="my-auto text-3xl text-center mx-10">
                            {{ topic.explanation3 }}
                        </p>
                    </div>
                </SplideSlide>
                <SplideSlide v-if="exercises[2]" class="mx-10">
                    <div class="slide1 mx-auto items-center h-96">
                        <p class="my-auto text-3xl text-center mx-10">
                            {{ exercises[2].name }}
                        </p>
                    </div>
                </SplideSlide>
                <SplideSlide v-if="topic.explanation4" class="mx-10">
                    <div class="slide1 mx-auto items-center h-96">
                        <p class="my-auto text-3xl text-center mx-10">
                            {{ topic.explanation4 }}
                        </p>
                    </div>
                </SplideSlide>
                <SplideSlide v-if="exercises[3]" class="mx-10">
                    <div class="slide1 mx-auto items-center h-96">
                        <p class="my-auto text-3xl text-center mx-10">
                            {{ exercises[3].name }}
                        </p>
                    </div>
                </SplideSlide>
                <SplideSlide v-if="topic.explanation5" class="mx-10">
                    <div class="slide1 mx-auto items-center h-96">
                        <p class="my-auto text-3xl text-center mx-10">
                            {{ topic.explanation5 }}
                        </p>
                    </div>
                </SplideSlide>
                <SplideSlide v-if="exercises[4]" class="mx-10">
                    <div class="slide1 mx-auto items-center h-96">
                        <p class="my-auto text-3xl text-center mx-10">
                            {{ exercises[4].name }}
                        </p>
                    </div>
                </SplideSlide>
                <SplideSlide class="mx-10">
                    <div class="slide1 bg-[var(--color-medium2)] mx-auto items-center h-96 hover:bg-[var(--color-medium2)]">
                        <p class="my-auto text-3xl text-center mx-10 leading-10" v-if="nextTopic">
                            Great job! <br>
                            You finished this topic. <br>
                        <div>
                            <Link as="button" :href="route('user.topics.show', { topic: nextTopic.id })" type="submit"
                                class="color-button hover:underline">
                            Go to the next topic ({{ nextTopic.name }})
                            </Link>
                            <br> or <br>
                            <Link as="button" :href="`/lessons/from0/${lesson.level}`" type="submit"
                                class="color-button hover:underline">
                            Return to the progress menu.
                            </Link>
                        </div>
                        </p>
                        <p v-else class="my-auto text-3xl text-center mx-10 leading-10">
                            Great job! <br>
                            You finished all the topics in this lesson. <br>
                        <div>
                            <Link as="button" href="/" class="color-button hover:underline" type="submit">
                            Go back home
                            </Link>
                        </div>
                        </p>
                        <template v-if="$page.props.auth.user">
                            <CompletedForm :completed="completed" :topic="topic" :loading="loading">
                            </CompletedForm>
                        </template>
                    </div>
                </SplideSlide>
            </Splide>
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
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
import axios from 'axios';
import Definition from '../../Components/Definition.vue';
import AddToDictionary from '../../Components/Modals/Dictionary/AddToDictionary.vue';
import CompletedForm from '../../Components/CompletedForm.vue';

export default defineComponent({
    name: 'Topic',
    components: {
        Head,
        Link,
        Splide,
        SplideSlide,
        Definition,
        AddToDictionary,
        CompletedForm,
    },
    props: {
        topic: Object,
        exercises: Array,
        nextTopic: Object,
        lesson: Object,
        completed: Boolean,
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
    setup() {
        const splideOptions = {
            rewind: false,
            perPage: 1,
            width: '100%',
        };

        return {
            splideOptions,
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