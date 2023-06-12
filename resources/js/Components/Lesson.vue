<template>
  <div>
    <div class="flex justify-between m-6">
      <h2 class="head-title" id="head-title">
        <slot name="title" />
      </h2>
      <Link href="/lessons">Back</Link>
    </div>
    <div class="flex">
      <template v-for="lesson in lessons" :key="lesson.id">
        <div>
          <!-- Fix ID -->
          <Link :href="route('user.lessons.show', { lesson: lesson.id })"
            class="block max-w-sm ml-6 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ lesson.name }}</h5>
          <p class="font-normal text-gray-700 dark:text-gray-400">{{ lesson.description }}</p>
          </Link>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';

export default {
  name: 'Lesson',
  components: {
    Link
  },
  props: {
    lessons: Array,
  },
  layout: FrontendLayout,

}
</script>