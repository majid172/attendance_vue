import { ref } from "vue";
import { defineStore } from "pinia";
import axios from "axios";
export const useDepartmentStore = defineStore('departmentStore', {
  state: () => ({
    departments: [],
  }),
  actions: {
    async list() {
      const {data} = await axios.get('/department');
      this.departments = data;
    },
  },
});
