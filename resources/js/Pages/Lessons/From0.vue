<template>
  <!-- TODO: do lesson.completed -->
  <!-- TODO: show progress bar -->

  <Head :title="`${level}-From-0`" />
  <div class="short-line">
    <h1 class="pt-6 mb-6">{{ level }} From 0</h1>
    <h2 class="pb-6 text-xl">CLICK ON
      <Link class="color-button text-xl mx-auto mb-6" :href="'/topics/' + firstTopicId">START</Link>
    </h2>
  </div>
  <div class="mt-8 flex flex-col">
    <div class="columns-4 mb-6">
      <ol class="flex" v-for="lesson in lessons" :key="lesson.id">
        <li class="relative w-1 mx-20">
          <div class="inline-flex items-top">
            <template v-if="lesson.completed">
              <div class="flex items-top circle-connect">
                <div class="z-10 flex items-center justify-center w-6 h-6
                  bg-[var(--color-medium1)] rounded-full ring-0 ring-white shrink-0">
                  <svg aria-hidden="true" class="w-4 h-4 text-[var(--color-lightest)]" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                      clip-rule="evenodd"></path>
                  </svg>
                </div>
              </div>
            </template>
            <template v-else>
              <div class="flex items-top circle-connect">
                <div class="z-10 flex items-center justify-center w-6 h-6
                  bg-[var(--color-lighter)] rounded-full ring-4 ring-white shrink-0">
                  <svg aria-hidden="true" class="w-4 h-4 text-[var(--color-darker)]" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                    <path fill-rule="evenodd"
                      d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                      clip-rule="evenodd"></path>
                  </svg>
                </div>
              </div>
            </template>
            <div>
              <h3 class="ml-2 text-xl mb-2 text-[var(--color-darkest)]">{{ lesson.name }}</h3>
              <div>
                <h6 class="ml-6" v-for="topic in lesson.topics" :key="topic.id">{{ topic.name }}</h6>
              </div>
            </div>
          </div>
        </li>
      </ol>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';

export default {
  name: 'A1from0',
  components: {
    Head, Link,
  },
  props: {
    lessons: Array,
    level: String,
    topics: Array,
    firstTopicId: Number,
  },
  layout: FrontendLayout,
}
</script>