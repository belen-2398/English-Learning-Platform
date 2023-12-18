<template>
    <div>
        <Head title="Welcome Page" />
        <section class="mx-6 md:my-52" id="title">
            <h1 class="font-bold pb-2">Welcome <span v-if="$page.props.auth.user"> {{
                $page.props.auth.user.name
            }}</span>
            </h1>
            <h2 v-if="!$page.props.auth.user" class="md:pb-14">CHECK OUT OUR
                <Link class="hover-underline text-xl bg-lighterColor hover:bg-transparent rounded p-1" href="/lessons">LESSONS</Link> OR
                <Link class="hover-underline text-xl bg-lighterColor hover:bg-transparent rounded p-1" :href="route('login')">LOGIN</Link> FOR FULL ACCESS.
            </h2>
            <h2 v-else class="pb-6 text-2xl">
                START LEARNING
            </h2>
            <button @click="scrollToSection('slides')" class="hidden md:block scroll-button mx-auto md:mb-20">
                <svg class="down-arrow-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path fill="currentColor"
                        d="M49.5 206.1l141.1 141.1c4.7 4.7 12.3 4.7 17 0l141.1-141.1c9.4-9.4 2.7-25.4-10.6-25.4H60.1c-13.3 0-20 16-10.6 25.4z" />
                </svg>
            </button>
        </section>
    </div>
    <!-- TODO: everywhere: fix links/btns outside so that you can click directly on the component and get redirected -->
    <!-- TODO: everywhere: fix layout in different screen sizes, add dark mode -->
    <!-- TODO: in blade, add teacher's part -->
    <section id="slides" class="flex-col">
        <button class="hidden md:block scroll-button mx-auto" @click="scrollToTop()">
            <svg class="up-arrow-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path fill="currentColor"
                    d="M49.5 305.9L190.6 164.8c4.7-4.7 12.3-4.7 17 0l141.1 141.1c9.4 9.4 2.7 25.4-10.6 25.4H60.1c-13.3 0-20-16-10.6-25.4z" />
            </svg>
        </button>
        <div class="my-12 md:my-8">
            <div>
                <Splide :options="splideOptions" aria-label="English Levels">
                    <SplideSlide>
                        <div class="slide1 ml-16 md:ml-24">
                            <div class="my-auto">
                                <button button @click="openModal('A1')" type="button">
                                    <h2 class="text-4xl md:text-7xl">A1</h2>
                                    <p>Beginner</p>
                                </button>
                            </div>
                        </div>
                    </SplideSlide>
                    <SplideSlide>
                        <div class="slide1 mr-16 md:ml-8">
                            <div class="my-auto">
                                <button button @click="openModal('A2')" type="button">
                                    <h2 class="text-4xl md:text-7xl">A2</h2>
                                    <p>Beginner</p>
                                </button>
                            </div>
                        </div>
                    </SplideSlide>
                    <SplideSlide>
                        <div class="slide1 ml-16 md:ml-24">
                            <div class="my-auto">
                                <button button @click="openModal('B1')" type="button">
                                    <h2 class="text-4xl md:text-7xl">B1</h2>
                                    <p>Intermediate</p>
                                </button>
                            </div>
                        </div>
                    </SplideSlide>
                    <SplideSlide>
                        <div class="slide1 mr-16 md:ml-8">
                            <div class="my-auto">
                                <button button @click="openModal('B2')" type="button">
                                    <h2 class="text-4xl md:text-7xl">B2</h2>
                                    <p>Intermediate</p>
                                </button>
                            </div>
                        </div>
                    </SplideSlide>
                    <SplideSlide>
                        <div class="slide1 ml-16 md:ml-24">
                            <div class="my-auto">
                                <button button @click="openModal('C1')" type="button">
                                    <h2 class="text-4xl md:text-7xl">C1</h2>
                                    <p>Advanced</p>
                                </button>
                            </div>
                        </div>
                    </SplideSlide>
                    <SplideSlide>
                        <div class="slide1 mr-16 md:ml-8">
                            <div class="my-auto">
                                <button button @click="openModal('C2')" type="button">
                                    <h2 class="text-4xl md:text-7xl">C2</h2>
                                    <p>Advanced</p>
                                </button>
                            </div>
                        </div>
                    </SplideSlide>
                </Splide>
            </div>
            <div>
                <Splide :options="splideTwoOptions" aria-label="Topics" class="mx-6">
                    <SplideSlide v-for="topic in topics" :key="topic.id">
                        <div class="slide2 mt-6 md:mx-2 p-4 md:py-20">
                            <Link :href="route('user.topics.show', { topic: topic.id })" class="block">
                            <h3 class="-rotate-90 mt-16 md:rotate-0 md:mt-0 md:text-2xl font-bold text-center">
                                {{ topic.name }}
                            </h3>
                            </Link>
                        </div>
                    </SplideSlide>
                </Splide>
            </div>
        </div>
            <button @click="scrollToBottom()" class="hidden md:block scroll-button mx-auto">
                <svg class="down-arrow-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path fill="currentColor"
                        d="M49.5 206.1l141.1 141.1c4.7 4.7 12.3 4.7 17 0l141.1-141.1c9.4-9.4 2.7-25.4-10.6-25.4H60.1c-13.3 0-20 16-10.6 25.4z" />
                </svg>
            </button>
    </section>

    <section id="wordOfDay" class="md:my-56 flex-cols">
        <button class="hidden md:block scroll-button mx-auto" @click="scrollToTop()">
            <svg class="up-arrow-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path fill="currentColor"
                    d="M49.5 305.9L190.6 164.8c4.7-4.7 12.3-4.7 17 0l141.1 141.1c9.4 9.4 2.7 25.4-10.6 25.4H60.1c-13.3 0-20-16-10.6-25.4z" />
            </svg>
        </button>
        <div class="block mb-10 md:mb-28 md:mt-6">
            <div v-if="wordOfDay">
                <div class="small-sign mx-auto invisible-border">
                    <Link :href="route('user.wordsOfDay.show', { wordOfDay: wordOfDay.id })"
                        class="flex flex-row items-center max-w-xl p-2">
                    <img class="w-auto h-20 md:h-52 rounded items-center my-3 mx-3 border" :src="wordOfDay.image"
                        :alt="wordOfDay.word">
                    <div class="flex flex-col my-1 md:p-4 leading-tight md:leading-normal">
                        <h5 class="font-bold tracking-tight underline">Word of the Day</h5>
                        <h6 class="mb-1.5 md:mb-3">{{ wordOfDay.word }}</h6>
                        <p class="text-justify text-sm md:text-lg">{{ wordOfDay.definition }}</p>
                    </div>
                    </Link>
                </div>
                <div class="hidden md:block cut-line mx-auto -mt-32"></div>
            </div>
            <div v-else>
                <div class="no-hover-small-sign mx-auto invisible-border">
                    <div class="flex flex-col items-center my-auto">
                        <h5 class="font-bold md:text-2xl border-b-2 md:border-b-4 border-darkestColor md:border-double">Word of the Day</h5>
                        <p class="md:text-lg text-center text-darkColor mx-2 md:mx-24 my-4">Sorry, we have taken a break for
                            today. <br> Have a look at previous words:</p>
                        <Splide :options="splideWordOptions" aria-label="previousWordsOfDay" class="md:mx-6 md:mt-2">
                            <SplideSlide v-for="previousWordOfDay in previousWordsOfDay" :key="previousWordOfDay.id">
                                <div
                                    class="border-darkColor hover:bg-lightColor border-2 border-dotted hover:border-lightColor md:py-6">
                                    <Link :href="route('user.wordsOfDay.show', { wordOfDay: previousWordOfDay.id })">
                                    <h3 class="md:mb-2 text-darkestColor text-sm md:text-xl font-semibold text-center">
                                        {{ previousWordOfDay.word }}
                                    </h3>
                                    </Link>
                                </div>
                            </SplideSlide>
                        </Splide>
                    </div>
                </div>
                <div class="second-cut-line mx-auto"></div>
            </div>
        </div>
    </section>
    <LevelOptions :showModal="showModal" :chooseLessonLink="chooseLessonLink" :from0Link="from0Link"
        @closeModal="closeModal" />
</template>

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
        // sliders: Array,
        previousWordsOfDay: Array,
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
        scrollToBottom() {
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
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
            gap: '1rem',
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

        const splideWordOptions = {
            rewind: true,
            perPage: 3,
            gap: '1rem',
            arrows: false,
            pagination: false
        };

        return { splideOptions, splideTwoOptions, splideWordOptions };
    },
    layout: FrontendLayout,
});
</script>