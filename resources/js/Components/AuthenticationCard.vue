<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[var(--color-light)] ">
        <div v-if="$page.props.flash.message" role="alert"
            class="bg-[var(--color-lighter)] border-t-4 border-[var(--color-medium1)] rounded-b text-green-900 px-4 py-3 shadow-md mx-10 mt-10">
            <p class="font-bold text-center">{{ $page.props.flash.message }}</p>
        </div>
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-[var(--color-lightest)] shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
