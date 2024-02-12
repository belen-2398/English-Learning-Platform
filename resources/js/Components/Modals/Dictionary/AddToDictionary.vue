<template>
    <div>
        <div class="fixed inset-0 bg-gray-900 opacity-50 z-50" v-if="showModal"></div>
        <div id="popup-modal" tabindex="-1" class="fixed inset-0 flex items-center justify-center z-50 my-auto mx-2"
            v-if="showModal">
            <div class="bg-bgColor max-w-3xl">
                <div class="flex justify-between bg-mainColor">
                    <h2 class="ml-4 md:m-6 md:text-xl">New word</h2>
                    <button type="button" class="m-2 mr-4 md:-mt-6 text-darkerColor hover:underline"
                        @click="closeModal" aria-label="Close">X</button>
                </div>
                <div class="p-6 max-h-96 overflow-y-scroll">
                    <form @submit.prevent="form.post('/dictionary', {
                        onSuccess: () => {
                            form.reset();
                            this.closeModal();
                        },
                    })">
                        <div class="flex flex-col md:flex-row md:flex-wrap mb-6">
                            <div class="md:w-1/3 px-3 mb-6 md:mb-0 mx-auto">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="word">
                                    Word
                                </label>
                                <input v-model="form.word"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" placeholder="dog">
                                <div v-if="form.errors.word">{{ form.errors.word }}</div>
                            </div>
                            <div class="md:w-1/3 px-3 mb-6 md:mb-0 mx-auto">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="pronunciation">
                                    Pronunciation
                                </label>
                                <input v-model="form.pronunciation"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" placeholder="/dog/">
                                <div v-if="form.errors.pronunciation">{{ form.errors.pronunciation }}</div>
                            </div>
                            <div class="md:w-1/3 px-3 mb-6 md:mb-0 mx-auto">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="word">
                                    Translation
                                </label>
                                <input v-model="form.translation"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" placeholder="perro">
                            </div>
                        </div>
                        <div class="flex justify-center" v-if="!showDefinition">
                            <button type="button"
                                class="flex items-center text-[var(--color-dark)] font-semibold text-sm p-2 m-2 hover:bg-[var(--color-medium2)]"
                                @click="showDefinition = true">
                                Definition
                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div v-if="showDefinition" class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="definition">
                                    Definition
                                </label>
                                <textarea v-model="form.definition"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                                <div v-if="form.errors.definition">{{ form.errors.definition }}</div>
                            </div>
                        </div>
                        <div class="flex justify-center" v-if="!showExamples">
                            <button type=" button"
                                class="flex items-center text-[var(--color-dark)] font-semibold text-sm p-2 m-2 hover:bg-[var(--color-medium2)]"
                                @click="showExamples = true">Examples <svg class="w-4 h-4 ml-2" aria-hidden="true"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div v-if="showExamples" class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="examples">
                                    Examples
                                </label>
                                <div id="examples">
                                    <textarea v-model="form.example1"
                                        class="appearance-none block w-full h-10 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                                    <div v-if="form.errors.example1">{{ form.errors.example1 }}</div>
                                    <textarea v-model="form.example2"
                                        class="appearance-none block w-full h-10 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                                    <div v-if="form.errors.example2">{{ form.errors.example2 }}</div>
                                    <textarea v-model="form.example3"
                                        class="appearance-none block w-full h-10 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                                    <div v-if="form.errors.example3">{{ form.errors.example3 }}</div>
                                    <textarea v-model="form.example4"
                                        class="appearance-none block w-full h-10 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                                    <div v-if="form.errors.example4">{{ form.errors.example4 }}</div>
                                    <textarea v-model="form.example5"
                                        class="appearance-none block w-full h-10 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                                    <div v-if="form.errors.example5">{{ form.errors.example5 }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center" v-if="!showNotes">
                            <button type="button"
                                class="flex items-center text-[var(--color-dark)] font-semibold text-sm p-2 m-2 hover:bg-[var(--color-medium2)]"
                                @click="showNotes = true">Notes <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div v-if="showNotes" class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="notes">
                                    Notes
                                </label>
                                <textarea v-model="form.notes"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                                <div v-if="form.errors.notes">{{ form.errors.notes }}</div>
                            </div>
                        </div>
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                            {{ form.progress.percentage }}%
                        </progress>
                        <button type="submit" class="hover:underline bg-[var(--color-medium2)] p-2"
                            :disabled="form.processing">
                            Save
                        </button>
                    </form>
                    <p class="text-sm italic text-center mt-2">
                        The examples and definition will help you practice the words later.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import { useForm } from '@inertiajs/vue3';
export default {
    name: 'AddToDictionaryModal',
    props: {
        showModal: Boolean,
    },
    data() {
        return {
            showExamples: false,
            showDefinition: false,
            showNotes: false,
        };
    },
    setup() {
        const form = useForm({
            word: '',
            definition: '',
            pronunciation: '',
            translation: '',
            example1: '',
            example2: '',
            example3: '',
            example4: '',
            example5: '',
            notes: '',
        });

        return { form };
    },
    methods: {
        closeModal() {
            this.$emit('closeModal');
        }

    },
};
</script>