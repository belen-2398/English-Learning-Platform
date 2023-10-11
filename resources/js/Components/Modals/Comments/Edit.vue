<template>
    <div>
        <div class="fixed inset-0 bg-gray-900 opacity-50 z-50" v-if="showModal"></div>
        <div id="popup-modal" tabindex="-1" class="fixed inset-0 flex items-center justify-center z-50 my-auto"
            v-if="showModal">
            <div class="bg-[var(--color-lightest)] max-w-2/3">
                <div class="flex justify-between bg-[var(--color-medium1)]">
                    <h2 class="m-6 text-xl">Edit comment</h2>
                    <button type="button" class="m-2 mr-4 -mt-6 text-[var(--color-darker)] hover:underline"
                        @click="closeModal">X</button>
                </div>
                <div class="p-6 max-h-2/3 overflow-y-scroll">
                    <form @submit.prevent="form.put('/comments/' + comment.id, {
                        onSuccess: () => {
                            this.closeModal();
                        },
                    })">
                        <div
                            class="p-4 text-base bg-[var(--color-lighter)] rounded-lg dark:bg-gray-900 justify-center mx-auto my-3">
                            <label class="sr-only" for="content">
                                Content
                            </label>
                            <textarea v-model="form.content" rows="6"
                                class="text-gray-600 dark:text-gray-400 mt-3"></textarea>
                            <div v-if="form.errors.content">{{ form.errors.content }}</div>
                        </div>
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                            {{ form.progress.percentage }}%
                        </progress>
                        <div class="flex justify-center">
                            <button type="submit" class="hover:underline bg-[var(--color-medium2)] p-2 mt-2 mx-auto"
                                :disabled="form.processing">
                                Save
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import { useForm } from '@inertiajs/vue3';

export default {
    name: 'EditCommentModal',
    props: {
        showModal: Boolean,
        comment: Object,
    },
    setup(props) {
        const defaultComment = {
            content: '',
        };

        const commentWithDefaults = {
            ...defaultComment,
            ...props.comment,
        };

        const form = useForm(
            commentWithDefaults
        );

        return { form };
    },

    methods: {
        closeModal() {
            this.$emit('closeModal');
        }
    },
};
</script>