<script setup>
import SelectField from '../SelectField.vue';
import { useDepartmentStore } from '@/stores/department';
import { useLeaveStore } from '@/stores/leave';
import { onMounted } from 'vue';
const departmentStore = useDepartmentStore();
const leaveStore = useLeaveStore();

onMounted(()=>{
  departmentStore.list();
})
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
            <form>
              <div class="modal-body">
                <div class="mb-6">
                  <SelectField label="Select Department" id="depId" v-model="leaveStore.inputFiled.department" :options="departmentStore.departments" displayKey="name"/>

                </div>

                <div class="mb-6">
                  <label class="form-label" for="defaultSelect">Select Employee</label>

                </div>

                <div class="mb-6">
                  <label class="form-label" for="defaultSelect">Select Year</label>
                  <select id="defaultSelect" class="form-select" v-model="leaveStore.inputFiled.year">
                      <option value="">Choose Year</option>
                      <option value="2025">2025</option>
                      <option value="2024">2024</option>
                  </select>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                  Close
                </button>
                <button type="button" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!--          <router-link to="/create-employee" class="btn btn-primary">Add Employee</router-link>-->
    </div>
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Yearly Employee Leave Status</h5>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
          <tr>
            <th>SL.</th>
            <th>Employee</th>
            <th>Total Leave</th>
            <th>Remain Leave</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody class="table-border-bottom-0">
          <tr>
            <td>1</td>
            <td>Albert Cook</td>
            <td>
              14
            </td>
            <td><span class="badge bg-label-primary me-1">Active</span></td>
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
          <tr>
            <td>2</td>
            <td>Barry Hunter</td>
            <td>14</td>
            <td><span class="badge bg-label-success me-1">Completed</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>3</td>
            <td>Trevor Baker</td>
            <td>14</td>
            <td><span class="badge bg-label-info me-1">Scheduled</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>4</td>
            <td>Jerry Milton</td>
            <td>14</td>
            <td><span class="badge bg-label-warning me-1">Pending</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->

  </div>
</template>
