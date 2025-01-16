<script setup>
import { defineEmits, defineProps } from 'vue';

// Accept the currentPage and totalPages as props from the parent component
const props = defineProps({
  currentPage: {
    type: Number,
    required: true
  },
  totalPages: {
    type: Number,
    required: true
  }
});

// Emit the changePage event when a page is selected
const emit = defineEmits(['changePage']);

const handlePageChange = (page) => {
  if (page >= 1 && page <= props.totalPages) {
    emit('changePage', page); // Emit the page change to the parent component
  }
};

const handlePrevPage = () => {
  if (props.currentPage > 1) {
    emit('changePage', props.currentPage - 1);
  }
};

const handleNextPage = () => {
  if (props.currentPage < props.totalPages) {
    emit('changePage', props.currentPage + 1);
  }
};
</script>

<template>
  <div class="demo-inline-spacing">
    <nav aria-label="Page navigation">
      <ul class="pagination pagination-sm">
        <!-- Previous Page -->
        <li class="page-item prev" :class="{ disabled: currentPage === 1 }">
          <a class="page-link" href="javascript:void(0);" @click="handlePrevPage">
            <i class="tf-icon bx bx-chevrons-left bx-xs"></i>
          </a>
        </li>

        <!-- Page Numbers -->
        <li
          class="page-item"
          :class="{ active: currentPage === page }"
          v-for="page in totalPages" :key="page"
        >
          <a class="page-link" href="javascript:void(0);" @click="handlePageChange(page)">
            {{ page }}
          </a>
        </li>

        <!-- Next Page -->
        <li class="page-item next" :class="{ disabled: currentPage === totalPages }">
          <a class="page-link" href="javascript:void(0);" @click="handleNextPage">
            <i class="tf-icon bx bx-chevrons-right bx-xs"></i>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</template>
