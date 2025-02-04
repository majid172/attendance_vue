<script setup>
import { useMonthlyStore } from '@/stores/monthly';
import { useDepartmentStore } from '@/stores/department';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const reportData = ref([]);
reportData.value = JSON.parse(route.query.reportDetails);
// console.log('report');

// console.log(reportData.value);

// Ensure reportDetails exists before parsing
onMounted(() => {
  if (route.query.reportDetails) {
    try {
      reportData.value = JSON.parse(route.query.reportDetails);
    } catch (error) {
      console.error("Error parsing report data:", error);
      reportData.value = [];
    }
  }
});


</script>

<template>
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card">
          <h5 class="card-header">Monthly Report</h5>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead class="table-light">
                <tr>
                  <th>Emp. ID</th>
                  <th>Employee</th>
                  <th>Total Present</th>
                  <th>Total Absent</th>
                  <th>Weekend</th>

                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                <tr>

                  <td>{{ reportData.employee_id }}</td>
                  <td>{{ reportData.employee_name }}</td>
                  <td>{{ reportData.total_present }}</td>
                  <td>{{ reportData.total_absent }}</td>
                  <td>{{ reportData.total_weekends }}</td>

                </tr>
                <tr v-if="reportData.length === 0">
                  <td colspan="7" class="text-center">No data available</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
