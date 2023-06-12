<template>
    <div>
        <header class="bg-white shadow-lg h-auto pb-6">

            <Head>
                <title>Learn English</title>
                <meta head-key="description" name="description" content="A website to learn English." />
            </Head>
            <Nav />
        </header>
        <main>
            <div v-if="$page.props.flash.message" role="alert"
                class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md mx-10 mt-10">
                <p class="font-bold">{{ $page.props.flash.message }}</p>
            </div>
            <slot />
        </main>
        <footer class="bg-white rounded-lg shadow m-4 dark:bg-gray-800">
            <Footer />
        </footer>
    </div>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Nav from '../Shared/nav.vue';
import Footer from '../Shared/Footer.vue';

export default {
    components: { Nav, Footer },
};

</script>
