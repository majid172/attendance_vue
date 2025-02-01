<script setup>
import InputField from '../InputField.vue';
import SelectField from '../SelectField.vue';
import { useMonthlyStore } from '@/stores/monthly';
import { useDepartmentStore } from '@/stores/department';
import { onMounted } from 'vue';
// Initialize the Pinia store
const monthlyStore = useMonthlyStore();
const departmentStore = useDepartmentStore();
onMounted(()=>{
    departmentStore.list();

})
</script>

<template>
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-6">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Basic with Icons</h5>
          </div>
          <div class="card-body">
            <form @submit.prevent="">
              <!-- Row 1: Month and Report Type -->
              <div class="row">
                <div class="col-lg-6">
                  <InputField label="Select Month" type="month" icon="bx bx-calendar" placeholder="Enter month" v-model="monthlyStore.inputField.month" />
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label me-3">Select Report Type *</label>
                    <div class="d-flex gap-4 align-items-center">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="radio"
                          v-model="monthlyStore.inputField.report_type"
                          id="individual"
                          value="individual"
                        />
                        <label class="form-check-label" for="individual">Individual</label>
                      </div>
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="radio"
                          v-model="monthlyStore.inputField.report_type"
                          id="all"
                          value="all"
                        />
                        <label class="form-check-label" for="all">ALL</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Row 2: Department and Employee (Conditionally Rendered) -->
              <div class="row" v-if="monthlyStore.inputField.report_type === 'individual'">
                <div class="col-lg-6">

                  <SelectField
                    label="Select Department" :options="departmentStore.departments" displayKey="name" v-model="monthlyStore.inputField.department" @change="monthlyStore.getEmployee()"
                    icon="bx bx-building"
                    placeholder="Enter department"
                  />
                </div>
                <div class="col-lg-6">
                  <SelectField
                    label="Select Employee"
                    :options="monthlyStore.employees"
                    icon="bx bx-user" v-model = "monthlyStore.inputField.employee" displayKey="full_name"
                    placeholder="Enter employee"
                  />
                </div>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn btn-primary">Send</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
