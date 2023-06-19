<template>
    <Head :title="lesson.name" />
    <div class="short-line">
        <h1 class="pt-6 mb-4">{{ lesson.name }}</h1>
    </div>

    <div class="flex my-10">
        <div class="w-1/2 mx-auto">
            <p class="text-lg text-center">{{ lesson.description }}</p>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div class="ml-8 mb-6">
            <h4 class="mx-auto">Grammar topics</h4>
            <ul class="solid-border border-2 overflow-y-scroll h-96">
                <li v-for="grmTopic in grmTopics" :key="grmTopic.id">
                    <Link :href="'/topics/' + grmTopic.id">
                    <h6 class="hover:bg-[var(--color-medium2)] hover:text-[var(--color-darkest)] p-3">{{ grmTopic.name }}
                    </h6>
                    </Link>
                </li>
            </ul>
        </div>

        <div class="ml-8 mb-6">
            <h4 class="mx-auto">Vocabulary topics</h4>
            <ul class="solid-border border-2 overflow-y-scroll h-96">
                <li v-for="vocabTopic in vocabTopics" :key="vocabTopic.id">
                    <Link :href="'/topics/' + vocabTopic.id">
                    <h6 class="hover:bg-[var(--color-medium2)] hover:text-[var(--color-darkest)] p-3">{{ vocabTopic.name }}
                    </h6>
                    </Link>
                </li>
            </ul>
        </div>

        <div class="ml-8 mb-6">
            <h4 class="mx-auto">Extra exercises</h4>
            <ul class="solid-border border-2 overflow-y-scroll h-96">
                <li v-for="mixedExercise in mixedExercises" :key="mixedExercise.id">
                    <Link :href="'/topics/' + mixedExercise.id">
                    <h6 class="hover:bg-[var(--color-medium2)] hover:text-[var(--color-darkest)] p-3">{{ mixedExercise.name
                    }}
                    </h6>
                    </Link>
                </li>
            </ul>
        </div>

    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';


export default {
    name: 'Lesson',
    components: {
        Head, Link
    },
    props: {
        lesson: Object,
        grmTopics: Object,
        vocabTopics: Object,
        mixedExercises: Object,
    },
    layout: FrontendLayout,
}
</script>