import { ref } from "vue";
import { defineStore } from "pinia";
import axios from "axios";
export const useDepartmentStore = defineStore('departmentStore', {
  state: () => ({
    departments: [],
    inputField:{
      dep_name: ''
    }
  }),
  actions: {
    async list() {
      const {data} = await axios.get('/department');
      this.departments = data;
    },
    async edit(id){
      const {data} = await axios.get(`/department/${id}/edit`);
      this.inputField.dep_name = data.name;
    },
    async remove(id){
      await axios.delete( `/department/${id}`);
      this.departments = this.departments.filter((department) => department.id !== id);
    }
  },
});
