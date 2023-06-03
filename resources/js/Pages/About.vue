
<template>
    <div>
        <Head title="About" />
        <h1>About.</h1>

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