<template>
    <div class="flex justify-between items-center my-2 border-b-2 border-darkerColor"
        :style="{ marginLeft: depth * 2 + 'px' }">
        <div class="flex items-center">
            <p class="inline-flex items-center mx-2 text-sm text-darkestColor dark:text-white font-semibold">
                {{ comment.user.name }}
            </p>
            <p class="text-sm text-darkColor dark:text-gray-400">
                {{ formatDate(comment.created_at) }}
            </p>
            <span v-if="isEdited" class="text-xs text-accentColor ml-1">Edited</span>
        </div>
        <div class="relative inline-block text-left">
            <button @click="toggleDropdown"
                class="inline-flex items-center p-2 text-sm font-medium text-center text-darkColor dark:text-gray-400"
                type="button">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 16 3">
                    <path
                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                </svg>
                <span class="sr-only">Reply settings</span>
            </button>

            <div v-if="isDropdownOpen" class="absolute right-0 mt-2 rounded">
                <div>
                    <div v-if="$page.props.auth.user.id === comment.user_id" class="flex-col">
                        <button @click="openEditCommentModal(comment)"
                            class="w-full bg-[var(--color-lightest)] text-left text-xs py-1 px-4 text-[var(--color-darkest)] font-semibold hover:bg-[var(--color-lighter)]">
                            Edit
                        </button>
                        <div class="bg-[var(--color-medium2)] w-full hover:bg-[var(--color-lighter)] pb-1 text-center">
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
    <p class="text-darkColor dark:text-gray-400 mt-3 ml-2">{{ comment.content }}</p>
    <div class="flex items-center mt-4 ml-2 justifty-between gap-8">
        <button type="button" @click="openReplyCommentModal(comment)"
            class=" flex items-center text-sm text-darkColor hover:underline dark:text-gray-400 font-medium">
            <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
            </svg>
            Reply
        </button>
        <button v-if="comment.replies.length" type="button" @click="toggleReplies"
            class="flex items-center text-sm text-darkColor hover:underline dark:text-gray-400 font-medium">
            <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path
                    d="M12 2c-5.49 0-10 4.51-10 10s4.51 10 10 10 10-4.51 10-10-4.51-10-10-10zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-2-8h2a2 2 0 1 0 4 0h2a6 6 0 1 1-12 0zm6-4a1 1 0 1 0-2 0h2z"
                    fill="currentColor"></path>
            </svg>
            {{ showReplies ? 'Hide Replies' : 'See Replies' }}
        </button>
    </div>
    <div v-if="showReplies && comment.replies.length"
        class="p-3 border-l-2 dark:bg-darkestColor justify-center mx-2 mt-4">
        <div v-for="(reply, replyIndex) in comment.replies" :key="reply.id">
            <NestedReply :comment="reply" :depth="depth + 0.2" />
        </div>
    </div>
    <Edit v-if="showEditCommentModal" :comment="editComment" :showModal="showEditCommentModal"
        @closeModal="closeEditCommentModal" />
    <Reply v-if="showReplyCommentModal" :comment="replyComment" :showModal="showReplyCommentModal"
        @closeModal="closeReplyCommentModal" />
</template>


<script>
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
        comment: Object,
        depth: Number,
    },
    data() {
        return {
            formUrl: '/comments',
            isDropdownOpen: false,
            editComment: null,
            showEditCommentModal: false,
            showReplyCommentModal: false,
            showReplies: [],
        };
    },
    computed: {
        isEdited() {
            return this.comment.created_at !== this.comment.updated_at;
        },
    },
    methods: {
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
            this.replyComment = null;
        },
    }
};
</script>