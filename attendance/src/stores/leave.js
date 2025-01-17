import {defineStore} from "pinia";
import axios from "axios";
export const useLeaveStore = defineStore('leave',{
  state:()=>({
    leaves:[]
  }),
  actions:{
    async list(){
      const {data} = await axios.get('leaves');
      this.leaves = data;
    }
  }
});
