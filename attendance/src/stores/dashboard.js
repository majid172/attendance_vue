import {defineStore} from "pinia";
import axios from "axios";
export const useDashboardStore= defineStore('dashboardStore',{
  state:()=>({
    totalEmployee:'',
    todayAttend:'',
    todayLeaves:'',
    upcomingHolidays: '',
    leaveHistorys: '',
    chart: ''
  }),
  actions:{
    async employees(){
      const {data}= await axios.get('/dashboard');
      console.log(data)
      this.totalEmployee = data.totalEmployees;
      this.todayAttend = data.todayAttendence;
      this.todayLeaves = data.todayLeave;
      this.upcomingHolidays = data.upcomingHoliday;
      this.chart = data.dailyHistory;
      this.leaveHistorys = data.leaveHistory;
    }
  }
});
