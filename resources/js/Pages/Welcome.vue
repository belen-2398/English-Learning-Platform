<template>
    <div>
        <Head title="Welcome Page" />
        <h1 class="head-title mt-10">Welcome <span v-if="$page.props.auth.user.name"> {{ $page.props.auth.user.name }}</span> </h1>
        <h2 v-if="!$page.props.auth.user" class="head-subtitle mt-6">Check out our <Link class="hover:underline" href="/lessons">lessons</Link> or <Link class="hover:underline" :href="route('login')">login</Link> for full access.</h2>
    </div>
            <Splide :options="{ rewind: true }" aria-label="English Levels">
                    <SplideSlide v-for="slider in sliders" :key="slider.id">
                        <img :src="slider.image" :alt="slider.description" />
                    </SplideSlide>
            </Splide>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Head, Link } from '@inertiajs/vue3';
    import FrontendLayout from '@/Layouts/FrontendLayout.vue';
    import { Splide, SplideSlide } from '@splidejs/vue-splide';
    import '@splidejs/vue-splide/css';

    export default defineComponent({
    name: 'Welcome',
    components: {
        Head, Link, Splide, SplideSlide,
    },
    props: {
        sliders: Array,
    },    
    layout: FrontendLayout,
    });
</script>