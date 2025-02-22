import {defineStore} from "pinia";
import axios from "axios";
import { ref } from "vue";
export const useEmployeeStore = defineStore('employeeStore',{
  state:()=>({
    employees:[],
    inputField:{
      id: '',
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
      // console.log(data)
      this.employees = data;
    },
    async editEmployee(id){
      const {data} = await axios(`/employee/${id}/edit`);
      this.inputField.id = data.id;
      this.inputField.full_name = data.full_name;
      this.inputField.email  = data.email;
      this.inputField.dep_name = data.name;
      this.inputField.emp_designation = data.designation;
      this.inputField.phone = data.phone;
    },
    async update(){

      const id = this.inputField.id;
      const {data} = await axios.put(`/employee/${id}`,this.inputField);
      // console.log(data);
      if (data) {
        this.employees = this.employees.map(employee =>
          employee.id == id ? { ...employee, full_name: this.inputField.full_name } : employee
        );
      }
      this.fetchList();
    },

    async remove(id)
    {
      const { data } = await axios.delete(`/employee/${id}`);

      this.employees = this.employees.filter((employee) => employee.id !== id);
    }
  },
});
