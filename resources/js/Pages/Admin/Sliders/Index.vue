 <!-- TODO: Fix css, add edit and delete buttons, finish crud -->
<template>
    <div>
        <Head title="Slider Index" />
        <h1 class="head-title mt-10">Slider Index</h1>
        <li v-for="slider in sliders">
            <h3>{{ slider.title }}</h3>
        </li>
    </div>
    
   
</template>

<script>
    import { Head, Link } from '@inertiajs/vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';

    export default {
    name: 'Slider Index',
    components: {
        Head, Link
    },
    props: {
        sliders: Object,
    },
    layout: AdminLayout,
    }
</script>
