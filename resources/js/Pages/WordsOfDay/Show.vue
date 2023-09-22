
<template>
    <Head title="Word of the Day" />
    <div class="my-10">
        <h1 class="pt-6 font-bold">
            Word of the day
        </h1>
        <h2 class="pb-6 text-2xl">
            LEARN A NEW WORD EVERY DAY
        </h2>
    </div>
    <div class="block mb-28 mt-6">
        <div class="bg-[var(--color-medium1)] h-3/4 w-1/2 mx-auto invisible-border flex-cols relative z-2">
            <div class="flex-cols justify-center">
                <h4 class="mx-auto font-bold tracking-tight text-2xl border-b-4 py-6 uppercase">{{ wordOfDay.word }}</h4>
            </div>
            <div class="flex items-center flex-row">
                <img class="w-auto rounded h-52 mt-3 ml-6 border" :src="getImageUrl" :alt="wordOfDay.word">
                <div class="flex flex-col p-4 leading-normal my-6 border-l pl-6 ml-6">
                    <div class="mb-3 -mt-3">
                        <h6>{{ wordOfDay.type }}, {{ wordOfDay.pronunciation }}</h6>
                    </div>
                    <div>
                        <div class="my-2 flex gap-6 items-center">
                            <h4 class="font-semibold underline">Definition</h4>
                            <p class="text-justify">{{ wordOfDay.definition }}</p>
                        </div>

                        <div class="my-2 flex border-y border-[var(--color-dark)] py-4 gap-6 items-center">
                            <h4 class="font-semibold mr-4 underline">Examples</h4>
                            <ul>
                                <div v-for="example in wordOfDay.examples">
                                    <p class="text-justify">{{ example }}</p>
                                </div>
                            </ul>
                        </div>
                        <div v-if="wordOfDay.audio" class="mt-6 flex items-center">
                            <h4 class="mb-4 font-semibold underline">Pronunciation</h4>
                            <audio class="mx-auto" :src="getAudioUrl" controls></audio>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="cut-line mx-auto -mt-52 mb-56"></div>
        <div>
            <h2 class="text-2xl pt-16 underline">Words from previous days</h2>
            <Splide :options="splideOptions" aria-label="previousWordsOfDay" class="mx-6 mt-6">
                <SplideSlide v-for="previousWordOfDay in previousWordsOfDay" :key="previousWordOfDay.id">
                    <div class="slide2 m-2 py-12">
                        <Link :href="route('user.wordsOfDay.show', { wordOfDay: previousWordOfDay.id })" class="block">
                        <h3 class="mb-2 text-xl font-semibold text-center">
                            {{ previousWordOfDay.word }}
                        </h3>
                        </Link>
                    </div>
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
            perPage: 5,
            gap: '1rem',
            arrows: false,
            pagination: false
        };

        return { splideOptions };
    },
    layout: FrontendLayout,
};
</script>