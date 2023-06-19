<template>
    <!-- TODO: change exercises, add progress bar, add next topic button -->
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
                <SplideSlide v-if="exercises[4]" class="mx-10">

                    <div class="slide1 bg-[var(--color-medium2)] mx-auto items-center h-96 hover:bg-[var(--color-medium2)]">
                        <p class="my-auto text-3xl text-center mx-10 leading-10" v-if="nextTopic">
                            Great job! <br>
                            You finished this topic. <br>
                        <div>
                            <Link :href="route('user.topics.show', { topic: nextTopic.id })"
                                class="color-button hover:underline">
                            Go to the next topic ({{ nextTopic.name }})</Link>
                            <br> or <br>
                            <Link :href="`/lessons/from0/${lesson.level}`" class="color-button hover:underline">Return
                            to the progress menu.</Link>
                        </div>
                        </p>
                        <p v-else class="my-auto text-3xl text-center mx-10 leading-10">
                            Great job! <br>
                            You finished all the topics in this lesson. <br>
                        <div>
                            <Link href="/" class="color-button hover:underline">
                            Go back home
                            </Link>
                        </div>
                        </p>

                    </div>

                </SplideSlide>
            </Splide>

        </div>

    </div>
</template>

<script>
import { defineComponent } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
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
    },
    setup() {
        const splideOptions = {
            rewind: true,
            perPage: 1,
            width: '100%',
        };

        return { splideOptions };
    },

    layout: FrontendLayout,
});
</script>