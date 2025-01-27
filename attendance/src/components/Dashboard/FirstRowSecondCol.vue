<script setup>
import userIcon from "@/assets/image/user.png";
import attendIcon from "@/assets/image/attendance.png";
import {useDashboardStore} from "@/stores/dashboard.js";
const dashboardStore = useDashboardStore();
import {onMounted} from "vue";
onMounted(()=>{
  dashboardStore.employees();
})
</script>
<template>
  <div class="row">
    <div class="col-lg-6 col-md-12 col-6 mb-6">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="avatar flex-shrink-0">
              <img :src="userIcon" alt="User Icon" class="rounded" />
            </div>
            <div class="dropdown">
              <button
                class="btn p-0"
                type="button"
                id="cardOpt3"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded text-muted"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
              </div>
            </div>
          </div>
          <p class="mb-1">All Employees</p>
          <h4 class="card-title mb-3">{{ dashboardStore.totalEmployee }}</h4>
          <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-6 mb-6">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="avatar flex-shrink-0">
              <img
                :src="attendIcon"
                alt="wallet info"
                class="rounded" />
            </div>
            <div class="dropdown">
              <button
                class="btn p-0"
                type="button"
                id="cardOpt6"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded text-muted"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
              </div>
            </div>
          </div>
          <p class="mb-1">Today Attend</p>
          <h4 class="card-title mb-3">{{dashboardStore.todayAttend}}</h4>
          <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
        </div>
      </div>
    </div>
  </div>
</template>
