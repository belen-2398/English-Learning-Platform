<template>
    <!-- TODO: search bar -->
    <nav class="font-semibold flex flex-col mt-8 mx-6">
        <div class="flex justify-between">
            <div class="justify-left">
                <Link href="/" class="">
                <ApplicationMark class="block h-9 w-auto" />
                </Link>
            </div>
            <div class="flex justify-center ml-24">
                <ul class="flex flex-wrap gap-6 pb-4 px-8 short-line">
                    <li class="">
                        <MyNavLink href="/" :active="$page.component === 'Welcome'">Home</MyNavLink>
                    </li>
                    <li class="">
                        <MyNavLink href="/lessons" :active="$page.component === 'Lessons'">Lessons</MyNavLink>
                    </li>
                    <template v-if="$page.props.auth.user">
                        <li class="">
                            <MyNavLink href="/dictionary" :active="$page.component === 'Dictionary'">Dictionary</MyNavLink>
                        </li>
                        <li class="">
                            <MyNavLink href="/completed" :active="$page.component === 'Completed'">Completed</MyNavLink>
                        </li>
                    </template>
                    <li class="">
                        <MyNavLink href="/about" :active="$page.component === 'About'">About us</MyNavLink>
                    </li>
                </ul>
            </div>
            <div class="justify-right">
                <ul>
                    <template v-if="$page.props.auth.user">
                        <div class="flex gap-2">
                            <li class="color-button">
                                <Link :href="route('logout')" method="post" as="button">Logout</Link>
                            </li>
                            <!-- TODO: replace it by profile icon round -->
                            <li class="color-button">
                                <Link href="/user/profile" :active="$page.component === 'Profile'">Profile</Link>
                            </li>
                        </div>
                    </template>
                    <template v-else>
                        <div class="flex gap-2">
                            <li class="color-button">
                                <Link :href="route('login')">Login</Link>
                            </li>
                            <li class="color-button">
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

export default {
    components: {
        Link,
        MyNavLink,
        ApplicationMark
    }
};

</script>