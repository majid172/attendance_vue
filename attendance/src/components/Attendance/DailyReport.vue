<script setup>
import {onMounted} from "vue";
import Pagination from "@/components/Pagination.vue";
import {useAttendanceStore} from "@/stores/attendance.js";
import InputField from "@/components/InputField.vue";

const attendanceStore = useAttendanceStore();

const requestForm = async ()=>{
  attendanceStore.filterList()
}
onMounted(()=>{
  attendanceStore.list()
  // attendanceStore.filterList()
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
              <h5 class="modal-title" id="modalCenterTitle">Daily Report</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form @submit.prevent="requestForm">
              <div class="modal-body">
                <div class="mb-6">
                  <InputField label="Select Date" type="date" v-model="attendanceStore.inputField.date"/>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                  Close
                </button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
    <div class="card mb-4" v-for="(attendance,index) in attendanceStore.attendances">
      <div class="card-header ">
        <h5>{{ index }} Attendance
          <span v-if="!attendanceStore.inputField.date">({{ attendanceStore.inputField.date }})</span>
          <span v-else>(Today)</span></h5>
      </div>

      <div class="table-responsive text-nowrap" >
        <table class="table" >
          <thead class="table-light">
          <tr>
            <th>SL.</th>
            <th>Name</th>
            <th>Employee ID</th>
            <th>Check-In Time</th>
            <th>Check-Out Time</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody class="table-border-bottom-0">
          <tr v-if="attendances.length === 0">
            <td colspan="7" class="text-center">No data available</td>
          </tr>
          <tr v-for="(item,sl) in attendance">
            <td>{{sl+1}}</td>
            <td>{{item.employee_name}} </td>
            <td><span class="badge bg-label-warning me-1">{{item.employee_id}}</span>  </td>
            <td>{{item.check_in_time}}</td>
            <td>{{item.check_out_time}}</td>
            <td>
              <span class="badge bg-label-success me-1" v-if="item.status == 'present'">{{ item.status }}</span>
              <span class="badge bg-label-danger me-1" v-if="item.status == 'absent'">{{ item.status }}</span>
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
