<template>
  <Head :title="`${level}-Lessons`" />
  <div class="short-line">
    <h1 class="pt-6 md:mb-4 font-bold">{{ level }} Lessons</h1>
    <h2 class="mx-2 text-sm md:text-xl pb-4 uppercase">CHOOSE A LESSON
    </h2>
  </div>

  <div class="mx-4 md:mx-20 my-10 md:mt-20">
    <ul class="solid-border border-2 p-6 md:p-12 grid md:grid-cols-3 gap-2 md:gap-4">
      <li v-for="lesson in lessons" :key="lesson.id" class="hover:bg-accentColor p-4"
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

