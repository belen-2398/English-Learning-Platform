<template>
    <Head title="A2" />
    <Lesson :lessons="lessons">
        <template #title>A2 Lessons</template> 
    </Lesson>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import Lesson from '@/Components/Lesson.vue';

export default {
  name: 'A2',
  components: {
    Head, Link, Lesson
  },
  props: {
    lessons: Array,
  },
  layout: FrontendLayout,
}
</script>