<template>
    <!-- TODO: change exercise frontend -->
    <div class="mb-10">

        <Head :title="topic.name" />

        <div class="pb-6">
            <h1> {{ topic.name }} </h1>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="mt-10 mb-4">
            <div class="mb-8 md:mx-20 flex md:flex-row flex-col md:justify-between items-center">
                <div class="flex justify-end mb-2 md:mb-0 mx-2">
                    <input type="text" class="w-1/2 md:w-auto" v-model="inputWord" placeholder="Enter a word." aria-label="Word to look up in the dictionary">
                    <button class="color-button ml-2 rounded text-sm md:text-base" @click="openDefinitionModal(inputWord)">Look up in the
                        dictionary</button>
                </div>
                <template v-if="$page.props.auth.user">
                    <button class="bg-darkerColor p-2 text-bgColor rounded text-sm md:text-base" @click="openAddToDictionaryModal()">Add a word to your dictionary</button>
                </template>
            </div>
            <Splide :options="splideOptions" aria-label="Topic">
                <SplideSlide class="md:mx-10">
                    <div class="flex mx-auto justify-center items-center h-full bg-mainColor">
                        <p class="md:mx-auto mx-10 text-center text-wrap text-3xl ">
                            Swipe right to start learning
                        </p>
                    </div>
                </SplideSlide>
                <SplideSlide class="mx-10" v-for="topicSlide in topicSlides">
                    <div class="flex-cols mx-auto items-center my-auto py-20 md:py-10">
                        <h3 class="text-3xl text-center mx-auto pt-8">
                            {{ topicSlide.name }}
                        </h3>
                        <div v-if="topicSlide.prompt">
                            <h4 class="mx-2.5">{{ topicSlide.prompt }}</h4>
                        </div>
                        <template v-if="topicSlide.explanation">
                            <div class="mx-auto text-center mt-8 border w-3/4 p-4"
                                v-html="topicSlide.explanation.explanation">
                            </div>
                        </template>
                        <template v-else-if="topicSlide.exercise">
                            <div v-if="topicSlide.exercise.type === 'match'">
                                <MatchExerciseComponent :exercise="topicSlide.exercise.exerciseable">
                                </MatchExerciseComponent>
                            </div>
                            <div v-else-if="topicSlide.exercise.type === 'fill'">
                                <FillExerciseComponent :exercise="topicSlide.exercise.exerciseable">
                                </FillExerciseComponent>
                            </div>
                            <div v-else-if="topicSlide.exercise.type === 'order'">
                                <OrderExerciseComponent :exercise="topicSlide.exercise.exerciseable">
                                </OrderExerciseComponent>
                            </div>
                            <div v-else-if="topicSlide.exercise.type === 'select'">
                                <SelectExerciseComponent :exercise="topicSlide.exercise.exerciseable">
                                </SelectExerciseComponent>
                            </div>
                        </template>
                    </div>
                </SplideSlide>
                <SplideSlide class="mx-10">
                    <div
                        class="slide1 bg-accentColor mx-auto items-center h-full hover:bg-accentColor">
                        <p class="text-black my-auto text-xl md:text-3xl text-center mx-2 md:mx-10 md:leading-10" v-if="nextTopic">
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
                        <p v-else class="text-black my-auto text-3xl text-center mx-10 leading-10">
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
        <div>
            <Comments :topicId="topic.id" :comments="comments" :commentsCount="commentsCount">
            </Comments>
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
import Definition from '../../Components/Modals/Dictionary/Definition.vue';
import Comments from '../../Components/Modals/Comments/Comments.vue';
import AddToDictionary from '../../Components/Modals/Dictionary/AddToDictionary.vue';
import CompletedForm from '../../Components/CompletedForm.vue';
import MatchExerciseComponent from '../../Components/Exercises/MatchExerciseComponent.vue';
import FillExerciseComponent from '../../Components/Exercises/FillExerciseComponent.vue';
import OrderExerciseComponent from '../../Components/Exercises/OrderExerciseComponent.vue';
import SelectExerciseComponent from '../../Components/Exercises/SelectExerciseComponent.vue';

export default defineComponent({
    name: 'Topic',
    components: {
        Head,
        Link,
        Splide,
        SplideSlide,
        Definition,
        Comments,
        AddToDictionary,
        CompletedForm,
        MatchExerciseComponent,
        FillExerciseComponent,
        OrderExerciseComponent,
        SelectExerciseComponent
    },
    props: {
        topic: Object,
        topicSlides: Object,
        nextTopic: Object,
        lesson: Object,
        completed: Boolean,
        commentsCount: Number,
        comments: Object,
    },
    data() {
        return {
            loading: false,
            showDefinitionModal: false,
            inputWord: '',
            data: null,
            showAddToDictionaryModal: false,
            topicId: '',
        };
    },
    setup() {
        const splideOptions = {
            rewind: false,
            perPage: 1,
            width: '100%',
            drag: true,
            arrows: false,
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