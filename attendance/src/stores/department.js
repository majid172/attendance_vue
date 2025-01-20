import { ref } from "vue";
import { defineStore } from "pinia";
import axios from "axios";
export const useDepartmentStore = defineStore('departmentStore', {
  state: () => ({
    departments: [],
    inputField:{
      dep_name: '',
      dep_id: null
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
      this.inputField.dep_id = data.id;
    },
    async update(){
      const id = this.inputField.dep_id;
      const {data} = await axios.put(`/department/${id}/`,this.inputField)

      if (data) {
        // Update the local departments list with the updated data
        this.departments = this.departments.map(department =>
          department.id == id ? { ...department, name: this.inputField.dep_name } : department
        );
      }

    },

    async remove(id){
      await axios.delete( `/department/${id}`);
      this.departments = this.departments.filter((department) => department.id !== id);
    }
  },
});
