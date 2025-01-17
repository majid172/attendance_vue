import {defineStore} from "pinia";
import axios from "axios";
export const useHolidayStore = defineStore('holiday',{
  state:()=>({
    holidays:[],
  }),
  actions:{
    async list(){
      const {data}=await axios.get('holidays');
      this.holidays = data;
    }
  }
});
