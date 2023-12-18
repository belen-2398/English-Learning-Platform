<template>
  <Head title="Lessons" />
  <div class="short-line">
    <h1 class="pt-6 font-bold">Lessons</h1>
    <h2 class="mx-2 text-sm md:text-xl pb-4 uppercase">CHOOSE A LESSON</h2>
  </div>

  <div class="mx-4 md:mx-20 my-10 md:mt-20">
    <ul class="solid-border border-2 p-6 md:p-12">
      <li v-for="(lessonsByLevel, level) in lessons" :key="level">
        <div class="mb-6">
          <h3
            class="mx-10 md:mx-60 border-b-2 border-accentColor pb-2 text-center text-4xl md:text-6xl text-accentColor">
            {{ level }}</h3>
          <ul class="grid md:grid-cols-3 md:gap-4">
            <li v-for="lesson in lessonsByLevel" :key="lesson.id" class="list-line"
              :class="{ 'completed-list-line': lesson.isCompleted }">
              <Link :href="'/lessons/' + lesson.id">
              <h4 class="text-lg md:text-xl mb-2 underline">
                {{ lesson.name }}
              </h4>
              <p class="font-small text-justify">
                {{ lesson.description }}
              </p>
              </Link>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';

export default {
  name: 'Lessons',
  components: {
    Head,
    Link,
  },
  props: {
    lessons: Object,
  },
  layout: FrontendLayout,
}
</script>

