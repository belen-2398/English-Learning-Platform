
<template>
  <div>

    <Head title="Lessons" />
    <div class="flex m-6">
      <h2 class="head-title">Lessons</h2>
    </div>

    <Splide :options="splideOptions" aria-label="Lessons" class="mx-8">
      <SplideSlide>
        <div class="mb-4 ml-6 max-w-md">
          <button @click="openModal('/A1', '/A1-from-0')" type="button" class="block w-full ml-6 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100
                    dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">A1</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Beginner</p>
          </button>
        </div>
      </SplideSlide>
      <SplideSlide>
        <div class="mb-4 max-w-md">
          <button @click="openModal('/A2', '/A2-from-0')" type="button" class="block w-full ml-6 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100
                    dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">A2</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Beginner</p>
          </button>
        </div>
      </SplideSlide>
      <SplideSlide>
        <div class="mb-4 max-w-md">
          <button @click="openModal('/B1', '/B1-from-0')" type="button" class="block w-full ml-6 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100
                    dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">B1</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Intermediate</p>
          </button>
        </div>
      </SplideSlide>
      <SplideSlide>
        <div class="mb-4 max-w-md">
          <button @click="openModal('/B2', '/B2-from-0')" type="button" class="block w-full ml-6 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100
                    dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">B2</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Intermediate</p>
          </button>
        </div>
      </SplideSlide>
      <SplideSlide>
        <div class="mb-4 max-w-md">
          <button @click="openModal('/C1', '/C1-from-0')" type="button" class="block w-full ml-6 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100
                    dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">C1</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Advanced</p>
          </button>
        </div>
      </SplideSlide>
      <SplideSlide>
        <div class="mb-4 mr-6 max-w-md">
          <button @click="openModal('/C2', '/C2-from-0')" type="button" class="block w-full ml-6 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100
                    dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">C2</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Advanced</p>
          </button>
        </div>
      </SplideSlide>
    </Splide>
  </div>
  <LevelOptions :showModal="showModal" :from0Link="from0Link" :chooseTopicLink="chooseTopicLink"
    @closeModal="closeModal" />
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
import LevelOptions from '../Components/LevelOptions.vue';

export default {
  name: 'Lessons',
  components: {
    Head,
    Link,
    Splide,
    SplideSlide,
    LevelOptions
  },
  data() {
    return {
      showModal: false,
      from0Link: '',
      chooseTopicLink: ''
    };
  },
  methods: {
    openModal(chooseTopicRoute, from0Route) {
      this.from0Link = from0Route;
      this.chooseTopicLink = chooseTopicRoute;
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    }
  },
  props: {
    lessons: Array,
  },
  setup() {
    const splideOptions = {
      rewind: true,
      perPage: 4,
      gap: '1rem',
      pagination: false,
      arrows: true
    };

    return { splideOptions };
  },
  layout: FrontendLayout,
}
</script>

