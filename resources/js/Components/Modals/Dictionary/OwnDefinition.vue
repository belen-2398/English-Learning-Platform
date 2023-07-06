<template>
    <div>
        <div class="fixed inset-0 bg-gray-900 opacity-50 z-50" v-if="showModal"></div>
        <div id="popup-modal" tabindex="-1" class="fixed inset-0 flex items-center justify-center z-50 my-auto"
            v-if="showModal">
            <div class="bg-[var(--color-lightest)]">
                <div class="flex justify-between bg-[var(--color-medium1)]">
                    <h2 class="m-6 text-xl">{{ dictionaryWord.word }}</h2>
                    <button type="button" class="m-2 mr-4 -mt-6 text-[var(--color-darker)] hover:underline"
                        @click="closeModal">X</button>
                </div>
                <div class="max-h-80 overflow-y-scroll p-6 px-20">
                    <div v-if="loading" class="my-4">
                        <div role="status" class="flex items-center">
                            <svg aria-hidden="true"
                                class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-[var(--color-medium1)]"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="ml-2 text-sm font-medium text-[var(--color-darkest)]">Loading...</span>
                        </div>
                    </div>
                    <div v-else>
                        <div v-if="dictionaryWord.pronunciation" class="flex">
                            <span class="justify-right ml-auto">{{ dictionaryWord.pronunciation }}</span>
                        </div>
                        <h4 class="underline">Definition</h4>
                        <p v-if="!dictionaryWord.definition">
                            No definitions found for this word. Go back and edit the word or look it up in the
                            <button class="underline hover:font-semibold"
                                @click="openDefinitionModal(dictionaryWord.word)">dictionary</button>.
                        </p>
                        <div v-else class="my-4 border-2 border-dashed p-2">
                            <p>{{ dictionaryWord.definition }}</p>
                        </div>
                        <h4 class="underline">Examples</h4>
                        <ul>
                            <li v-if="dictionaryWord.example1" class="mt-2 py-2">
                                <p>{{ dictionaryWord.example1 }}</p>
                            </li>
                            <li v-if="dictionaryWord.example2" class="mt-2 py-2">
                                <p>{{ dictionaryWord.example2 }}</p>
                            </li>
                            <li v-if="dictionaryWord.example3" class="mt-2 py-2">
                                <p>{{ dictionaryWord.example3 }}</p>
                            </li>
                        </ul>
                        <h4 class="underline">Notes</h4>
                        <div v-if="dictionaryWord.notes" class=" my-2 border-2 border-dashed p-2">
                            <small>{{ dictionaryWord.notes }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Definition :word="inputWord" :data="data" :showModal="showDefinitionModal" :loading="definitionLoading"
        @closeModal="closeDefinitionModal">
    </Definition>
</template>
  
<script>
import axios from 'axios';
import Definition from './Definition.vue';
export default {
    name: 'OwnDefinitionModal',
    components: {
        Definition,
    },
    props: {
        showModal: Boolean,
        dictionaryWord: Object,
        loading: Boolean
    },
    emits: ['closeModal'],
    data() {
        return {
            definitionLoading: false,
            showDefinitionModal: false,
            inputWord: '',
            data: null,
        };
    },
    methods: {
        getDefinition() {
            this.definitionLoading = true;
            setTimeout(() => {
                axios.get('/get-definition/' + this.word)
                    .then(response => {
                        this.data = response.data.data;
                        this.definitionLoading = false;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            });

        },
        openDefinitionModal(inputWord) {
            this.inputWord = inputWord;
            this.getDefinition();
            this.showDefinitionModal = true;
        },
        closeDefinitionModal() {
            this.showDefinitionModal = false;
        },
        closeModal() {
            this.$emit('closeModal');
        }
    },
};
</script>