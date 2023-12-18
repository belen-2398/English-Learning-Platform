<template>
    <!-- TODO: search bar -->
    <nav class="font-semibold flex flex-col mt-8 mx-2 md:mx-6">
        <div class="flex justify-between align-center">
            <div class="flex justify-between align-center -mt-3 md:mt-1">
                <div class="justify-left">
                    <Link href="/" class="">
                    <ApplicationMark class="block h-7 md:h-9 w-auto mr-2 -mt-1" />
                    </Link>
                </div>
                <div class="md:flex">
                    <ul class="relative md:hidden">
                        <Menu>
                            <MenuButton>
                                <div class="mr-1">
                                    <font-awesome-icon icon="fa-solid fa-bars"
                                        class="text-darkColor w-6 h-6 hover:text-accentColor" />
                                </div>
                            </MenuButton>
                            <MenuItems
                                class="absolute left-0 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                                <MenuItem v-slot="{ active }"
                                    class="p-2 hover:underline hover:bg-lighterColor text-sm text-darkColor dark:text-gray-200 border-b border-gray-300 flex justify-between items-center w-full">
                                <MyNavLink href="/" :active="$page.component === 'Welcome'">Home</MyNavLink>
                                </MenuItem>
                                <MenuItem v-slot="{ active }"
                                    class="p-2 hover:underline hover:bg-lighterColor text-sm text-darkColor dark:text-gray-200 border-b border-gray-300 flex justify-between items-center w-full">
                                <MyNavLink href="/lessons" :active="$page.component === 'Lessons/Lessons'">Lessons
                                </MyNavLink>
                                </MenuItem>
                                <template v-if="$page.props.auth.user">
                                    <MenuItem v-slot="{ active }"
                                        class="p-2 hover:underline hover:bg-lighterColor text-sm text-darkColor dark:text-gray-200 border-b border-gray-300 flex justify-between items-center w-full">
                                    <MyNavLink href="/dictionary" :active="$page.component === 'Dictionary'">Dictionary
                                    </MyNavLink>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }"
                                        class="p-2 hover:underline hover:bg-lighterColor text-sm text-darkColor dark:text-gray-200 border-b border-gray-300 flex justify-between items-center w-full">
                                    <MyNavLink href="/completed" :active="$page.component === 'Completed'">Completed
                                    </MyNavLink>
                                    </MenuItem>
                                </template>
                                <MenuItem v-slot="{ active }"
                                    class="p-2 hover:underline hover:bg-lighterColor text-sm text-darkColor dark:text-gray-200 border-b border-gray-300 flex justify-between items-center w-full">
                                <MyNavLink href="/about" :active="$page.component === 'About'">About us</MyNavLink>
                                </MenuItem>
                            </MenuItems>
                        </Menu>
                    </ul>
                    <ul class="hidden md:flex md:flex-wrap md:gap-6 md:pb-4 md:px-8 md:short-line">
                        <li class="hidden md:block md:text-lg">
                            <MyNavLink href="/" :active="$page.component === 'Welcome'">Home</MyNavLink>
                        </li>
                        <li class="text-sm md:text-lg">
                            <MyNavLink href="/lessons" :active="$page.component === 'Lessons/Lessons'">Lessons</MyNavLink>
                        </li>
                        <template v-if="$page.props.auth.user">
                            <li class="text-sm md:text-lg">
                                <MyNavLink href="/dictionary" :active="$page.component === 'Dictionary'">Dictionary
                                </MyNavLink>
                            </li>
                            <li class="text-sm md:text-lg">
                                <MyNavLink href="/completed" :active="$page.component === 'Completed'">Completed</MyNavLink>
                            </li>
                        </template>
                        <li class="text-sm md:text-lg">
                            <MyNavLink href="/about" :active="$page.component === 'About'">About us</MyNavLink>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="justify-right">
                <ul class="align-center">
                    <template v-if="$page.props.auth.user">
                        <div class="flex gap-1 -mt-3 md:mt-0 md:gap-2 items-center">
                            <!-- <template v-else>
                                <li class="color-button">
                                    <a href="/user/dashboard" target="_blank"
                                        :active="$page.component === 'User Dashboard'">Dashboard</a>
                                </li>
                            </template> -->
                            <li class="relative">
                                <div class="absolute right-0 bg-mainColor h-4 w-4 rounded-full flex justify-center"
                                    v-if="unreadNotifications.length > 0">
                                    <span class="text-xs text-white pt-0.5 -mt-0.5">
                                        {{ unreadNotifications.length }}
                                    </span>
                                </div>
                                <Menu>
                                    <MenuButton>
                                        <div class="mr-1">
                                            <font-awesome-icon icon="fa-solid fa-bell"
                                                class="text-darkColor w-5 md:w-6 h-auto hover:text-accentColor" />
                                        </div>
                                    </MenuButton>
                                    <MenuItems
                                        class="absolute right-0 mt-2 w-56 origin-top-right rounded-md shadow-lg focus:outline-none">
                                        <template v-if="unreadNotifications.length > 0">
                                            <MenuItem v-slot="{ active }"
                                                class="p-2 justify-right hover:underline text-sm text-mainColor dark:text-gray-200 w-full">
                                            <button @click="markAllAsRead"
                                                class="font-thin block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                Mark all as read
                                            </button>
                                            </MenuItem>
                                            <MenuItem v-slot="{ active }" v-for="notification in unreadNotifications"
                                                :key="notification.id"
                                                class="pl-2 hover:bg-lighterColor text-sm text-darkColor dark:text-gray-200 border-b border-gray-300 items-center">
                                            <UnreadNotifications :notification="notification"
                                                @mark-as-read="handleMarkAsRead">
                                            </UnreadNotifications>
                                            </MenuItem>
                                        </template>
                                        <MenuItem v-slot="{ active }" v-else
                                            class="p-2 text-sm text-darkColor dark:text-gray-200 border-b border-gray-300 flex justify-between items-center w-full">
                                        <span class="text-sm">No unread notifications.</span>
                                        </MenuItem>
                                        <!-- TODO mark as read not working properly -->
                                        <MenuItem v-slot="{ active }"
                                            class="p-2 hover:underline text-sm text-darkColor dark:text-gray-200 flex justify-between items-center w-full">
                                        <a target="_blank" :href="route('user-notifications.show')"
                                            class="text-darkColor font-thin block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            See all notifications
                                        </a>
                                        </MenuItem>
                                    </MenuItems>
                                </Menu>
                            </li>

                            <li class="relative">
                                <Menu>
                                    <MenuButton>
                                        <div class="mx-1">
                                            <font-awesome-icon icon="fa-solid fa-user"
                                                class="text-darkColor w-5 md:w-6 h-auto hover:text-accentColor" />
                                        </div>
                                    </MenuButton>
                                    <MenuItems
                                        class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                                        <MenuItem v-slot="{ active }"
                                            class="p-2 hover:underline hover:bg-lighterColor text-sm text-darkColor dark:text-gray-200 border-b border-gray-300 flex justify-between items-center w-full">
                                        <Link :href="route('profile')" :active="$page.component === 'Profile'">Profile
                                        </Link>
                                        </MenuItem>

                                        <MenuItem v-slot="{ active }"
                                            class="p-2 hover:underline hover:bg-lighterColor text-sm text-darkColor dark:text-gray-200 flex justify-between items-center w-full">
                                        <Link :href="route('logout')" method="post" as="button">Logout</Link>
                                        </MenuItem>
                                    </MenuItems>
                                </Menu>
                            </li>
                            <template v-if="$page.props.auth.user.role_as === 2">
                                <li
                                    class="ml-1 bg-darkColor text-lightestColor text-sm md:text-lg p-1.5 md:p-2 hover:bg-accentColor rounded">
                                    <a href="/admin/dashboard" target="_blank"
                                        :active="$page.component === 'Admin Dashboard'">Dashboard</a>
                                </li>
                            </template>
                            <!-- <template v-else-if="$page.props.auth.user.role_as === 1">
                                <li class="ml-1 bg-darkColor text-lightestColor text-sm md:text-lg p-1.5 md:p-2 hover:bg-accentColor rounded">
                                    <a href="/not-user/dashboard" target="_blank"
                                        :active="$page.component === 'Teacher Dashboard'">Dashboard</a>
                                </li>
                            </template> -->
                        </div>
                    </template>
                    <template v-else>
                        <div class="flex gap-1 -mt-3 md:mt-0 md:gap-2">
                            <li
                                class="bg-accentColor hover:bg-darkColor p-1 rounded text-sm md:color-button md:text-lg md:p-2">
                                <Link :href="route('login')">Login</Link>
                            </li>
                            <li
                                class="bg-accentColor hover:bg-darkColor p-1 rounded text-sm md:color-button md:text-lg md:p-2">
                                <Link :href="route('register')">Register</Link>
                            </li>
                        </div>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import MyNavLink from './MyNavLink.vue';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import UnreadNotifications from '@/Components/UnreadNotifications.vue';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';

export default {
    components: {
        Link,
        MyNavLink,
        ApplicationMark,
        UnreadNotifications,
        Menu, MenuButton, MenuItems, MenuItem
    },
    data() {
        return {
            unreadNotifications: this.$page.props.auth.user?.unreadNotifications || 0,
        };
    },
    methods: {
        handleMarkAsRead(notificationId) {
            console.log(`Notification marked as read: ${notificationId}`);
            const notificationIndex = this.unreadNotifications.findIndex(
                notification => notification.id === notificationId
            );
            console.log(notificationIndex);

            this.unreadNotifications.splice(notificationIndex, 1);
        },
        markAllAsRead() {
            axios.post('/mark-all-as-read')
                .then(() => {
                    this.unreadNotifications = [];
                });
        },
    },
};
</script>