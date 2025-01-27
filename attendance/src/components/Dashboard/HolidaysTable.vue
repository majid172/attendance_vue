<div class="card h-100">
<div class="card-header d-flex justify-content-between">
  <div class="card-title mb-0">
    <slot name="title"></slot>

    <!--              <p class="card-subtitle">Current month {{dashboardStore.upcomingHolidays.length}} holidays</p>-->
  </div>

</div>
<div class="card-body">
  <ul class="p-0 m-0" v-for="(item,index) in dashboardStore.upcomingHolidays">
    <li class="d-flex align-items-center mb-5">
      <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"
                            >{{++index}}</span>
      </div>
      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
        <div class="me-2">
          <h6 class="mb-0">{{ item.holiday_name }}</h6>
          <small>{{ item.holiday_date }}</small>
        </div>
      </div>
    </li>

  </ul>
</div>
</div>
