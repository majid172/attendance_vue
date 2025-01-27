<script setup>
import {ref,onMounted} from "vue";
import {useDashboardStore} from "@/stores/dashboard.js";

const dashboardStore = useDashboardStore();
const dailyHistory  = dashboardStore.chart;
const options = ref({
  animationEnabled: true,
  theme:'light2',
  title:{
    text: "Daily attendance history"
  },
  data: [{
    type: "column",
    dataPoints: [
      { label: "Total Employees",  y: dailyHistory[0].totalEmp },
      { label: "Total Present", y: dailyHistory[0].todayPresent },
      { label: "Total Absent", y: dailyHistory[0].todayAbsent },

    ]
  }]
});


</script>
<template>
  <div class="card-header d-flex align-items-center justify-content-between">
    <div class="card-title mb-0">
      <h5 class="m-0 me-2">Today's Attendance</h5>
    </div>
    <div class="dropdown">
      <button
        class="btn p-0"
        type="button"
        id="totalRevenue"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false">
        <i class="bx bx-dots-vertical-rounded bx-lg text-muted"></i>
      </button>
      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalRevenue">
        <a class="dropdown-item" href="javascript:void(0);">Select All</a>
        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
        <a class="dropdown-item" href="javascript:void(0);">Share</a>
      </div>
    </div>
  </div>
  <div id="totalRevenueChart" class="px-3">
    <CanvasJSChart :options="options" />
  </div>
</template>
