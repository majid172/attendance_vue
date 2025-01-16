import {ref} from "vue";
import axios from "axios";
import {defineStore} from "pinia";
export const useAttendanceStore = defineStore('attendance',{
  state:()=>({
    attendances:[]
  }),
  actions:{
    async list (){
      const {data} = await axios.get('attendance');
      console.log(data);
      this.attendance = data;
    }
  }
})
