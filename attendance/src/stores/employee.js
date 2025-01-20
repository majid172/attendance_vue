import {defineStore} from "pinia";
import axios from "axios";
import { ref } from "vue";
export const useEmployeeStore = defineStore('employeeStore',{
  state:()=>({
    employees:[],
    inputField:{
      full_name: '',
      dep_name: null,
      emp_designation: null,
      phone: null,
      email:null
    }
  }),
  actions:{
    async fetchList(){
      const {data} = await axios('employee');
      console.log(data)
      this.employees = data;
    },
    async editEmployee(id){

      const {data} = await axios(`/employee/${id}/edit`);
      this.inputField.full_name = data.full_name;
      this.inputField.email  = data.email;
      this.inputField.dep_name = data.name;
      this.inputField.emp_designation = data.designation;
      this.inputField.phone = data.phone;

      console.log(this.inputField);
    }
  },
});
