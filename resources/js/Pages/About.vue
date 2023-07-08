
<template>
  <!-- TODO: everything -->
  <div>

    <Head title="About" />

    <h1 class="pt-6 font-bold">About us</h1>
    <h2 class="pb-4 uppercase">Information and links about us</h2>

    <div style="margin-top: 800px">
      <p>The current time is {{ time }}.</p>

    </div>

  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';

export default {
  name: 'About',
  components: {
    Head,
    Link
  },
  layout: FrontendLayout,
  props: { time: String }
}
</script>