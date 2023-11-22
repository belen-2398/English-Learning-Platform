<template>
    <div class="flex items-center p-4 space-x-4 text-[var(--color-lightest)] text-semibold bg-[var(--color-medium2)] divide-x divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 dark:bg-gray-800"
        role="alert">
        <svg class="w-5 h-5 text-[var(--color-lightest)] rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 18 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m9 17 8 2L9 1 1 19l8-2Zm0 0V9" />
        </svg>
        <div class="flex items-center justify-between w-full">
            <div class="pl-4 text-sm font-normal">{{ props.message }}</div>
            <button type="button" @click="emit('remove')"
                class="bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-default" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    message: String
});

const emit = defineEmits(['remove']);
</script>