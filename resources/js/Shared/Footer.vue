<template>
    <!-- TODO: links, add social media -->
    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
      <span class="text-sm sm:text-center">© 2023 <Link href="#" class="hover:underline">English™</Link>. All Rights Reserved.
        </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium sm:mt-0">
            <li>
                <Link href="/about" class="mr-4 hover:underline md:mr-6 ">About</Link>
            </li>
            <li>
                <Link href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</Link>
            </li>
            <li>
                <Link href="#" class="mr-4 hover:underline md:mr-6">Licensing</Link>
            </li>
            <li>
                <Link href="#" class="hover:underline">Contact</Link>
            </li>
        </ul>
    </div>
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