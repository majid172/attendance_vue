<script setup>
import {ref, onMounted, computed} from "vue";
import {useHolidayStore} from "@/stores/holiday.js";
import Pagination from "@/components/Pagination.vue";
const holidayStore = useHolidayStore();
const currentPage = ref(1);
const itemPerPage = 10;
const paginate = computed(()=>{
  const  start = (currentPage.value -1)*itemPerPage;
  const end = start+itemPerPage;
  return holidayStore.holidays.slice(start,end);
})
const totalPages = computed(() => Math.ceil(holidayStore.holidays.length / itemPerPage));

// Navigate to a specific page
const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
  }
};

onMounted(()=>{
  holidayStore.list()
})
</script>
<template>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-end mb-3">

      <!-- Button trigger modal -->
      <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalCenter">
        Add Holiday
      </button>
      <!-- Modal -->
      <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Daily Report</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form>
              <div class="modal-body">
                <div class="mb-6">
                  <label class="form-label" for="defaultSelect">Select Date</label>
                  <select id="defaultSelect" class="form-select">
                    <option>Default select</option>
                    <option value="1"> One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                  Close
                </button>
                <button type="button" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>


      <!--          <router-link to="/create-employee" class="btn btn-primary">Add Employee</router-link>-->
    </div>
    <div class="card">
      <h5 class="card-header">Holidays</h5>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>SL</th>
            <th>Date</th>
            <th>Type</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody class="table-border-bottom-0">
          <tr v-for="(item,index) in paginate">
            <td>{{ (currentPage -1) * itemPerPage +index+1  }}</td>
            <td>{{item.holiday_date}}</td>
            <td>{{item.holiday_name}}</td>

            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>

          </tbody>
        </table>
      </div>
      <div class="card-footer d-flex justify-content-end">
        <!-- Pagination Component with event handling -->
        <Pagination
          :currentPage="currentPage"
          :totalPages="totalPages"
          @changePage="changePage"
        />
      </div>
    </div>
  </div>
</template>
