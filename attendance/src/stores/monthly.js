import { defineStore } from "pinia";
import axios from "axios";
import InputField from "@/components/InputField.vue";
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
    }
  }
})
