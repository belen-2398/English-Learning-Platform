<template>
  <Head title="Lessons" />
  <div class="short-line">
    <h1 class="pt-6 mb-6">Lessons</h1>
    <h2 class="pb-4 uppercase">SELECT A LESSON BASED ON YOUR LEVEL
    </h2>
  </div>

  <div class="mx-20 mt-20">
    <ul class="solid-border border-2 p-12">
      <li v-for="(lessonsByLevel, level) in lessons" :key="level">
        <div class="level-container mb-6">
          <h3
            class="mx-60 border-b-2 border-[var(--color-medium2)] pb-2 text-center text-6xl text-[var(--color-medium2)]">
            {{ level }}</h3>
          <ul class="grid grid-cols-3 gap-4">
            <li v-for="lesson in lessonsByLevel" :key="lesson.id" class="list-line"
              :class="{ 'completed-list-line': lesson.isCompleted }">
              <Link :href="'/lessons/' + lesson.id">
              <h4 class="text-xl mb-2 underline">
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

