
<!-- TODO: add big click on lessons already done -->
<template>
  <Head title="Lessons" />
  <div class="short-line">
    <h1 class="pt-6 mb-6">Lessons</h1>
    <h2 class="pb-4">SELECT A LESSON BASED ON YOUR LEVEL
    </h2>
  </div>

  <div class="mx-20 mt-20">
    <ul class="solid-border border-2 p-12">
      <li v-for="(lessonsByLevel, level) in lessons" :key="level">
        <div class="level-container">
          <h3 class="bg-[var(--color-lightest)] w-1/2 mx-auto text-center text-4xl">{{ level }}</h3>
          <ul class="grid grid-cols-3 gap-4">
            <li v-for="lesson in lessonsByLevel" :key="lesson.id" class="list-line">
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
    lessonsByLevel: Array,
    level: String,
    topics: Array,
  },
  layout: FrontendLayout,
}
</script>

