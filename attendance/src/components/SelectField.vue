<script setup>
import { ref, watch } from "vue";

const props = defineProps({
  label: { type: String, required: true },
  modelValue: { type: [String, Number], required: true },
  options: { type: Array, required: true }, // Array of options
  displayKey: { type: String, required: true },
  icon: { type: String, default: "" }, // Optional icon class
});

const emit = defineEmits(["update:modelValue"]);

const selectedValue = ref(props.modelValue);

// Sync the selected value with the parent component
watch(selectedValue, (newValue) => {
  emit("update:modelValue", newValue);
});
</script>

<template>
  <div class="mb-4">
    <label class="form-label" :for="label">{{ label }}</label>
    <div class="input-group input-group-merge">
      <span v-if="icon" class="input-group-text">
        <i :class="icon"></i>
      </span>
      <select
        class="form-select"
        :id="label"
        v-model="selectedValue"
        :aria-label="label"
      >
        <option disabled value="">Select an option</option>
        <option v-for="option in options" :key="option.id" :value="option.id">
          {{ option[displayKey] }}
        </option>                
      </select>
    </div>
  </div>
</template>

