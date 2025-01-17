<script setup>
import { useEmployeeStore } from '@/stores/employee';
import {computed, onMounted, ref} from "vue";
import Pagination from "@/components/Pagination.vue";
import InputField from "@/components/InputField.vue";
const employeeStore = useEmployeeStore();
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

// Navigate to a specific page
const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
  }
};
onMounted(()=>{
  employeeStore.fetchList()
})
</script>
<template>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header d-inline-flex justify-content-between">
        <h5 >Employee List</h5>
        <div class="">
            <!-- Button trigger modal -->
            <button
              type="button"
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#modalCenter">
              Add Employee
            </button>
            <!-- Modal -->
            <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Add New Employee</h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"></button>
                  </div>
                  <form>
                  <div class="modal-body">
                      <div class="mb-6">
                        <InputField
                          label="Employee Name"
                          placeholder="Enter employee name"
                          icon="bx bx-user"
                          v-model="fullname"
                        />


                      </div>
                      <div class="mb-6 text-left">
                        <InputField
                          label="Department"
                          placeholder="Enter employee department"
                          icon="bx bx-buildings"
                          v-model="deparment"
                        />

                      </div>
                      <div class="mb-6">
                        <InputField
                          label="Designation"
                          placeholder="Enter employee designation"
                          icon="bx bx-buildings"
                          v-model="designation"
                        />
                      </div>
                      <div class="mb-6">
                        <InputField
                          label="Phone"
                          placeholder="Enter employee phone"
                          icon="bx bx-phone"
                          v-model="phone"
                        />
                      </div>
                      <div class="mb-6">
                        <label class="form-label" for="basic-icon-default-message">Message</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                          <select id="defaultSelect" class="form-select">
                            <option>Default select</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                        </div>
                      </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                      Close
                    </button>
                    <button type="button" class="btn btn-primary">Save</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>


<!--          <router-link to="/create-employee" class="btn btn-primary">Add Employee</router-link>-->
        </div>
      </div>

      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>SL</th>
<!--            <th>Emp Id</th>-->
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
                  <a class="dropdown-item" href="javascript:void(0);"
                     data-bs-toggle="modal"
                     data-bs-target="#modalCenter"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col mb-6">
                      <label for="nameWithTitle" class="form-label">Name</label>
                      <input
                        type="text"
                        id="nameWithTitle"
                        class="form-control"
                        placeholder="Enter Name" />
                    </div>
                  </div>
                  <div class="row g-6">
                    <div class="col mb-0">
                      <label for="emailWithTitle" class="form-label">Email</label>
                      <input
                        type="email"
                        id="emailWithTitle"
                        class="form-control"
                        placeholder="xxxx@xxx.xx" />
                    </div>
                    <div class="col mb-0">
                      <label for="dobWithTitle" class="form-label">DOB</label>
                      <input type="date" id="dobWithTitle" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                  </button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
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

