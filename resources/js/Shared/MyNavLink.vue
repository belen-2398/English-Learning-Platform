<template>
    <Link
        class="nav-link"
        :class="{ 'active': active }"
    >
        <slot />
    </Link>
</template>

<script>
    import { Link } from '@inertiajs/vue3';
    export default {
        components: { Link },
        props: {
            active: Boolean
        }
    };
</script>