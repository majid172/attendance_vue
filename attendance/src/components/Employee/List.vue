<script setup>
import { useEmployeeStore } from '@/stores/employee';
import {computed, onMounted, ref} from "vue";
import Pagination from "@/components/Pagination.vue";
import InputField from "@/components/InputField.vue";
import SelectField from "@/components/SelectField.vue";
import {useDepartmentStore} from "@/stores/department.js";
const employeeStore = useEmployeeStore();
const departmentStore = useDepartmentStore();
const currentPage = ref(1); // Current page starts at 1
const itemsPerPage = 10; // Items per page

// Computed pagination result
const pagination = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return employeeStore.employees.slice(start, end);
});

// Compute total pages based on the department list
const totalPages = computed(() => Math.ceil(employeeStore.employees.length / itemsPerPage));
const displayKey = ref('name');
// Navigate to a specific page

const editEmp = (id) =>{
    employeeStore.editEmployee(id);
}
const updateEmp = ()=>{
  const modalElement = document.getElementById("modalCenter");
  const modalInstance = bootstrap.Modal.getInstance(modalElement);
  const triggerButton = document.querySelector('[data-bs-target="#modalCenter"]');
  if (triggerButton) {
    triggerButton.focus();
  }
  modalInstance.hide();
  employeeStore.update();
}

const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
  }
};
onMounted(()=>{
  employeeStore.fetchList()
  departmentStore.list();
})
</script>
<template>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header d-inline-flex justify-content-between">
        <h5 >Employee List</h5>

      </div>

      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Department</th>
            <th>Designation</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody class="table-border-bottom-0">
          <tr v-for="(item,index) in pagination">
            <td>{{ (currentPage -1) * itemsPerPage +index+1  }}</td>
            <td>{{ item.full_name }}</td>
            <td> {{ item.name }} </td>
            <td>{{ item.designation }}</td>
            <td>{{ item.phone }}</td>
            <td><span class="badge bg-label-primary me-1">{{ item.status }}</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);" @click="editEmp(item.id)"
                     data-bs-toggle="modal"
                     data-bs-target="#modalCenter"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);" @click="employeeStore.remove(item.id)"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>

              </div>
            </td>

            <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Employee</h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"></button>
                  </div>
                  <form @submit.prevent="updateEmp">
                    <div class="modal-body">
                      <div class="mb-6">
                        <InputField
                          label="Employee Name"
                          placeholder="Enter employee fullname"
                          icon="bx bx-user"
                          v-model="employeeStore.inputField.full_name"
                        />
                      </div>
                      <div class="mb-6">
                        <InputField
                          label="Email" type="email"
                          placeholder="Enter employee email"
                          icon="bx bx-envelope"
                          v-model="employeeStore.inputField.email"
                        />
                      </div>

                      <div class="mb-6">
                        <InputField
                          label="Designation"
                          placeholder="Enter employee designation"
                          icon="bx bx-buildings"
                          v-model="employeeStore.inputField.emp_designation"
                        />
                      </div>
                      <div class="mb-6">
                        <InputField
                          label="Phone"
                          placeholder="Enter employee phone"
                          icon="bx bx-phone"
                          v-model="employeeStore.inputField.phone"
                        />
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                        Close
                      </button>
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
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

