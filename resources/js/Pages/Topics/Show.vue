<template>
    <!-- TODO: add exercises in between, add progress bar, add next topic button, change css slides -->
    <div class="mb-10">
        <Head :title="topic.name" />
        <h1 class="head-title mt-10"> {{ topic.name }} </h1>
    </div>
    <div>
        <div class="">
            <Splide :options="splideOptions" aria-label="Topic">
                    <SplideSlide class="mx-10">
                        <div class="m-6 py-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl text-center font-bold tracking-tight text-gray-900 dark:text-white">
                                    Welcome to the lesson on {{ topic.name }}. <br>
                                    Click on the left to start.
                                </h5>                     
                        </div>        
                    </SplideSlide>
                    <SplideSlide class="mx-10">
                        <div class="m-6 py-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl text-center font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ topic.explanation1 }}
                                </h5>                     
                        </div>        
                    </SplideSlide>
                    <SplideSlide v-if="topic.explanation2" class="mx-10">
                        <div class="m-6 py-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl text-center font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ topic.explanation2 }}
                                </h5>                     
                        </div>        
                    </SplideSlide>
                    <SplideSlide v-if="topic.explanation3" class="mx-10">
                        <div class="m-6 py-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl text-center font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ topic.explanation3 }}
                                </h5>                     
                        </div>        
                    </SplideSlide>
                    <SplideSlide v-if="topic.explanation4" class="mx-10">
                        <div class="m-6 py-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl text-center font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ topic.explanation4 }}
                                </h5>                     
                        </div>        
                    </SplideSlide>
                    <SplideSlide v-if="topic.explanation5" class="mx-10">
                        <div class="m-6 py-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl text-center font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ topic.explanation5 }}
                                </h5>                     
                        </div>        
                    </SplideSlide>
            </Splide>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Head, Link } from '@inertiajs/vue3';
    import FrontendLayout from '@/Layouts/FrontendLayout.vue';
    import { Splide, SplideSlide } from '@splidejs/vue-splide';
    import '@splidejs/vue-splide/css';

    export default defineComponent({
    name: 'Topic',
    components: {
        Head, Link, Splide, SplideSlide,
    },
    props: {
        topic: Object,
    },
    setup() {
        const splideOptions = {
            rewind: true,
            perPage: 1,
            width: '100%',
        };  

        return { splideOptions };
    },
    
    layout: FrontendLayout,
    });
</script>