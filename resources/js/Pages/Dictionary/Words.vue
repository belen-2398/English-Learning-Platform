
<template>
  <div>
    <Head title="Dictionary" />
    <div class="short-line">
      <h1 class="pt-6 mb-4">Dictionary</h1>
      <h2>All the words you have added to your personal dictionary.</h2>
    </div>
    <div class="flex justify-between mt-4">
      <button class="color-button hover:text-[var(--color-darker)] m-6 rounded" @click="openAddToDictionaryModal()">Add
        new word</button>
      <div class="flex m-4">
        <Search :formUrl="formUrl"></Search>
        <Sort :formUrl="formUrl">
          <option value="word.asc" class="inline-flex w-full px-4 py-2 hover:bg-[var(--color-lighter)]">
            Word (asc)
          </option>
          <option value="word.desc" class="inline-flex w-full px-4 py-2 hover:bg-[var(--color-lighter)]">
            Word (desc)
          </option>
          <option value="created.asc" class="inline-flex w-full px-4 py-2 hover:bg-[var(--color-lighter)]">
            Oldest first
          </option>
          <option value="created.desc" class="inline-flex w-full px-4 py-2 hover:bg-[var(--color-lighter)]">
            Newest first
          </option>
        </Sort>

      </div>
    </div>
    <div class="mx-8 my-4">
      <h4 class="mx-auto"></h4>
      <div v-if="dictionaryWords">

        <ul class="solid-border border-2 overflow-y-scroll columns-5 gap-2 h-96">
          <li v-for="dictionaryWord in dictionaryWords" :key="dictionaryWord.id" class="w-48">
            <div
              class="flex justify-between items-center border-[var(--color-medium1)] border-b-2 pb-3 hover:bg-[var(--color-light)]">
              <button @click="openOwnDefinitionModal(dictionaryWord)">
                <h6 class="mr-2 p-2 break-all hover:text-[var(--color-lightest)]">
                  {{ dictionaryWord.word }}
                </h6>
              </button>
              <div class="flex-col p-2 border-l border-[var(--color-medium1)] border-dashed mt-2">
                <button @click="openEditDictionaryModal(dictionaryWord)"
                  class="text-sm px-1 text-[var(--color-lightest)] bg-[var(--color-medium1)] hover:bg-[var(--color-darkest)]">
                  Edit
                </button>
                <Remove :objectId="dictionaryWord.id" :formUrl="formUrl"></Remove>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div v-else>
        <p>No words added yet.</p>
      </div>

    </div>

    <AddToDictionary :showModal="showAddToDictionaryModal" @closeModal="closeAddToDictionaryModal">
    </AddToDictionary>
    <EditDictionary v-if="dictionaryWord" :dictionaryWord="dictionaryWord" :showModal="showEditDictionaryModal"
      @closeModal="closeEditDictionaryModal">
    </EditDictionary>
    <OwnDefinition :dictionaryWord="dictionaryWord" :showModal="showOwnDefinitionModal" :loading="loading"
      @closeModal="closeOwnDefinitionModal">
    </OwnDefinition>
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import AddToDictionary from '../../Components/Modals/Dictionary/AddToDictionary.vue';
import EditDictionary from '../../Components/Modals/Dictionary/EditDictionary.vue';
import OwnDefinition from '../../Components/Modals/Dictionary/OwnDefinition.vue';
import Search from '../../Components/Search.vue';
import Sort from '../../Components/Sort.vue';
import Remove from '../../Components/Remove.vue';


export default {
  name: 'Dictionary',
  components: {
    Head,
    AddToDictionary,
    EditDictionary,
    OwnDefinition,
    Search,
    Sort,
    Remove,
  },
  props: {
    dictionaryWords: Array,
  },
  data() {
    return {
      showAddToDictionaryModal: false,
      showEditDictionaryModal: false,
      loading: false,
      showOwnDefinitionModal: false,
      dictionaryWord: null,
      formUrl: '/dictionary',
      objectId: '',
    };
  },
  methods: {
    openOwnDefinitionModal(dictionaryWord) {
      this.dictionaryWord = dictionaryWord;
      this.showOwnDefinitionModal = true;
    },
    closeOwnDefinitionModal() {
      this.showOwnDefinitionModal = false;
    },
    openAddToDictionaryModal(dictionaryWord) {
      this.dictionaryWord = dictionaryWord;
      this.showAddToDictionaryModal = true;
    },
    closeAddToDictionaryModal() {
      this.showAddToDictionaryModal = false;
    },
    openEditDictionaryModal(dictionaryWord) {
      this.dictionaryWord = dictionaryWord;
      this.showEditDictionaryModal = true;
    },
    closeEditDictionaryModal() {
      this.showEditDictionaryModal = false;
    },
  },

  layout: FrontendLayout,
};
</script>
