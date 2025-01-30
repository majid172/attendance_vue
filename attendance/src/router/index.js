import { createRouter, createWebHistory } from "vue-router";
import DashboardView from "@/views/DashboardView.vue";
import ListView from "@/views/Employee/ListView.vue";
import DailyReportView from "@/views/Attendance/DailyReportView.vue";
import LeaveListView from "@/views/Leave/ListView.vue";
import YearlyStatusView from "@/views/Leave/YearlyStatusView.vue";
import DepartmentListView from "@/views/Department/DepartmentListView.vue";
import HolidayListView from "@/views/Holiday/ListView.vue";
import LoginView from "@/views/Auth/LoginView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "login",
      component: LoginView,
      meta: { guestOnly: true }, // Prevent logged-in users from accessing login
    },
    {
      path: "/dashboard",
      name: "dashboard",
      component: DashboardView,
      meta: { requiresAuth: true },
    },
    {
      path: "/employee-list",
      name: "employeeList",
      component: ListView,
      meta: { requiresAuth: true },
    },
    {
      path: "/daily-report",
      name: "dailyReport",
      component: DailyReportView,
      meta: { requiresAuth: true },
    },
    {
      path: "/leave-list",
      name: "leaveList",
      component: LeaveListView,
      meta: { requiresAuth: true },
    },
    {
      path: "/yearly-leave",
      name: "yearlyLeave",
      component: YearlyStatusView,
      meta: { requiresAuth: true },
    },
    {
      path: "/department-list",
      name: "departmentList",
      component: DepartmentListView,
      meta: { requiresAuth: true },
    },
    {
      path: "/holidays",
      name: "holidays",
      component: HolidayListView,
      meta: { requiresAuth: true },
    },
  ],
});


router.beforeEach((to, from, next) => {
  const token = localStorage.getItem("token");

  if (to.meta.requiresAuth && !token) {
    next({ name: "login" });
  } else if (to.meta.guestOnly && token) {
    next({ name: "dashboard" });
  } else {
    next();
  }
});

export default router;
