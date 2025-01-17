<script setup>
import { ref, computed, onMounted } from "vue";
import { useDepartmentStore } from "@/stores/department.js";
import Pagination from "@/components/Pagination.vue";

const departmentStore = useDepartmentStore();
const currentPage = ref(1); // Current page starts at 1
const itemsPerPage = 5; // Items per page

// Computed pagination result
const pagination = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return departmentStore.departments.slice(start, end);
});

// Compute total pages based on the department list
const totalPages = computed(() => Math.ceil(departmentStore.departments.length / itemsPerPage));

// Navigate to a specific page
const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
  }
};

// Fetch data on component mount
onMounted(() => {
  departmentStore.list(); // This should populate departmentStore.departments
});
</script>

<template>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header d-inline-flex justify-content-between">
        <h5>Department List</h5>
      </div>

      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>SL.</th>
            <th>Department</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody class="table-border-bottom-0">
          <!-- Loop through paginated departments -->
          <tr v-for="(item, index) in pagination" :key="item.id">
            <!-- Corrected SL calculation: start from the first item of the current page -->
            <td>{{ (currentPage -1) * itemsPerPage +index+1  }}</td>
            <td>{{ item.name }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          </tbody>
        </table>
      </div>

      <div class="card-footer d-flex justify-content-end">
        <!-- Pagination Component with event handling -->
        <Pagination
          :currentPage="currentPage"
          :totalPages="totalPages"
          @changePage="changePage"
        />
      </div>
    </div>
  </div>
</template>
