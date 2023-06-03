
<template>
    <div>
        <Head title="Dictionary" />
        <h1>Dictionary.</h1>
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