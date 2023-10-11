<template class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
    <div class="ml-6 px-4">
        <div class="flex mb-6">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Comments ({{ commentsCount }})</h2>
        </div>
        <form class="mb-6" @submit.prevent="form.post(`/comments-store/${topicId}`, {
            onSuccess: () => {
                form.reset();
            },
        })">
            <div class="">
                <label for="comment" class="sr-only">Leave a comment or question.</label>
                <textarea v-model="form.content" rows="4"
                    class="py-2 px-4 mb-4 ml-10 w-3/4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700"
                    placeholder="Write a comment or question..." required></textarea>
            </div>
            <button type="submit"
                class="inline-flex items-center ml-10 py-2.5 px-4 text-xs font-semibold text-center hover:underline bg-[var(--color-medium2)] rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800"
                :disabled="form.processing">
                Post comment
            </button>
        </form>
    </div>

    <!-- TODO: change link of report (comment and reply) to send message to admin -->

    <div v-for="(comment, index) in comments">
        <div class="p-4 text-base bg-[var(--color-lighter)] rounded-lg dark:bg-gray-900 w-3/4 justify-center mx-auto my-3">
            <div class="flex justify-between items-center mb-2 border-b-2 border-[var(--color-darker)]">
                <div class="flex items-center">
                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                        {{ comment.user.name }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ formatDate(comment.created_at) }}
                    </p>
                    <span v-if="isEdited(comment)" class="text-xs text-red-500 ml-1">Edited</span>
                </div>
                <div class="relative inline-block text-left">
                    <button @click="toggleDropdown(index)"
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400"
                        type="button">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 16 3">
                            <path
                                d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                        </svg>
                        <span class="sr-only">Comment settings</span>
                    </button>
                    <!-- Dropdown menu -->
                    <div v-if="isDropdownOpen[index]" class="absolute right-0 mt-2 rounded">
                        <div>
                            <div v-if="$page.props.auth.user.id === comment.user_id" class="flex-col">
                                <button @click="openEditCommentModal(comment)"
                                    class="w-full bg-[var(--color-lightest)] text-left text-xs py-1 px-4 text-[var(--color-darkest)] font-semibold hover:bg-[var(--color-lighter)]">
                                    Edit
                                </button>
                                <div
                                    class="bg-[var(--color-medium2)] w-full hover:bg-[var(--color-lighter)] pb-1 text-center">
                                    <Remove :objectId="comment.id" :formUrl="formUrl"></Remove>
                                </div>
                            </div>
                            <div v-else>
                                <div>
                                    <a @click="reportComment(comment)"
                                        class="bg-[var(--color-medium2)] w-full hover:bg-[var(--color-lighter)] py-1 px-4 font-semibold text-sm">Report</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-gray-600 dark:text-gray-400 mt-3">{{ comment.content }}</p>
            <div class="flex items-center mt-4 justifty-between gap-8">
                <button type="button" @click="openReplyCommentModal(comment)"
                    class=" flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                    <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                    </svg>
                    Reply
                </button>
                <button v-if="comment.replies.length" type="button" @click="toggleReplies(index)"
                    class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                    <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c-5.49 0-10 4.51-10 10s4.51 10 10 10 10-4.51 10-10-4.51-10-10-10zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-2-8h2a2 2 0 1 0 4 0h2a6 6 0 1 1-12 0zm6-4a1 1 0 1 0-2 0h2z"
                            fill="currentColor"></path>
                    </svg>
                    {{ showReplies[index] ? 'Hide Replies' : 'See Replies' }}
                </button>
            </div>
            <div v-if="showReplies[index]" class="my-6">
                <div v-for="(reply, replyIndex) in comment.replies" :key="'R' + replyIndex"
                    class="bg-white p-4 rounded-lg dark:bg-gray-900 w-3/4 justify-center mx-auto my-4">
                    <NestedReply :comment="reply" :depth="depth + 0.2" />
                </div>
            </div>
        </div>
    </div>
    <Edit v-if="showEditCommentModal" :comment="editComment" :showModal="showEditCommentModal"
        @closeModal="closeEditCommentModal" />
    <Reply v-if="showReplyCommentModal" :comment="replyComment" :showModal="showReplyCommentModal"
        @closeModal="closeReplyCommentModal" />
</template>


<script>
import { useForm } from '@inertiajs/vue3';
import Remove from '../../Remove.vue';
import Edit from './Edit.vue';
import Reply from './Reply.vue';

export default {
    components: {
        Remove,
        Edit,
        Reply,
    },
    props: {
        comments: Object,
        commentsCount: Number,
        repliesCount: Number,
        topicId: Number,
    },
    data() {
        return {
            formUrl: '/comments',
            isDropdownOpen: new Array(this.comments.length).fill(false),
            editComment: null,
            showEditCommentModal: false,
            showReplyCommentModal: false,
            showReplies: [],
            depth: 0,
        };
    },
    setup() {
        const form = useForm({
            content: '',
        });
        return { form };
    },
    methods: {
        isEdited(comment) {
            return comment.created_at !== comment.updated_at;
        },
        formatDate(date) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' }
            return new Date(date).toLocaleDateString('en', options)
        },
        toggleDropdown(index) {
            this.isDropdownOpen[index] = !this.isDropdownOpen[index];
        },
        toggleReplies(index) {
            this.showReplies[index] = !this.showReplies[index];
        },
        openEditCommentModal(comment) {
            this.editComment = comment;
            this.showEditCommentModal = true;
        },
        closeEditCommentModal() {
            this.showEditCommentModal = false;
            this.editComment = null;
        },
        openReplyCommentModal(comment) {
            this.replyComment = comment;
            this.showReplyCommentModal = true;
        },
        closeReplyCommentModal() {
            this.showReplyCommentModal = false;
            this.ReplyComment = null;
        },
    }
};
</script>