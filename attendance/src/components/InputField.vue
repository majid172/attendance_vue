<script setup>
import { ref, watch } from "vue";

const props = defineProps({
  label: { type: String, required: true },
  modelValue: { type: [String, Number], required: true },
  placeholder: { type: String, default: "" },
  type: { type: String, default: "text" },
  icon: { type: String, default: "" }, // Optional icon class
});

const emit = defineEmits(["update:modelValue"]);

const inputValue = ref(props.modelValue);

// Sync the input value with the parent component
watch(inputValue, (newValue) => {
  emit("update:modelValue", newValue);
});
</script>
<template>
  <label class="form-label" :for="label">{{ label }}</label>
  <div class="input-group input-group-merge">
      <span v-if="icon" class="input-group-text">
        <i :class="icon"></i>
      </span>
    <input
      :type="type"
      class="form-control"
      :id="label"
      :placeholder="placeholder"
      v-model="inputValue"
      :aria-label="placeholder"
    />
  </div>
<!--  <input-->
<!--    type="text"-->
<!--    id="nameWithTitle"-->
<!--    class="form-control"-->
<!--    placeholder="Enter Name" />-->
</template>
