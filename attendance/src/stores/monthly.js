import { defineStore } from "pinia";
import axios from "axios";

export const useMonthlyStore = defineStore("monthlyStore", {
  state: () => ({
    employees: [],
    inputField: {
      month: "",
      report_type: "all",
      department: "",
      employee: "",
    },
  }),
  actions: {
    async getEmployee() {
      try {
        const depId = this.inputField.department;
        if (!depId) return;

        const { data } = await axios.get(`/employee/${depId}`);
        this.employees = data;
      } catch (error) {
        console.error("Error fetching employees:", error);
      }
    },
    async monthlyReport() {
      try {
        const empId = this.inputField.employee;
        if (!empId) return;

        const { data } = await axios.put(`/attendance/${empId}`, this.inputField);
        this.employees = data;
        const report = this.employees;
        return report;
      } catch (error) {
        console.error("Error submitting report:", error);
        return false; // Indicate failure
      }
    },
  },
});
