import { createRouter, createWebHistory } from 'vue-router'
import DashboardView from "@/views/DashboardView.vue";
import ListView from "@/views/Employee/ListView.vue";
import DailyReportView from "@/views/Attendance/DailyReportView.vue";
import LeaveListView from "@/views/Leave/ListView.vue";
import YearlyStatusView from "@/views/Leave/YearlyStatusView.vue";
import DepartmentListView from "@/views/Department/DepartmentListView.vue";
import HolidayListView from "@/views/Holiday/ListView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: DashboardView,
    },
    {
      path: '/employee-list',
      name: 'employeeList',
      component: ListView
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
    },
    {
      path: '/daily-report',
      name: 'dailyReport',
      component: DailyReportView
    },

  //   leave
    {
      path:'/leave-list',
      name:'leaveList',
      component: LeaveListView
    },
    {
      path: '/yearly-leave',
      name: "yearlyLeave",
      component: YearlyStatusView
    },

  //   Department
    {
      path: '/department-list',
      name: "departmentList",
      component: DepartmentListView
    },
  //   holiday
    {
      path: '/holidays',
      name: "holidays",
      component: HolidayListView
    }
  ],
})

export default router
