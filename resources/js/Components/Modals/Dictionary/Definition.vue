<template>
  <!-- TODO: check add to dictionary button -->
  <div>
    <div class="fixed inset-0 bg-gray-900 opacity-50 z-50" v-if="showModal"></div>
    <div id="popup-modal" tabindex="-1" class="fixed inset-0 flex items-center justify-center z-50 my-auto"
      v-if="showModal">
      <div class="bg-[var(--color-lightest)] max-w-3xl">
        <div class="flex justify-between bg-[var(--color-medium1)]">
          <h2 class="m-6 text-xl">Definition of {{ word }}</h2>
          <button type="button" class="m-2 mr-4 -mt-6 text-[var(--color-darker)] hover:underline"
            @click="closeModal">X</button>
        </div>
        <div>
          <form>
            <label class="relative inline-flex items-center cursor-pointer mt-4 ml-4">
              <input type="checkbox" class="sr-only peer" :checked="added" :disabled="loading"
                @change="addToDictionary" />
              <div :class="{ 'bg-gray-400': !added, 'bg-[var(--color-medium1)]': added }"
                class="w-11 h-6  peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[var(--color-medium1)]">
              </div>
              <span class="ml-3 text-sm font-medium text-[var(--color-darkest)]" v-if="!loading">
                {{ added === false ? 'Add word to dictionary' : 'Word added to dictionary' }}
              </span>
              <span class="ml-3 text-sm font-medium text-[var(--color-darkest)]" v-else>
                Wait a second...
              </span>
            </label>
          </form>
        </div>
        <ul class="max-h-80 overflow-y-scroll p-6">
          <li v-if="loading" class="my-4">
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
          </li>
          <div v-else>
            <p v-if="!data">
              No definitions found for this word. Check the spelling and try again. For phrasal verbs, we
              recommend looking it up with dashes between the words (e.g.: "wake-up").
            </p>
            <li v-else v-for="entry in data" :key="entry.word" class="my-4">
              <strong class="underline">{{ entry.word }}</strong>
              <ul>
                <li v-for="meaning in entry.meanings" :key="meaning.partOfSpeech"
                  class="mt-4 py-2 border-b w-max-2/3 border-dashed border-[var(--color-dark)]">
                  <small>{{ meaning.partOfSpeech }}</small>
                  <ul>
                    <li v-for="definition in meaning.definitions" :key="definition.definition" class="m-2">
                      <div class="text-justify indent-4">{{ definition.definition }}</div>
                    </li>
                  </ul>
                </li>
              </ul>
              <div class="bg-[var(--color-light)] p-2 mt-2">
                <p class="m-3 font-semibold underline">Pronunciation:</p>
                <div v-for="phonetic in entry.phonetics" :key="phonetic.text"
                  class="m-4 flex justify-between items-center">
                  <p class="mr-4">{{ phonetic.text }}</p>
                  <audio :src="phonetic.audio" controls></audio>
                </div>
              </div>
            </li>
          </div>

        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {

  name: 'DefinitionModal',
  props: {
    showModal: Boolean,
    word: String,
    data: Object,
    loading: Boolean,
  },
  data() {
    return {
      added: false,
    }
  },
  methods: {
    addToDictionary() {
      const allDefinitions = this.data.flatMap(entry => {
        return entry.meanings.flatMap(meaning => {
          return meaning.definitions.map(definition => definition.definition);
        });
      });

      const combinedDefinitions = allDefinitions.join('<br>');

      const wordData = {
        word: this.word,
        notes: '',
        definition: combinedDefinitions,
        pronunciation: this.data[0].phonetics[0].text,
        example1: '',
        example2: '',
        example3: '',
        example4: '',
        example5: '',
        translation: '',
      };

      console.log(wordData);

      axios.post('/dictionary', wordData)
        .then(response => {
          this.added = true;
          console.log('Word added to dictionary:', response.data);
        })
        .catch(error => {
          console.error('Error adding word to dictionary:', error);
        });


    },
    closeModal() {
      this.$emit('closeModal');
    }
  },
};
</script>