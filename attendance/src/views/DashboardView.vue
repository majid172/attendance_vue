<script setup>
import absenceIcon from '../assets/image/absence.png';
import leaveIcon from '../assets/image/leave.png';
import FirstRowSecondCol from "@/components/Dashboard/FirstRowSecondCol.vue";
import BarChart from "@/components/Dashboard/BarChart.vue";
import Card from "@/components/Dashboard/Card.vue";
import {useDashboardStore} from "@/stores/dashboard.js";
import {onMounted} from "vue";
import LeavesTable from "@/components/Dashboard/LeavesTable.vue";
import Aside from "@/components/layouts/Aside.vue";
import Nav from "@/components/layouts/Nav.vue";
import Footer from "@/components/layouts/Footer.vue";
import DailyReport from "@/components/Attendance/DailyReport.vue";

const dashboardStore = useDashboardStore();
onMounted(()=>{
  dashboardStore.employees();
  console.log(dashboardStore.authUser.id);
})

</script>
<template>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <Aside/>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <Nav/>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-xxl-8 mb-6 order-0">
        <div class="card">
          <div class="d-flex align-items-start row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary mb-3">Congratulations {{ dashboardStore.authUser?.name || 'Guest' }} ! 🎉</h5>
                <p class="mb-6">
                  You have done 72% more sales today.<br />Check your new badge in your profile.
                </p>

                <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-6">
                <img
                  src="../assets/img/illustrations/man-with-laptop.png"
                  height="175"
                  class="scaleX-n1-rtl"
                  alt="View Badge User" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 order-1">
        <FirstRowSecondCol/>
      </div>
      <!-- Total Attendance -->
      <div class="col-12 col-xxl-8 order-2 order-md-3 order-xxl-2 mb-6">
        <div class="card">
          <div class="row row-bordered g-0">
            <div class="col-lg-12">
             <BarChart/>
            </div>

          </div>
        </div>
      </div>
      <!--/ Total Revenue -->
      <div class="col-12 col-md-8 col-lg-12 col-xxl-4 order-3 order-md-2">
        <div class="row">
          <div class="col-6 mb-6">
            <Card>
              <template #image>
                <img :src="absenceIcon" alt="paypal" class="rounded" />
              </template>
              <template #title>
                <p class="mb-1">Today Absence</p>
              </template>
              <template #totalValue>
                <h4 class="card-title mb-3" >{{ dashboardStore.totalEmployee - dashboardStore.todayAttend ?? 0 }}</h4>
              </template>

            </Card>

          </div>
          <div class="col-6 mb-6">
            <Card>
              <template #image>
                <img :src="leaveIcon" alt="leave icon" class="rounded">
              </template>
              <template #title>
                <p class="mb-1">Today Leave</p>
              </template>
              <template #totalValue>
                <h4 class="card-title mb-3" >{{ dashboardStore.todayLeaves ?? 0}}</h4>
              </template>

            </Card>
          </div>

        </div>
      </div>
    </div>
    <div class="row">
      <!-- Transactions -->
      <div class="col-md-6 col-lg-8 order-2 mb-6">
        <LeavesTable :dashboard-store="dashboardStore" />

      </div>
      <!--/ Transactions -->

      <!-- Order Statistics -->
      <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-6">
        <div class="card h-100">
          <div class="card-header d-flex justify-content-between">
            <div class="card-title mb-0">
              <h5 class="mb-1 me-2">Upcoming {{dashboardStore.upcomingHolidays.length}} Holidays</h5>
              <!--              <p class="card-subtitle">Current month {{dashboardStore.upcomingHolidays.length}} holidays</p>-->
            </div>

          </div>
          <div class="card-body">
            <ul class="p-0 m-0" v-for="(item,index) in dashboardStore.upcomingHolidays">
              <li class="d-flex align-items-center mb-5">
                <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"
                            >{{++index}}</span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">{{ item.holiday_name }}</h6>
                    <small>{{ item.holiday_date }}</small>
                  </div>
                </div>
              </li>

            </ul>
          </div>
        </div>
      </div>
      <!--/ Order Statistics -->

    </div>
  </div>
        <!-- Footer -->
          <Footer/>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>

</template>

