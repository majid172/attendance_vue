<script setup>
import Aside from "@/components/layouts/Aside.vue";
import Nav from "@/components/layouts/Nav.vue";
import Footer from "@/components/layouts/Footer.vue";
import MonthlyReportShow from "@/components/Attendance/MonthlyReportShow.vue";
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
        <MonthlyReportShow/>
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
