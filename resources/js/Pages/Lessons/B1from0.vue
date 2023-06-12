<template>
    <Head title="B1" />
    
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';

export default {
  name: 'B1from0',
  components: {
    Head, Link, 
  },
  props: {
    lessons: Array,
  },
  layout: FrontendLayout,
}
</script>