<script setup>
import { useEmployeeStore } from '@/stores/employee';
import {computed, onMounted, ref} from "vue";
import Pagination from "@/components/Pagination.vue";
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
                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                          <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                        </div>
                      </div>
                      <div class="mb-6 text-left">
                        <label class="form-label" for="basic-icon-default-company">Company</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                          <input type="text" id="basic-icon-default-company" class="form-control" placeholder="ACME Inc." aria-label="ACME Inc." aria-describedby="basic-icon-default-company2">
                        </div>
                      </div>
                      <div class="mb-6">
                        <label class="form-label" for="basic-icon-default-email">Email</label>
                        <div class="input-group input-group-merge">
                          <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                          <input type="text" id="basic-icon-default-email" class="form-control" placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-icon-default-email2">
                          <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                        </div>
                        <div class="form-text">You can use letters, numbers &amp; periods</div>
                      </div>
                      <div class="mb-6">
                        <label class="form-label" for="basic-icon-default-phone">Phone No</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                          <input type="text" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2">
                        </div>
                      </div>
                      <div class="mb-6">
                        <label class="form-label" for="basic-icon-default-message">Message</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                          <textarea id="basic-icon-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
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
          <thead>
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

