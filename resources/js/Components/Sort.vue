<template>
    <form @submit.prevent="form.get(formUrl)">
        <div class="flex m-4 items-center">
            <div class="flex">
                <select name="sort" v-model="form.sort"
                    class="bg-[var(--color-lightest)] rounded p-2.5 mr-1 text-sm text-[var(--color-dark)] focus:bg-[var(--color-lightest)]">
                    <option value="">
                        Sort by
                    </option>
                    <slot></slot>
                </select>
                <button type="submit" :disabled="form.processing"
                    class="p-2.5 text-sm text-[var(--color-lightest)] bg-[var(--color-medium1)] border border-[var(--color-darker)] hover:bg-[var(--color-darkest)]">
                    <span class="font-bold">Sort</span>
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
export default {
    name: 'SortDictionary',
    props: {
        formUrl: {
            type: String,
            required: true,
        },
    },
    setup() {
        const form = useForm({
            sort: ''
        });
        return { form };
    },
};
</script>