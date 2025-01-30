import {defineStore} from "pinia";
import axios from "axios";
export const useDashboardStore= defineStore('dashboardStore',{
  state:()=>({
    totalEmployee:'',
    todayAttend:'',
    todayLeaves:'',
    upcomingHolidays: '',
    leaveHistorys: '',
    chart: '',
    authUser: ''
  }),
  actions:{
    async employees(){
      const token = localStorage.getItem("token");
      // const user = localStorage.getItem("user");
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
      const {data}= await axios.get('/dashboard');

      this.totalEmployee = data.totalEmployees;
      this.todayAttend = data.todayAttendence;
      this.todayLeaves = data.todayLeave;
      this.upcomingHolidays = data.upcomingHoliday;
      this.chart = data.dailyHistory;
      this.leaveHistorys = data.leaveHistory;
      this.authUser = data.user;
// console.log(this.authUser);

    }
  }
});
