<template>
    <form @submit.prevent="confirmDelete">
        <button type="submit" :disabled="form.processing"
            class="text-xs px-1 font-semibold text-[var(--color-darkest)]">
            Delete
        </button>
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
        objectId: {
            type: Number,
            required: true,
        },
    },
    setup(props) {
        const form = useForm({
            sort: ''
        });
        const confirmDelete = () => {
            if (window.confirm('Are you sure you want to delete?')) {
                form.delete(props.formUrl + '/' + props.objectId);
            }
        };
        return { form, confirmDelete };
    },

};
</script>