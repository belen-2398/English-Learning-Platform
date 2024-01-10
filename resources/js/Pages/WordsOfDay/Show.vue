
<template>
    <Head title="Word of the Day" />
    <div class="my-10 short-line w-3/4">
        <h1 class="pt-6 font-bold">
            Word of the day
        </h1>
        <h2 class="py-6 leading-tight md:text-2xl uppercase">
            LEARN A NEW WORD EVERY DAY
        </h2>
    </div>
    <div class="block mb-28 mt-6">
        <div class="bg-mainColor h-3/4 md:w-1/2 mx-auto invisible-border flex-cols relative z-2">
            <div class="justify-center">
                <h4 class="mx-auto font-bold tracking-tight text-2xl border-b-4 py-6 uppercase">{{ wordOfDay.word }}</h4>
            </div>
            <div class="flex items-center flex-col md:flex-row">
                <img class="w-auto rounded h-20 md:h-52 mt-3 md:ml-6 md:border" :src="getImageUrl" :alt="wordOfDay.word">
                <div class="flex flex-col p-4
                leading-normal my-6 border-l pl-6 md:ml-6">
                    <div class="mb-3 -mt-3">
                        <h6>{{ wordOfDay.type }}, {{ wordOfDay.pronunciation }}</h6>
                    </div>
                    <div>
                        <div class="my-2 flex flex-col md:flex-row gap-6 items-center">
                            <h4 class="font-semibold underline justify-left">Definition</h4>
                            <p class="text-justify">{{ wordOfDay.definition }}</p>
                        </div>

                        <div class="my-2 flex flex-col md:flex-row md:border-y border-darkColor py-4 gap-6 items-center">
                            <h4 class="font-semibold mr-4 underline">Examples</h4>
                            <ol class="list-decimal">
                                <template v-for="example in wordOfDay.examples">
                                    <li v-if="example">
                                        <p class="text-justify">{{ example }}</p>
                                    </li>
                                </template>
                            </ol>
                        </div>
                        <div v-if="wordOfDay.audio" class="mt-6 flex flex-col md:flex-row items-center">
                            <h4 class="mb-4 font-semibold underline">Pronunciation</h4>
                            <audio class="mx-auto" :src="getAudioUrl" controls></audio>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="cut-line hidden md:block mx-auto -mt-52 mb-56"></div>
        <div>
            <h2 class="text-lg md:text-2xl pt-16 underline">Words from previous days</h2>
            <Splide :options="splideOptions" aria-label="previousWordsOfDay" class="mx-2 md:mx-6 mt-6">
                <SplideSlide v-for="previousWordOfDay in previousWordsOfDay" :key="previousWordOfDay.id"
                    class="slide2 h-32 md:h-auto">
                    <Link :href="route('user.wordsOfDay.show', { wordOfDay: previousWordOfDay.id })">
                    <h3 class="md:text-xl font-semibold text-center md:m-2 md:py-12 -rotate-90 md:rotate-0 mt-14">
                        {{ previousWordOfDay.word }}
                    </h3>
                    </Link>
                </SplideSlide>
            </Splide>
        </div>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';

export default {
    name: 'WordOfDay',
    components: {
        Head, Link, Splide, SplideSlide,
    },
    props: {
        wordOfDay: Object,
        previousWordsOfDay: Object,
    },
    computed: {
        getImageUrl() {
            const imagePath = `../${this.wordOfDay.image}`;
            return imagePath;
        },
        getAudioUrl() {
            const audioPath = `../${this.wordOfDay.audio}`;
            return audioPath;
        }
    },
    setup() {
        const splideOptions = {
            rewind: true,
            perPage: 4,
            gap: '1rem',
            arrows: false,
            pagination: false
        };

        return { splideOptions };
    },
    layout: FrontendLayout,
};
</script>