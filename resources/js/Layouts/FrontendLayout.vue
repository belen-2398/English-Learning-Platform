<template>
    <div class="min-h-screen flex flex-col">
        <header>
            <Head>
                <title>Learn English</title>
                <meta head-key="description" name="description" content="A website to learn English." />
            </Head>
            <div class="absolute top-0 w-full bg-[var(--color-lightest)] md:pb-8">
                <Nav />
            </div>
        </header>

        <main>
            <div class="mt-24 md:mt-20">
                <div v-if="$page.props.flash.message" role="alert"
                    class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md mx-10 mt-10">
                    <p class="font-bold">{{ $page.props.flash.message }}</p>
                </div>
                <slot />
            </div>

        </main>
        <footer class="rounded-lg shadow mx-4 md:mt-4">
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
