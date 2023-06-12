<template aria-label="Page navigation">
    <ul class="inline-flex -space-x-px">
      <li>
        <button type="button"
            @click="onClickFirstPage"
            :disabled="isInFirstPage"
            class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300
                rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700
                dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            First
        </button>
      </li>
      <li>
        <button type="button"
            @click="onClickPreviousPage"
            :disabled="isInFirstPage"
            class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300
                rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700
                dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            Previous
        </button>
      </li>

      <!-- Visible buttons -->
      <li v-for="page in pages" :key="page.name">
        <button type="button" @click="onClickPage(page.name)"
            :disabled="page.isDisabled"
            class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300
                rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700
                dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            {{ page.name }}
        </button>
      </li>
      <!-- Visible buttons end -->

      <li>
        <button type="button"
            @click="onClickNextPage"
            :disabled="isInLastPage"
            class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300
                rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700
                dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            Next
        </button>
      </li>
      <li>
        <button type="button"
            @click="onClickLastPage"
            :disabled="isInLastPage"
            class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300
                rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700
                dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            Last
        </button>
      </li>
    </ul>
</template>

<script>
export default {
    props: {
        maxVisibleButtons: {
            type: Number,
            required: false,
            default: 3
        },
        totalPages: {
            type: Number,
            required: true
        },
        perPage: {
            type: Number,
            required: true
        },
        currentPage: {
            type: Number,
            required: true
        }
    },
    computed: {
        startPage() {
            if (this.currentPage === 1) {
                return 1;
            }
            if (this.currentPage === this.totalPages) {
                return this.totalPages - this.maxVisibleButtons;
            }
            return this.currentPage - 1;
        },
        pages() {
            const range = [];
            for (
                let i = this.startPage;
                i <= Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages);
                i++
            ) {
                range.push({
                    name: i,
                    isDisabled: i === this.currentPage
                });
            }

            return range;
        },
        isInFirstPage() {
            return this.currentPage === 1;
        },
        isInLastPage() {
            return this.currentPage === this.totalPages;
        },
    },
    methods: {
        onClickFirstPage() {
            this.$emit('pagechanged', 1);
        },
        onClickPreviousPage() {
            this.$emit('pagechanged', this.currentPage - 1);
        },
        onClickPage(page) {
            this.$emit('pagechanged', page);
        },
        onClickNextPage() {
            this.$emit('pagechanged', this.currentPage + 1);
        },
        onClickLastPage() {
            this.$emit('pagechanged', this.totalPages);
        },
    },
};
</script>