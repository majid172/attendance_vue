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
            <h5 class="mb-0">Monthly Report</h5>
          </div>
          <div class="card-body">
           
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
