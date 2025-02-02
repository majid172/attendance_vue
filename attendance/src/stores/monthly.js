import { defineStore } from "pinia";
import axios from "axios";
import { useRouter } from "vue-router";
const router = useRouter();

export const useMonthlyStore = defineStore('monthlyStore',{
  state: ()=>({
    employees:[],
    inputField:{
      month: '',
      report_type: 'all',
      department: '',
      employee: ''
    }
  }),
  actions:{
    async getEmployee()
    {
      const depId = this.inputField.department;
      const {data} = await axios.get(`/employee/${depId}`);

      this.employees = data
    },
    async monthlyReport()
    {
      console.log(this.inputField);
      const empId = this.inputField.employee;
      const { data } = await axios.put(`/attendance/${empId}`,this.inputField);

      router.push('/monthly-report/show')
    }
  }
})
