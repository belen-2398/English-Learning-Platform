<template>
    <Head title="A1" />
    <Lesson :lessons="lessons">
        <template #title>A1 Lessons</template> 
    </Lesson>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import Lesson from '@/Components/Lesson.vue';

export default {
  name: 'A1',
  components: {
    Head, Link, Lesson
  },
  props: {
    lessons: Array,
  },
  layout: FrontendLayout,
}
</script>