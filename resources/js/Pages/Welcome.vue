
<template>
    <div>
        <Head title="Welcome Page" />
        <h1 class="head-title mt-10">Welcome</h1>
        <h2 class="head-subtitle mt-6">Check out our <Link class="hover:underline" href="/lessons">lessons</Link> or <Link class="hover:underline" :href="route('login')">login</Link> for full access.</h2>
    </div>
  
</template>

<script>
    import { Head, Link } from '@inertiajs/vue3';
    import FrontendLayout from '@/Layouts/FrontendLayout.vue';


    export default {
    name: 'Welcome',
    components: {
        Head, Link
    },
    
    layout: FrontendLayout,
    }
</script>
