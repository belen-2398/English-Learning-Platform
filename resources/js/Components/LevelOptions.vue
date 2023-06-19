<template>
    <div v-if="showModal" class="fixed inset-0 bg-gray-900 opacity-50 z-50"></div>
    <div v-if="showModal" id="popup-modal" tabindex="-1" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-[calc(1/2*100vw)] w-full">
            <button data-modal-hide="popup-modal" type="button" @click="closeModal"
                class="text-gray-500 text-sm font-medium hover:text-gray-900 focus:z-10 mt-1 ml-2">
                X
            </button>
            <div class="pb-5 text-center flex">
                <Link :href="chooseLessonLink" data-modal-hide="popup-modal"
                    class="slide2 focus:ring-4 font-medium text-xl rounded-lg inline-flex items-center p-16 text-center ml-auto mr-5">
                Choose a lesson
                </Link>
                <Link :href="from0Link" data-modal-hide="popup-modal"
                    class="slide2 focus:ring-4 font-medium text-xl rounded-lg inline-flex items-center p-16 text-center mr-auto">
                Start level from 0
                </Link>
            </div>

        </div>
    </div>
</template>
  
<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        Link
    },
    emits: ["closeModal"],
    props: {
        showModal: Boolean,
        from0Link: String,
        chooseLessonLink: String,
    },
    methods: {
        closeModal() {
            this.$emit('closeModal');
        },
    },
};
</script>