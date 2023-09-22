<template>
    <div v-if="showModal" class="fixed inset-0 w-full h-full bg-gray-900 opacity-70 z-10" @click.self="closeModal"></div>
    <!-- <div v-if="showModal" class="fixed inset-0 w-full h-full z-15" @click.self="closeModal"></div> -->
    <div v-if="showModal" id="popup-modal" tabindex="-1" class="fixed inset-0 flex items-center justify-center z-20">
        <div class="flex">
            <button data-modal-hide="popup-modal" type="button" @click="closeModal"
                class="text-white text-sm border rounded-full h-6 w-6 font-medium hover:text-gray-900 focus:z-10 -mt-8">
                X
            </button>
            <div class="pb-5 text-center flex">
                <Link :href="chooseLessonLink" data-modal-hide="popup-modal"
                    class="bg-[var(--color-medium2)] hover:bg-[var(--color-light)] font-medium text-xl rounded-lg inline-flex items-center p-16 text-center ml-auto mr-5">
                Choose a lesson
                </Link>
                <Link :href="from0Link" data-modal-hide="popup-modal"
                    class="bg-[var(--color-medium2)] hover:bg-[var(--color-light)] font-medium text-xl rounded-lg inline-flex items-center p-16 text-center mr-auto">
                Start level from 0
                </Link>
            </div>
        </div>
    </div>
</template>
  
<script>
import { Link } from '@inertiajs/vue3';

// TODO: click outside to close isn't working
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