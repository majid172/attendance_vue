import {defineStore} from "pinia";
import axios from "axios";
export const useHolidayStore = defineStore('holiday',{
  state:()=>({
    holidays:[],
    inputField:{
      holiday_name: null,
      holiday_date: null
    }
  }),
  actions:{
    async list(){
      const {data}=await axios.get('holidays');
      this.holidays = data;
    },
    async createHoliday(){
      console.log(this.inputField);
      const {data} = await axios.post('/holidays',this.inputField);
      this.holidays.push(data);
      this.list();
      this.inputField.holiday_name = null;
      this.inputField.holiday_date = null;
    },
    async remove(id){
        const { data } = await axios.delete(`/holidays/${id}`);
        this.holidays = this.holidays.filter((holiday) => holiday.id !== id);
    }
  }
});
