<script setup>
import { defineProps } from 'vue';
defineProps({
  dashboardStore: Object, // Accept the dashboardStore object
});
</script>
<template>
  <div class="card">
    <h5 class="card-header">Current Month Leaves List</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead class="table-light">
          <tr>
            <th>SL</th>
            <th>Employee</th>
            <th>Designation</th>
            <th>Leave Type</th>
            <th>Leave Date</th>
            <th>Days</th>

          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <tr v-for="(item,index) in dashboardStore.leaveHistorys">
            <td>{{ ++index }}</td>
            <td>{{ item.full_name }}</td>
            <td>{{ item.designation }}</td>
            <td>
              {{ item.leave_type }}
            </td>
            <td><span class="badge bg-label-primary me-1">{{ item.leave_date }}</span></td>
            <td><span class="badge bg-label-primary me-1">{{ item.days_taken }}</span></td>
           
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</template>
