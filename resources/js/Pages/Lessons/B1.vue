<template>
    <Head title="B1" />
    <Lesson :lessons="lessons">
        <template #title>B1 Lessons</template> 
    </Lesson>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import Lesson from '@/Components/Lesson.vue';

export default {
  name: 'B1',
  components: {
    Head, Link, Lesson
  },
  props: {
    lessons: Array,
  },
  layout: FrontendLayout,
}
</script>