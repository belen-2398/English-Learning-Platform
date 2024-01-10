
<template>
  <div>
    <!-- TODO: mark words that shouldn't be reviewed -->
    <Head title="Dictionary" />
    <div class="short-line">
      <h1 class="pt-6 pb-2 font-semibold">Dictionary</h1>
      <h2 class="uppercase text-sm md:text-xl pb-2">Words in your dictionary</h2>
    </div>
    <div class="flex flex-col md:flex-row justify-between mt-4">
      <div class="flex mx-auto md:m-4">
        <SearchAndSort :formUrl="formUrl">
          <option value="word.asc" class="inline-flex hover:bg-bgColor">
            Word (asc)
          </option>
          <option value="word.desc" class="inline-flex hover:bg-bgColor">
            Word (desc)
          </option>
          <option value="created.asc" class="inline-flex hover:bg-bgColor">
            Oldest first
          </option>
          <option value="created.desc" class="inline-flex hover:bg-bgColor">
            Newest first
          </option>
        </SearchAndSort>
      </div>
      <div class="flex rounded gap-2 mx-auto mt-2 md:m-8">
        <button class="color-button hover:text-darkerColor " @click="openAddToDictionaryModal()">Add
          new word</button>
        <Link class="color-button hover:text-darkerColor items-center flex" href="/review">
        Review added words
        </Link>
      </div>

    </div>
    <div v-if="showSuccessMessage"
      class="bg-mainColor mt-2 mb-6 mx-auto text-white text-center py-2 w-1/2 justify-center">
      {{ successMessage }}
    </div>
    <div class="mx-8 my-6">
      <div v-if="dictionaryWordsGrouped">
        <div v-for="(group, letter) in dictionaryWordsGrouped" :key="letter">
          <h3 class="text-lg font-semibold mt-4">{{ letter }}</h3>
          <ul class="solid-border border-2 overflow-y-scroll md:flex md:flex-wrap gap-16 min-h-10">
            <li v-for="dictionaryWord in group" :key="dictionaryWord.id" class="md:w-1/5">
              <div
                class="flex justify-between items-center border-mainColor border-b-2 mb-6 pb-3 hover:bg-[var(--color-light)]">
                <button @click="openOwnDefinitionModal(dictionaryWord)" class="flex items-center">
                  <h6 class="mr-2 p-2 break-all hover:text-[var(--color-lightest)]">
                    {{ dictionaryWord.word }}
                  </h6>
                </button>
                <div class="flex-cols p-2 border-l border-mainColor border-dashed mt-2">
                  <button @click="openEditDictionaryModal(dictionaryWord)"
                    class="text-sm px-1 text-[var(--color-lightest)] bg-mainColor hover:bg-[var(--color-darkest)]">
                    Edit
                  </button>
                  <Remove :objectId="dictionaryWord.id" :formUrl="formUrl"></Remove>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div v-else>
        <p>No words added yet.</p>
      </div>

    </div>

    <AddToDictionary :showModal="showAddToDictionaryModal" :dictionaryWord="addToDictionaryWord"
      @closeModal="closeAddToDictionaryModal">
    </AddToDictionary>
    <EditDictionary v-if="showEditDictionaryModal" :dictionaryWord="editDictionaryWord"
      :showModal="showEditDictionaryModal" @closeModal="closeEditDictionaryModal">
    </EditDictionary>
    <OwnDefinition :dictionaryWord="ownDefinitionWord" :showModal="showOwnDefinitionModal" :loading="loading"
      @closeModal="closeOwnDefinitionModal">
    </OwnDefinition>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import AddToDictionary from '../../Components/Modals/Dictionary/AddToDictionary.vue';
import EditDictionary from '../../Components/Modals/Dictionary/EditDictionary.vue';
import OwnDefinition from '../../Components/Modals/Dictionary/OwnDefinition.vue';
// import Search from '../../Components/Search.vue';
import SearchAndSort from '../../Components/SearchAndSort.vue';
// import Sort from '../../Components/Sort.vue';
import Remove from '../../Components/Remove.vue';


export default {
  name: 'Dictionary',
  components: {
    Head,
    Link,
    AddToDictionary,
    EditDictionary,
    OwnDefinition,
    SearchAndSort,
    // Search,
    // Sort,
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
      addToDictionaryWord: null,
      editDictionaryWord: null,
      ownDefinitionWord: null,
      formUrl: '/dictionary',
      objectId: '',
      successMessage: '',
      showSuccessMessage: false,
    };
  },
  computed: {
    dictionaryWordsGrouped() {
      if (!this.dictionaryWords) return {};

      const grouped = {};
      this.dictionaryWords.forEach((dictionaryWord) => {
        const letter = dictionaryWord.word.charAt(0).toUpperCase();
        if (!grouped[letter]) {
          grouped[letter] = [];
        }
        grouped[letter].push(dictionaryWord);
      });

      return grouped;
    },
  },
  methods: {
    openOwnDefinitionModal(dictionaryWord) {
      this.ownDefinitionWord = dictionaryWord;
      this.showOwnDefinitionModal = true;
    },
    closeOwnDefinitionModal() {
      this.showOwnDefinitionModal = false;
    },
    openAddToDictionaryModal(dictionaryWord) {
      this.addToDictionaryWord = dictionaryWord;
      this.showAddToDictionaryModal = true;
    },
    closeAddToDictionaryModal() {
      this.successMessage = 'Word added successfully.';
      this.showSuccessMessage = true;
      this.showAddToDictionaryModal = false;
    },
    openEditDictionaryModal(dictionaryWord) {
      this.editDictionaryWord = dictionaryWord;
      this.showEditDictionaryModal = true;
    },
    closeEditDictionaryModal() {
      this.successMessage = 'Word updated successfully.';
      this.showSuccessMessage = true;
      this.showEditDictionaryModal = false;
      this.editDictionaryWord = null;
    },
  },

  layout: FrontendLayout,
};
</script>
