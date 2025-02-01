import {defineStore} from "pinia";
import axios from "axios";
import router from "@/router";
export const useLeaveStore = defineStore('leave',{
  state:()=>({
    leaves:[],
    employeeName: null,
    employees:[],
    inputFiled:{
      department: '',
      employee:'',
      year: '',
    }
  }),
  actions:{
    async list(){
      const {data} = await axios.get('leaves');
      this.leaves = data;
    },

    async employeeStatus(){

      const {data} = await axios.post('/employeeLeave',this.inputFiled);
      console.log(data);
      this.leaves = data.formattedMonthlyStatus;
      this.employeeName = data.employee;
      // router.push('/')


    },
    async getEmployee()
    {
      const depId = this.inputFiled.department;
      // this.employees = aw
      const {data} = await axios.get(`/employee/${depId}`);
      console.log(data)
      this.employees = data

    }
  }
});
