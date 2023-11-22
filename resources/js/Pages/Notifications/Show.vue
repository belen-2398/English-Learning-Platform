
<template>
    <div>

        <Head title="Notifications" />

        <h1 class="pt-6 font-bold">Notifications</h1>
        <h2 class="pb-4 uppercase">Have a look at all your notifications.</h2>

        <ul class="max-w divide-y divide-gray-200 dark:divide-gray-700 mx-10 mt-6 grid grid-cols-3 gap-4">
            <div v-for="notification in unreadNotifications">
                <li class="p-3 sm:pb-4 bg-white">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <font-awesome-icon icon="fa-solid fa-eye-slash" style="color: #000000;" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            <div v-if="notification.data.comment">
                                <Link :href="route('comments.show', notification.data.comment.id)" class="hover:underline">
                                {{ notification.data.message }}
                                </Link>
                            </div>
                            <div v-else>
                                {{ notification.data.message }}
                            </div>
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                {{ formatDate(notification.created_at) }}
                            </p>
                        </div>
                    </div>
                </li>
            </div>
            <div v-for="readNotification in readNotifications">
                <li class="p-3 sm:pb-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <font-awesome-icon icon="fa-solid fa-eye" style="color: #000000;" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-600 truncate dark:text-white">
                            <div v-if="readNotification.data.comment">
                                <Link :href="route('comments.show', readNotification.data.comment.id)"
                                    class="hover:underline">
                                {{ readNotification.data.message }}
                                </Link>
                            </div>
                            <div v-else>
                                {{ readNotification.data.message }}
                            </div>
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                {{ formatDate(readNotification.created_at) }}
                            </p>
                        </div>
                    </div>
                </li>
            </div>
        </ul>

    </div>
</template>
  
<script>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';

export default {
    name: 'About',
    components: {
        Head,
        Link
    },
    props: {
        readNotifications: Object,
        unreadNotifications: Object,
    },
    methods: {
        formatDate(date) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' }
            return new Date(date).toLocaleDateString('en', options)
        },
    },
    layout: FrontendLayout,
}
</script>