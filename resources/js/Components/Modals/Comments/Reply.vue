<template>
    <div>
        <div class="fixed inset-0 bg-gray-900 opacity-50 z-50" v-if="showModal"></div>
        <div id="popup-modal" tabindex="-1" class="fixed inset-0 flex items-center justify-center z-50 my-auto"
            v-if="showModal">
            <div class="bg-[var(--color-lightest)] max-w-2/3">
                <div class="flex justify-between bg-[var(--color-medium1)]">
                    <h2 class="m-6 text-xl">Reply</h2>
                    <button type="button" class="m-2 mr-4 -mt-6 text-[var(--color-darker)] hover:underline"
                        @click="closeModal">X</button>
                </div>
                <div class="p-6 max-h-2/3 overflow-y-scroll">
                    <form class="mb-6" @submit.prevent="form.post(`/replies-store/${commentId}`, {
                        onSuccess: () => {
                            closeModal();
                        },
                    })">
                        <div class="">
                            <label for="content" class="sr-only">Leave a reply.</label>
                            <textarea v-model="form.content" rows="4"
                                class="py-2 px-4 mb-4 ml-10 w-3/4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700"
                                placeholder="Write a reply..." required></textarea>
                        </div>
                        <button type="submit"
                            class="inline-flex items-center ml-10 py-2.5 px-4 text-xs font-semibold text-center hover:underline bg-[var(--color-medium2)] rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800"
                            :disabled="form.processing">
                            Post reply
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import { useForm } from '@inertiajs/vue3';

export default {
    name: 'ReplyCommentModal',
    props: {
        showModal: Boolean,
        comment: Object,
    },
    data() {
        return {
            commentId: this.comment.id,
        };
    },
    setup() {
        const form = useForm({
            content: '',
        });
        return { form };
    },

    methods: {
        closeModal() {
            this.$emit('closeModal');
        }
    },
};
</script>