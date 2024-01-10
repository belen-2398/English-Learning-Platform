<template>
    <div>
        <Head title="Comment Show" />
        <!-- TODO: change link of report to send message to admin, see replies toggles all buttons -->

        <div class="p-4 text-base bg-lighterColor rounded-lg dark:bg-gray-900 justify-center mx-4 mb-3">
            <div class="flex justify-between items-center mb-2 mt-5 border-b-2 border-darkerColor">
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
                    <button @click="toggleDropdown"
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400"
                        type="button">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 16 3">
                            <path
                                d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                        </svg>
                        <span class="sr-only">Comment settings</span>
                    </button>
                    <div v-if="isDropdownOpen" class="absolute right-0 mt-2 rounded">
                        <div>
                            <div v-if="$page.props.auth.user.id === comment.user_id" class="flex-col">
                                <button @click="openEditCommentModal(comment)"
                                    class="w-full bg-bgColor text-left text-xs py-1 px-4 text-darkestColor font-semibold hover:bg-lighterColor">
                                    Edit
                                </button>
                                <div
                                    class="bg-accentColor w-full hover:bg-lighterColor pb-1 text-center">
                                    <Remove :objectId="comment.id" :formUrl="formUrl"></Remove>
                                </div>
                            </div>
                            <div v-else>
                                <div>
                                    <a @click="reportComment(comment)"
                                        class="bg-accentColor w-full hover:bg-lighterColor py-1 px-4 font-semibold text-sm">Report</a>
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
                <button v-if="comment.replies.length" type="button" @click="toggleReplies"
                    class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                    <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c-5.49 0-10 4.51-10 10s4.51 10 10 10 10-4.51 10-10-4.51-10-10-10zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-2-8h2a2 2 0 1 0 4 0h2a6 6 0 1 1-12 0zm6-4a1 1 0 1 0-2 0h2z"
                            fill="currentColor"></path>
                    </svg>
                    {{ showReplies ? 'Hide Replies' : 'See Replies' }}
                </button>
            </div>
            <div v-if="showReplies" class="my-3">
                <div v-for="(reply, replyIndex) in comment.replies" :key="'R' + replyIndex"
                    class="bg-white p-2 rounded-lg dark:bg-gray-900 justify-center mx-2 my-4">
                    <NestedReply :comment="reply" :depth="depth + 0.2" />
                </div>
            </div>
        </div>
        <Edit v-if="showEditCommentModal" :comment="editComment" :showModal="showEditCommentModal"
            @closeModal="closeEditCommentModal" />
        <Reply v-if="showReplyCommentModal" :comment="replyComment" :showModal="showReplyCommentModal"
            @closeModal="closeReplyCommentModal" />
    </div>
</template>
  
<script>
import { Head } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import Remove from '../../Components/Remove.vue';
import Edit from '../../Components/Modals/Comments/Edit.vue';
import Reply from '../../Components/Modals/Comments/Reply.vue';

export default {
    name: 'CommentShow',
    layout: FrontendLayout,
    components: {
        Remove,
        Edit,
        Reply,
    },
    props: {
        comment: Object,
    },
    data() {
        return {
            formUrl: '/comments',
            isDropdownOpen: false,
            editComment: null,
            showEditCommentModal: false,
            showReplyCommentModal: false,
            showReplies: [],
            depth: 0,
        };
    },
    methods: {
        isEdited(comment) {
            return comment.created_at !== comment.updated_at;
        },
        formatDate(date) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' }
            return new Date(date).toLocaleDateString('en', options)
        },
        toggleDropdown() {
            this.isDropdownOpen = !this.isDropdownOpen;
        },
        toggleReplies() {
            this.showReplies = !this.showReplies;
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
        }
    }
};
</script>