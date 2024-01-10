<template>
    <form @submit.prevent="form.get(formUrl)">
        <div class="flex m-4 items-center">
            <div class="flex">
                <select name="sort" v-model="form.sort"
                    class="bg-white rounded p-2.5 mr-1 text-sm text-darkColor focus:bg-white">
                    <option value="">
                        Sort by
                    </option>
                    <slot></slot>
                </select>
                <button type="submit" :disabled="form.processing"
                    class="p-2.5 text-sm text-white bg-mainColor border border-darkerColor hover:bg-darkestColor">
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