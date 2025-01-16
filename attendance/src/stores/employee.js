import {defineStore} from "pinia";
import axios from "axios";
import { ref } from "vue";
export const useEmployeeStore = defineStore('employeeStore',{
  state:()=>({
    employees:[]
  }),
  actions:{
    async fetchList(){
      console.log('emo')
      const {data} = await axios('employee');
      console.log(data)
      this.employees = data;
    },
  },
});
