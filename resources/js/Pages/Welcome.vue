<template>
    <div class="my-10">

        <Head title="Welcome Page" />
        <section class="my-52" id="title">
            <h1 class="pt-6 font-bold">Welcome <span v-if="$page.props.auth.user"> {{
                $page.props.auth.user.name
            }}</span>
            </h1>
            <h2 v-if="!$page.props.auth.user" class="pb-4">CHECK OUT OUR
                <Link class="hover-underline text-xl" href="/lessons">LESSONS</Link> OR
                <Link class="hover-underline text-xl" :href="route('login')">LOGIN</Link> FOR FULL ACCESS.
            </h2>
            <h2 v-else class="pb-6 text-2xl">
                START LEARNING
            </h2>
            <div class="flex justify-center mb-20">
                <button @click="scrollToSection('slides')" class="scroll-button">
                    <svg class="down-arrow-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path fill="currentColor"
                            d="M49.5 206.1l141.1 141.1c4.7 4.7 12.3 4.7 17 0l141.1-141.1c9.4-9.4 2.7-25.4-10.6-25.4H60.1c-13.3 0-20 16-10.6 25.4z" />
                    </svg>
                </button>
            </div>
        </section>
    </div>
    <!-- TODO: everywhere: fix links/btns outside so that you can click directly on the component and get redirected -->
    <!-- TODO: everywhere: fix layout in different screen sizes, add dark mode -->
    <!-- TODO: profile everything -->
    <!-- TODO: in blade, add teacher's part -->
    <section id="slides" class="flex-col">
        <button class="scroll-button mx-auto mb-4" @click="scrollToTop()">
            <svg class="up-arrow-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path fill="currentColor"
                    d="M49.5 305.9L190.6 164.8c4.7-4.7 12.3-4.7 17 0l141.1 141.1c9.4 9.4 2.7 25.4-10.6 25.4H60.1c-13.3 0-20-16-10.6-25.4z" />
            </svg>
        </button>
        <div>
            <Splide :options="splideOptions" aria-label="English Levels">
                <SplideSlide>
                    <div class="slide1 ml-24">
                        <div class="my-auto">
                            <button button @click="openModal('A1')" type="button">
                                <h2 class="text-7xl">A1</h2>
                                <p>Beginner</p>
                            </button>
                        </div>
                    </div>
                </SplideSlide>
                <SplideSlide>
                    <div class="slide1 ml-8">
                        <div class="my-auto">
                            <button button @click="openModal('A2')" type="button">
                                <h2 class="text-7xl">A2</h2>
                                <p>Beginner</p>
                            </button>
                        </div>
                    </div>
                </SplideSlide>
                <SplideSlide>
                    <div class="slide1 ml-24">
                        <div class="my-auto">
                            <button button @click="openModal('B1')" type="button">
                                <h2 class="text-7xl">B1</h2>
                                <p>Intermediate</p>
                            </button>
                        </div>
                    </div>
                </SplideSlide>
                <SplideSlide>
                    <div class="slide1 ml-8">
                        <div class="my-auto">
                            <button button @click="openModal('B2')" type="button">
                                <h2 class="text-7xl">B2</h2>
                                <p>Intermediate</p>
                            </button>
                        </div>
                    </div>
                </SplideSlide>
                <SplideSlide>
                    <div class="slide1 ml-24">
                        <div class="my-auto">
                            <button button @click="openModal('C1')" type="button">
                                <h2 class="text-7xl">C1</h2>
                                <p>Advanced</p>
                            </button>
                        </div>
                    </div>
                </SplideSlide>
                <SplideSlide>
                    <div class="slide1 ml-8">
                        <div class="my-auto">
                            <button button @click="openModal('C2')" type="button">
                                <h2 class="text-7xl">C2</h2>
                                <p>Advanced</p>
                            </button>
                        </div>
                    </div>
                </SplideSlide>
            </Splide>
        </div>
        <div>
            <Splide :options="splideTwoOptions" aria-label="Topics" class="mx-6 mt-2">
                <SplideSlide v-for="topic in topics" :key="topic.id">
                    <div class="slide2 m-6 py-20">
                        <Link :href="route('user.topics.show', { topic: topic.id })" class="block">
                        <h3 class="mb-2 text-2xl font-bold text-center">
                            {{ topic.name }}
                        </h3>
                        </Link>
                    </div>
                </SplideSlide>
            </Splide>
        </div>

        <div class="flex justify-center">
            <button @click="scrollToSection('wordOfDay')" class="scroll-button mt-2">
                <svg class="down-arrow-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path fill="currentColor"
                        d="M49.5 206.1l141.1 141.1c4.7 4.7 12.3 4.7 17 0l141.1-141.1c9.4-9.4 2.7-25.4-10.6-25.4H60.1c-13.3 0-20 16-10.6 25.4z" />
                </svg>
            </button>
        </div>
    </section>
    <section id="wordOfDay" class="my-56 flex-cols">
        <button class="scroll-button mx-auto" @click="scrollToSection('slides')">
            <svg class="up-arrow-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path fill="currentColor"
                    d="M49.5 305.9L190.6 164.8c4.7-4.7 12.3-4.7 17 0l141.1 141.1c9.4 9.4 2.7 25.4-10.6 25.4H60.1c-13.3 0-20-16-10.6-25.4z" />
            </svg>
        </button>
        <div class="block mb-28 mt-6">
            <div class="small-sign mx-auto invisible-border" v-if="wordOfDay">
                <Link :href="route('user.wordsOfDay.show', { wordOfDay: wordOfDay.id })"
                    class="flex flex-col items-center md:flex-row md:max-w-xl">
                <img class="w-auto rounded items-center my-3 h-52 mx-3 border" :src="wordOfDay.image" :alt="wordOfDay.word">
                <div class="flex flex-col p-4 leading-normal">
                    <h5 class="font-bold tracking-tight underline">Word of the Day</h5>
                    <h6 class="mb-3">{{ wordOfDay.word }}</h6>
                    <p class="text-justify">{{ wordOfDay.definition }}</p>
                </div>
                </Link>
            </div>
            <div class="cut-line mx-auto"></div>
        </div>
    </section>
    <LevelOptions :showModal="showModal" :chooseLessonLink="chooseLessonLink" :from0Link="from0Link"
        @closeModal="closeModal" />
</template>
<!-- TODO: return to top arrow -->

<script>
import { defineComponent } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
import LevelOptions from '../Components/LevelOptions.vue';

export default defineComponent({
    name: 'Welcome',
    components: {
        Head, Link, Splide, SplideSlide, LevelOptions
    },
    props: {
        sliders: Array,
        wordOfDay: Object,
        topics: Array,
    },
    data() {
        return {
            showModal: false,
            from0Link: '',
            chooseLessonLink: ''
        };
    },
    methods: {
        scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                const topOffset = 5;
                const sectionTop = section.offsetTop - topOffset;
                window.scrollTo({ top: sectionTop, behavior: 'smooth' });
            }
        },
        openModal(levelLink) {
            this.from0Link = '/lessons/from0/' + levelLink;
            this.chooseLessonLink = '/lessons/level/' + levelLink;
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        }
    },
    setup() {
        const splideOptions = {
            rewind: true,
            perPage: 2,
            width: '100%',
            pagination: false,
            drag: false,
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