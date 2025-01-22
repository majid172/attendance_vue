<script setup>
import { ref, watch } from "vue";

const props = defineProps({
  label: { type: String, required: true },
  modelValue: { type: [String, Number, Date,null], required: true },
  placeholder: { type: String, default: "" },
  type: { type: String, default: "text" },
  id: { type: String },
  icon: { type: String, default: "" },
});

const emit = defineEmits(["update:modelValue"]);

// Initialize `inputValue` with `modelValue`
const inputValue = ref(props.modelValue);

// Watch for changes in `modelValue` (from parent) and update `inputValue`
watch(
  () => props.modelValue,
  (newValue) => {
    inputValue.value = newValue;
  },
  { immediate: true } // Ensure it runs immediately to initialize the value
);

// Watch for changes in `inputValue` (from the input field) and emit to parent
watch(inputValue, (newValue) => {
  emit("update:modelValue", newValue);
});
</script>

<template>
  <label class="form-label" :for="id || label">{{ label }}</label>
  <div class="input-group input-group-merge">
    <span v-if="icon" class="input-group-text">
      <i :class="icon"></i>
    </span>
    <input
      :type="type"
      class="form-control"
      :id="id"
      :placeholder="placeholder"
      v-model="inputValue"
      :aria-label="placeholder"
    />
  </div>
</template>

