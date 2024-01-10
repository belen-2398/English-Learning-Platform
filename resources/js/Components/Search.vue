<template>
    <form @submit.prevent="form.get(formUrl)">
        <div class="flex m-4 items-center">
            <div class="relative w-full">
                <input type="search" v-model="form.query" class="block p-2.5 w-full text-sm" placeholder="Search...">
                <button type="submit" :disabled="form.processing"
                    class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-mainColor border border-darkerColor hover:bg-darkestColor">
                    <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
export default {
    name: 'Search',
    props: {
        formUrl: {
            type: String,
            required: true,
        },
    },
    setup() {
        const form = useForm({
            query: ''
        });
        return { form };
    },
};
</script>