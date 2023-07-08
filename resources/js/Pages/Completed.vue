<template>
    <!-- TODO: add level for the lessons -->

    <Head title="Completed" />
    <div class="short-line">
        <h1 class="pt-6">Completed</h1>
        <h2 class="text-xl py-4 uppercase">All your completed topics</h2>
    </div>

    <template v-if="$page.props.auth.user">
        <template v-if="$page.props.completed">
            <div class="mt-16 flex flex-col border-2 border-dashed border-[var(--color-medium1)] p-4 mx-8 justify-between">
                <div class="columns-4 mb-6">
                    <ol class="flex" v-for="(topicsByLesson, lessonName) in completed" :key="lessonName">
                        <li class="relative w-1 mx-20">
                            <div class="inline-flex items-top">
                                <div class="flex items-top circle-connect">
                                    <div class="z-10 flex items-center justify-center w-6 h-6
                  bg-[var(--color-medium1)] rounded-full ring-0 ring-white shrink-0">
                                        <svg aria-hidden="true" class="w-4 h-4 text-[var(--color-lightest)]"
                                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="ml-2 text-xl mb-2 text-[var(--color-darkest)]">{{ lessonName }}</h3>
                                    <div v-for="topic in topicsByLesson" :key="topic.id">
                                        <Link :href="'/topics/' + topic.id">
                                        <h6 class="ml-6">
                                            {{ topic.name }}
                                        </h6>
                                        <p class="font-small text-justify">
                                            {{ topic.description }}
                                        </p>
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <template v-else>
            You haven't completed any topics yet.
        </template>
    </template>
    <template v-else>
        <p>You have to be logged in to access this feature.</p>
    </template>
</template>

<script>
import { defineComponent } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import '@splidejs/vue-splide/css';

export default defineComponent({
    name: 'Completed',
    components: {
        Head, Link,
    },
    props: {
        completed: Object,
    },

    layout: FrontendLayout,
});
</script>