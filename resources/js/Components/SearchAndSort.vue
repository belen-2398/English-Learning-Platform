<template>
    <form @submit.prevent="submitForm">
        <div class="flex m-1 md:m-2 items-center gap-2 bg-lightColor p-2 rounded">
            <div class="flex flex-col md:flex-row gap-1">
                <input type="search" v-model="form.query" class="rounded md:p-2.5 w-full text-xs md:text-sm" placeholder="Search term...">
                <select name="sort" v-model="form.sort"
                    class="rounded md:p-2.5 text-xs md:text-sm text-darkColor focus:bg-white">
                    <option value="">
                        Sort by
                    </option>
                    <slot></slot>
                </select>
            </div>
            <div class="flex flex-col md:flex-row gap-1">
                <button type="submit" :disabled="form.processing"
                    class="p-1 md:p-2.5 text-sm text-white bg-mainColor border border-darkerColor hover:bg-darkerColor">
                    <span class="font-bold">Apply</span>
                </button>
                <button type="button" @click="resetForm"
                    class="p-1 md:p-2.5 text-sm text-white bg-accentColor border border-darkerColor hover:bg-darkerColor">
                    <span class="font-bold">Reset</span>
                </button>
            </div>
        </div>

    </form>
</template>

<script>
import { onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';

export default {
    name: 'SearchAndSort',
    props: {
        formUrl: {
            type: String,
            required: true,
        },
    },
    setup(props) {
        const form = useForm({
            query: '',
            sort: '',
        });

        const loadFormDataState = () => {
            const savedFormData = JSON.parse(sessionStorage.getItem('formState') || '{}');
            form.query = savedFormData.query || '';
            form.sort = savedFormData.sort || '';
        };

        const saveFormDataState = () => {
            const formData = JSON.stringify({ query: form.query, sort: form.sort });
            sessionStorage.setItem('formState', formData);
        };

        const resetForm = () => {
            form.query = '';
            form.sort = '';
            saveFormDataState();

            window.location.href = props.formUrl;
        };

        onMounted(() => {
            loadFormDataState();
        });

        const submitForm = async () => {
            await form.get(props.formUrl, {
                query: form.query,
                sort: form.sort,
            });

            saveFormDataState();
        };

        return { form, submitForm, resetForm };
    },
};
</script>