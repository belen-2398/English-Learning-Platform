
<template>
  <div>
    <!-- TODO: eveything -->

    <Head title="Dictionary" />
    <div class="short-line">
      <h1 class="pt-6 mb-4">Dictionary</h1>
      <h2>All the words you have added to your personal dictionary.</h2>
    </div>
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';

export default {
  name: 'Dictionary',
  components: {
    Head,
  },
  layout: FrontendLayout,
}
</script>