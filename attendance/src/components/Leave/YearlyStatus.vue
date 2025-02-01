<script setup>
import SelectField from '../SelectField.vue';
import { useDepartmentStore } from '@/stores/department';
import { useLeaveStore } from '@/stores/leave';
import { onMounted } from 'vue';
const departmentStore = useDepartmentStore();
const leaveStore = useLeaveStore();

onMounted(()=>{
  departmentStore.list();
  // leaveStore.getEmployee();
})

const showLeaveStatus = async () => {

  const modalElement = document.getElementById("modalCenter");
  const modalInstance = bootstrap.Modal.getInstance(modalElement);
  modalInstance.hide();
  leaveStore.employeeStatus();

}
</script>
<template>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-end mb-3">

      <!-- Button trigger modal -->
      <button
        type="button"
        class="btn btn-outline-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalCenter">
         Leave Status
      </button>
      <!-- Modal -->
      <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Individual Employee Leave Report</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form @submit.prevent="showLeaveStatus">
              <div class="modal-body">
                <div class="mb-6">
                  <SelectField label="Select Department" id="depId" v-model="leaveStore.inputFiled.department" :options="departmentStore.departments" displayKey="name" @change="leaveStore.getEmployee()"/>

                </div>

                <div class="mb-6">
                  <SelectField label="Select Employee" id="employeeId" v-model="leaveStore.inputFiled.employee" :options="leaveStore.employees" displayKey="full_name" aria-disabled="true" icon="bx bx-user"></SelectField>

                </div>

                <div class="mb-6">

                  <label class="form-label" for="defaultSelect">Select Year</label>
                  <div class="input-group input-group-merge">
                  <span class="input-group-text">
                    <i class="bx bx-calendar"></i>
                  </span>
                  <select id="defaultSelect" class="form-select" v-model="leaveStore.inputFiled.year" >
                      <option value="">Choose Year</option>
                      <option value="2025">2025</option>
                      <option value="2024">2024</option>
                  </select>
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                  Close
                </button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!--          <router-link to="/create-employee" class="btn btn-primary">Add Employee</router-link>-->
    </div>
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header"> <span v-if="leaveStore.employeeName">{{ leaveStore.employeeName.full_name}} Yearly Leave</span>
      <span v-else> Employee Yearly Leaves</span>
      </h5>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
          <tr>
            <th>SL.</th>
            <th>Month</th>
            <th>Total Leave</th>

          </tr>
          </thead>
          <tbody class="table-border-bottom-0">
          <tr v-if="leaveStore.leaves.length == 0">
          <td class="text-danger text-center" colspan="3"><p> Please select employee</p></td>
          </tr>
          <tr v-for="(item, index) in leaveStore.leaves" :key="index">
            <td>{{ ++index }}</td>
            <td>{{ item.month }}</td>
            <td><span class="badge bg-label-primary me-1">{{ item.total_leaves }}</span></td>
          </tr>
          <!-- <tr>
              <td colspan="2">Leave Remaining</td>
              <td>{{ leaveStore.employeeName.leave_days_remaining }}</td>
          </tr> -->
          </tbody>
        </table>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->

  </div>
</template>
