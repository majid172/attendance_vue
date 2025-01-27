<template>
  <div class="card h-100">
    <div class="card-body">
      <div class="card-title d-flex align-items-start justify-content-between mb-4">
        <div class="avatar flex-shrink-0">
          <slot name="image"></slot>
        </div>
        <div class="dropdown">
          <button
            class="btn p-0"
            type="button"
            id="cardOpt1"
            data-bs-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded text-muted"></i>
          </button>

        </div>
      </div>
      <slot name="title"></slot>
      <slot name="totalValue"></slot>
      <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
    </div>
  </div>
</template>
<script setup lang="ts">
</script>
