<template>
    <nav class="font-semibold justify-between flex flex-col lg:flex-row">
        <div class="flex items-center lg:mt-0">
            <Link href="/" class="p-1 mt-5 ml-6">
                <ApplicationMark class="block h-9 w-auto" />
            </Link>
            <ul class="ml-6 mt-8 flex flex-wrap gap-4 lg:gap-1">
                <li class="mx-2">
                    <MyNavLink href="/" :active="$page.component === 'Welcome'">Home</MyNavLink>  
                </li>
                <li class="mx-2">
                    <MyNavLink href="/lessons" :active="$page.component === 'Lessons'">Lessons</MyNavLink>
                </li>
                <template v-if="$page.props.auth.user">
                    <li class="mx-2">
                        <MyNavLink href="/dictionary" :active="$page.component === 'Dictionary'">Dictionary</MyNavLink>
                    </li>
                </template>  
                <li class="mx-2">
                    <MyNavLink href="/about" :active="$page.component === 'About'">About us</MyNavLink>
                </li>               
            </ul>
        </div>
        <ul class="flex items-center flex-wrap lg:flex-row gap-4 lg:gap-1">
            <template v-if="$page.props.auth.user">                   
                <div class="flex mt-8">
                    <li class="color-button mx-2">
                        <Link :href="route('logout')" method="post" as="button">Logout</Link>
                    </li>
                    <!-- TODO: replace it by profile icon round -->
                    <li class="color-button mr-6">
                        <Link href="/user/profile" :active="$page.component === 'Profile'">Profile</Link>
                    </li> 
                </div>
            </template>                
            <template v-else>
                <div class="flex mt-8">
                    <li class="color-button">
                        <Link :href="route('login')">Login</Link>
                    </li>
                    <li class="color-button mr-6 ml-2">
                        <Link :href="route('register')">Register</Link>
                    </li>
                </div>
            </template>              
        </ul>
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
            ApplicationMark  }
    };

</script>