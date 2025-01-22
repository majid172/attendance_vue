import {defineStore} from "pinia";
import axios from "axios";
export const useHolidayStore = defineStore('holiday',{
  state:()=>({
    holidays:[],
    inputField:{
      holiday_id: null,
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
    async edit(id)
    {
      const {data} = await axios.get(`/holidays/${id}/edit`);
      this.inputField.holiday_id = data.id;
      this.inputField.holiday_name = data.holiday_name;
      this.inputField.holiday_date = data.holiday_date;
    },
    async update()
    {
      const id = this.inputField.holiday_id;
      const {data} = await axios.put(`/holidays/${id}`,this.inputField);
      if (data) {
        this.holidays = this.holidays.map(holiday =>
          holiday.id == id ? { ...holiday, holiday_name: this.inputField.holiday_name } : holiday
        );
      }

    },
    async remove(id){
        const { data } = await axios.delete(`/holidays/${id}`);
        this.holidays = this.holidays.filter((holiday) => holiday.id !== id);
    }
  }
});
