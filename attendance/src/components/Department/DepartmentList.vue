<script setup>
import { ref, computed, onMounted } from "vue";
import { useDepartmentStore } from "@/stores/department.js";
import Pagination from "@/components/Pagination.vue";
import InputField from "@/components/InputField.vue";

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

// edit
const editDept = (id)=>{
   departmentStore.edit(id);
}

const updateDept = async () => {
  try {
     departmentStore.update();
    const modalElement = document.getElementById("modalCenter");
    const modal = new bootstrap.Modal(modalElement);
    modal.hide();

  } catch (error) {
    console.error("Error updating department:", error);
  }
};

const removeDept = (id)=>{
  departmentStore.remove(id);
}
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
                  <a class="dropdown-item" @click="editDept(item.id)" href="javascript:void(0);" data-bs-toggle="modal"
                     data-bs-target="#modalCenter"><i class="bx bx-edit-alt me-1" ></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);" @click="removeDept(item.id)"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
<!--                <input type="text" v-model="departmentStore.inputField.dep_name">-->
              </div>
            </td>

          </tr>

          <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalCenterTitle">Edit Department</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
                </div>
                <form @submit.prevent="updateDept()">
                  <div class="modal-body">
                    <div class="mb-6">
                      <InputField label="Department Name" type="text" id="Department" v-model="departmentStore.inputField.dep_name" placeholder="Enter department name" />
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                      Close
                    </button>
                    <button type="submit"  class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
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
