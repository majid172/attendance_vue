import {defineStore} from "pinia";
import axios from "axios";
export const useLeaveStore = defineStore('leave',{
  state:()=>({
    leaves:[],
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

    async employeeSatus(){
      alert('okkk');
    }
  }
});
