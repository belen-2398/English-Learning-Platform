<template>
    <div>
        <header class="bg-white shadow-lg h-auto pb-6">
            <Head>
                <title>Learn English</title>
                <meta head-key="description" name="description" content="A website to learn English."/>
            </Head>
            <Nav />
        </header>     
        <!-- Main -->
        <main>
            <slot />
        </main>
    </div>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Nav from '../Shared/nav.vue';

export default {
    components: { Nav },
};

</script>
