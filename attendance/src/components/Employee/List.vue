<template>
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header d-inline-flex justify-content-between">
        <h5 >Employee List</h5>
        <div class="">
            <!-- Button trigger modal -->
            <button
              type="button"
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#modalCenter">
              Add Employee
            </button>
            <!-- Modal -->
            <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Add New Employee</h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"></button>
                  </div>
                  <form>
                  <div class="modal-body">
                      <div class="mb-6">
                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                          <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                        </div>
                      </div>
                      <div class="mb-6 text-left">
                        <label class="form-label" for="basic-icon-default-company">Company</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                          <input type="text" id="basic-icon-default-company" class="form-control" placeholder="ACME Inc." aria-label="ACME Inc." aria-describedby="basic-icon-default-company2">
                        </div>
                      </div>
                      <div class="mb-6">
                        <label class="form-label" for="basic-icon-default-email">Email</label>
                        <div class="input-group input-group-merge">
                          <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                          <input type="text" id="basic-icon-default-email" class="form-control" placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-icon-default-email2">
                          <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                        </div>
                        <div class="form-text">You can use letters, numbers &amp; periods</div>
                      </div>
                      <div class="mb-6">
                        <label class="form-label" for="basic-icon-default-phone">Phone No</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                          <input type="text" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2">
                        </div>
                      </div>
                      <div class="mb-6">
                        <label class="form-label" for="basic-icon-default-message">Message</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                          <textarea id="basic-icon-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                        </div>
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
      </div>

      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
          <tr>
            <th>Emp Id</th>
            <th>Name</th>
            <th>Department</th>
            <th>Designation</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody class="table-border-bottom-0">
          <tr>
            <td><i class="bx bxl-angular bx-md text-danger me-4"></i> <span>Angular Project</span></td>
            <td>Albert Cook</td>
            <td> IT </td>
            <td>Software Engineer</td>
            <td>+8801969-362422</td>
            <td><span class="badge bg-label-primary me-1">Active</span></td>
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
          <tr>
            <td><i class="bx bxl-react bx-md text-info me-4"></i> <span>React Project</span></td>
            <td>Barry Hunter</td>
            <td> IT </td>
            <td>Software Engineer</td>
            <td>+8801969-362422</td>
            <td><span class="badge bg-label-success me-1">Completed</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><i class="bx bxl-vuejs bx-md text-success me-4"></i> <span>VueJs Project</span></td>
            <td>Trevor Baker</td>
            <td> IT </td>
            <td>Software Engineer</td>
            <td>+8801969-362422</td>
            <td><span class="badge bg-label-info me-1">Scheduled</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><i class="bx bxl-bootstrap bx-md text-primary me-4"></i> <span>Bootstrap Project</span></td>
            <td>Jerry Milton</td>
            <td> IT </td>
            <td>Software Engineer</td>
            <td>+8801969-362422</td>
            <td><span class="badge bg-label-warning me-1">Pending</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</template>
<script setup lang="ts">
</script>
