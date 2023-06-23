<template>
    <!-- TODO: change exercises, add progress bar -->
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
        <div class="my-16">
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
                            Go to the next topic ({{ nextTopic.name }})</Link>
                            <br> or <br>
                            <Link as="button" :href="`/lessons/from0/${lesson.level}`" type="submit"
                                class="color-button hover:underline">
                            Return to the progress menu.</Link>
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
                            <form class="mb-10">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" :checked="completed" :disabled="loading"
                                        @change="submitForm">
                                    <div
                                        class="w-11 h-6 bg-[var(--color-lightest)] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[var(--color-medium1)]">
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-[var(--color-darkest)]" v-if="!loading">
                                        {{ completed !== false ? 'Marked as completed' : 'Mark as completed' }}
                                    </span>
                                    <span class="ml-3 text-sm font-medium text-[var(--color-darkest)]" v-else>
                                        Wait a second...
                                    </span>
                                </label>
                            </form>
                        </template>
                    </div>
                </SplideSlide>
            </Splide>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';

export default defineComponent({
    name: 'Topic',
    components: {
        Head, Link, Splide, SplideSlide,
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
            form: {
                topic_id: '',
            },
            loading: false,
        };
    },
    setup(props) {
        const splideOptions = {
            rewind: false,
            perPage: 1,
            width: '100%',
        };

        const form = useForm({
            topic_id: props.topic.id,
        })

        return { splideOptions, form };
    },
    methods: {
        submitForm() {

            this.loading = true;

            setTimeout(() => {
                if (this.form.processing) {
                    return;
                }

                if (!this.completed) {
                    this.form.post('/topics/markAsCompleted/' + this.topic.id)
                } else {
                    this.form.delete('/topics/deleteAsCompleted/' + this.topic.id)
                }
                this.loading = false;
            }, 1000);
        }
    },
    layout: FrontendLayout,
});
</script>