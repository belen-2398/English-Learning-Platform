<template>
    <div class="flex justify-between">
        <a target="_blank" :href="route('comments.show', notification.data.comment.id)"
            class="hover:underline text-left mx-2 text-sm text-darkColor py-2">
            {{ notification.data.message }}
        </a>
        <div class="text-darkColor text-xs justify-right flex-row w-1/4">
            <span class="text-mainColor">{{ formatDate(notification.created_at) }}</span>
            <br>
            <button @click="markNotificationAsRead(notification.id)">
                <font-awesome-icon icon="fa-solid fa-eye" class="hover:text-accentColor ml-2 pt-1" />
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'UnreadNotifications',
    emits: ['markAsRead'],
    props: {
        notification: {
            type: Object,
            required: true,
        },
    },
    methods: {
        formatDate(date) {
            const options = { day: 'numeric', month: 'numeric' }
            return new Date(date).toLocaleDateString('en', options)
        },
        markNotificationAsRead(notificationId) {
            axios.post(`/mark-as-read/${notificationId}`)
                .then(() => {
                    notificationId.emit('markAsRead');
                })
                .catch(error => {
                    console.error('Error marking as read:', error);
                });
        },

    }
};
</script>