<template>
    <Head :title="lesson.name" />
    <div class="short-line">
        <h1 class="pt-6 mb-4 font-bold">{{ lesson.name }}</h1>
    </div>

    <div class="flex my-10">
        <div class="w-3/4 md:w-1/2 mx-auto">
            <p class="text-lg text-center">{{ lesson.description }}</p>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-4">
        <div class="mx-4 md:ml-8 mb-6">
            <h4 class="mx-auto">Grammar topics</h4>
            <ul class="solid-border border-2 overflow-y-scroll md:h-96">
                <li v-for="grmTopic in grmTopics" :key="grmTopic.id">
                    <Link :href="'/topics/' + grmTopic.id">
                    <h6 :class="{ 'completed-list-line': isGrmTopicCompleted(grmTopic) }"
                        class="hover:bg-accentColor hover:text-darkestColor p-3">
                        {{ grmTopic.name }}
                    </h6>
                    </Link>
                </li>
            </ul>
        </div>

        <div class="mx-4 md:ml-8 mb-6">
            <h4 class="mx-auto">Vocabulary topics</h4>
            <ul class="solid-border border-2 overflow-y-scroll md:h-96">
                <li v-for="vocabTopic in vocabTopics" :key="vocabTopic.id">
                    <Link :href="'/topics/' + vocabTopic.id">
                    <h6 :class="{ 'completed-list-line': isVocabTopicCompleted(vocabTopic) }"
                        class="hover:bg-accentColor hover:text-darkestColor p-3">{{ vocabTopic.name }}
                    </h6>
                    </Link>
                </li>
            </ul>
        </div>

        <div class="mx-4 md:ml-8 mb-6">
            <h4 class="mx-auto">Extra exercises</h4>
            <ul class="solid-border border-2 overflow-y-scroll md:h-96">
                <li v-for="mixedExercise in mixedExercises" :key="mixedExercise.id">
                    <Link :href="'/mixed-exercise/' + mixedExercise.id">
                    <h6 class="hover:bg-accentColor hover:text-darkestColor p-3">{{ mixedExercise.name
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
        completedTopics: Object,
        mixedExercises: Object,
    },
    computed: {
        isGrmTopicCompleted() {
            return grmTopic => {
                return this.completedTopics.some(completedTopic => completedTopic.id === grmTopic.id);
            }
        },
        isVocabTopicCompleted() {
            return vocabTopic => {
                return this.completedTopics.some(completedTopic => completedTopic.id === vocabTopic.id);;
            }
        },
    },
    layout: FrontendLayout,
}
</script>