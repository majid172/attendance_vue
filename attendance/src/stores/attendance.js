import {ref} from "vue";
import axios from "axios";
import {defineStore} from "pinia";
export const useAttendanceStore = defineStore('attendance',{
  state:()=>({
    attendances:[],
    inputField:{
      date: null
    }
  }),
  actions:{
    async list (){
      const {data} = await axios.get('/attendance');
      console.log(data);
      this.attendances = data;
    },
    async filterList(){
      // console.log(this.inputField);
      const {data } = await axios.post('/attendance',this.inputField);
      this.attendances = data;
      // this.inputField = null
    },

  }
})
