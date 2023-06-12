<template>
    <div class="mb-10">
        <Head title="Welcome Page" />
        <h1 class="head-title mt-10">Welcome <span v-if="$page.props.auth.user"> {{ $page.props.auth.user.name }}</span> </h1>
        <h2 v-if="!$page.props.auth.user" class="head-subtitle mt-6">Check out our <Link class="hover:underline" href="/lessons">lessons</Link> or <Link class="hover:underline" :href="route('login')">login</Link> for full access.</h2>
    </div>
    <div>
        <div>
            <Splide :options="splideOptions" aria-label="English Levels">
                <SplideSlide v-for="slider in sliders" :key="slider.id">
                    <template v-if="slider.link" >
                        <Link :href="slider.link">
                            <!-- Fix links in DB -->
                            <img class="mx-auto justify-center" :src="slider.image" :alt="slider.description" />
                        </Link>
                    </template>
                    <template v-else>
                        <img class="mx-auto justify-center" :src="slider.image" :alt="slider.description" />
                    </template>
                </SplideSlide>
            </Splide>
        </div>
        <div class="mx-auto my-6 justify-center flex" v-if="wordOfDay">
            <Link href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="#" :alt="wordOfDay.word">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Word of the Day</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ wordOfDay.word }}</p>
                </div>
            </Link>
        </div>
    </div>
    <div>
        <Splide :options="splideTwoOptions" aria-label="Topics" class="mx-6">
            <SplideSlide v-for="topic in topics" :key="topic.id">
                <div class="m-6 py-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <Link :href="route('user.topics.show', { topic: topic.id })"
                        class="block">
                        <h5 class="mb-2 text-2xl text-center font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ topic.name }}
                        </h5>                     
                    </Link>
                </div>        
            </SplideSlide>
        </Splide>
    </div>
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
        wordOfDay: Object,
        topics: Array,
    },
    setup() {
        const splideOptions = {
            rewind: true,
            perPage: 1,
            width: '100%',
        };  

        const splideTwoOptions = {
            rewind: true,
            perPage: 5,
            gap: '1rem',
            arrows: false,
            pagination: false
        };

        return { splideOptions, splideTwoOptions };
    },
    
    layout: FrontendLayout,
    });
</script>