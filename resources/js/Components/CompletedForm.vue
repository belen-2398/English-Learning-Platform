<template>
    <form class="mb-10">
        <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" class="sr-only peer" :checked="completed" :disabled="loading"
                @change="submitCompletedForm" />
            <div
                class="w-11 h-6 bg-[var(--color-lightest)] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[var(--color-medium1)]">
            </div>
            <span class="ml-3 text-sm font-medium text-[var(--color-darkest)]" v-if="!loading">
                {{ completed !== false ? 'Marked as complete' : 'Mark as complete' }}
            </span>
            <span class="ml-3 text-sm font-medium text-[var(--color-darkest)]" v-else>
                Wait a second...
            </span>
        </label>
    </form>
</template>
    
<script>
import { useForm } from '@inertiajs/vue3';
export default {
    name: 'CompletedForm',
    props: {
        topic: Object,
        completed: Boolean,
    },
    data() {
        return {
            form: {
                topic_id: '',
            },
            loading: false,
        };
    },
    setup(props) {
        const form = useForm({
            topic_id: props.topic.id,
        });

        return { form };
    },
    methods: {
        submitCompletedForm() {
            this.loading = true;

            setTimeout(() => {
                if (this.form.processing) {
                    return;
                }

                if (!this.completed) {
                    this.form.post('/topics/markAsCompleted/' + this.topic.id)
                } else {
                    this.form.delete('/topics/deleteAsCompleted/' + this.topic.id)
                }
                this.loading = false;
            }, 1000);
        },
    },
};
</script>