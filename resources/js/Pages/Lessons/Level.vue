<template>
  <Head :title="`${level}-Lessons`" />
  <div class="short-line">
    <h1 class="pt-6 mb-8">{{ level }} Lessons</h1>
    <h2 class="pb-6 text-xl">SELECT A LESSON
    </h2>
  </div>

  <div class="mx-20 mt-20">
    <ul class="solid-border border-2 p-12 grid grid-cols-3 gap-4">
      <li v-for="lesson in lessons" :key="lesson.id" class="hover:bg-[var(--color-medium2)] p-4"
        :class="{ 'completed-list-line': lesson.isCompleted }">
        <Link :href="'/lessons/' + lesson.id">
        <h4 class="font-small underline text-xl mb-2">
          {{ lesson.name }}
        </h4>
        <p class="font-small text-justify">
          {{ lesson.description }}
        </p>
        </Link>
      </li>
    </ul>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';

export default {
  name: 'LessonLevel',
  components: {
    Head,
    Link,
  },
  props: {
    lessons: Object,
    level: String,
    topics: Array,
  },
  layout: FrontendLayout,
}
</script>

