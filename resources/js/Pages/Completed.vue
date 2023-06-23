<template>
    <!-- TODO: change to format like from 0 lines -->

    <Head title="Completed" />
    <div class="short-line">
        <h1 class="pt-6 mb-4">Completed</h1>
        <h2>All the topics you have completed.</h2>
    </div>

    <template v-if="$page.props.auth.user">
        <template v-if="$page.props.completed">
            <div class="mx-20 mt-20">
                <ul class="solid-border border-2 p-12">
                    <li v-for="(topicsByLesson, lessonName) in completed" :key="lessonName">
                        <div class="level-container">
                            <h3 class="bg-[var(--color-lightest)] w-1/2 mx-auto text-center text-4xl">{{ lessonName }}</h3>
                            <ul class="grid grid-cols-3 gap-4">
                                <li v-for="topic in topicsByLesson" :key="topic.id" class="list-line">
                                    <Link :href="'/topics/' + topic.id">
                                    <h4 class="text-xl mb-2 underline">
                                        {{ topic.name }}
                                    </h4>
                                    <p class="font-small text-justify">
                                        {{ topic.description }}
                                    </p>
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
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