<script setup>
import Pagination from "@/components/Pagination.vue";
import {useLeaveStore} from "@/stores/leave.js";
import {onMounted} from "vue";
const leaveStore = useLeaveStore();
onMounted(()=>{
  leaveStore.list();
})
</script>
<template>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-end mb-3">

      <!-- Button trigger modal -->
      <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalCenter">
        Request Date
      </button>
      <!-- Modal -->
      <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Leave Report</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form>
              <div class="modal-body">
                <div class="mb-6">
                  <label class="form-label" for="defaultSelect">Select Date</label>
                  <select id="defaultSelect" class="form-select">
                    <option>Default select</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
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
    <div class="card">
      <div class="card-header ">
        <h5 >Leave List</h5>
      </div>

      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>Emp Id</th>
            <th>Name</th>
            <th>Department</th>
            <th>Date</th>
            <th>Leave Type</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody class="table-border-bottom-0">
          <tr v-if="leaveStore.leaves.length === 0">
            <td colspan="6" class="text-center">No data found</td>
          </tr>
          <tr v-for="(item,index) in leaveStore.leaves">
            <td>{{ index+1 }}</td>
            <td>{{ item.full_name }}</td>
            <td> {{ item.name }} </td>
            <td>{{item.leave_date}}</td>

            <td>
              <span class="badge bg-label-primary me-1" v-if="item.leave_type == 'sick'">{{ item.leave_type.toUpperCase() }}</span>
              <span class="badge bg-label-danger me-1" v-if="item.leave_type == 'casual'">{{ item.leave_type.toUpperCase() }}</span>

            </td>
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
        <Pagination/>
      </div>
    </div>
  </div>

</template>
