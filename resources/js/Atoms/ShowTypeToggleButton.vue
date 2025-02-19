<script setup lang="ts">
import { ref } from 'vue';

const activeSide = ref<string>("right");

const toggleSide = () => {
  activeSide.value = activeSide.value === "right" ? "left" : "right";
};
</script>

<template>
  <div
    @click="toggleSide"
    class="toggle-button-wrapper"
  >
    <div
      class="button"
      :class="{ 'active': activeSide === 'right' }"
    >
      <span class="text">Card</span>
    </div>
    <div
      class="button"
      :class="{ 'active': activeSide === 'left' }"
    >
      <span class="text">List</span>
    </div>
    <div class="slider" :class="{ 'slide-left': activeSide === 'left' }"></div>
  </div>
</template>

<style scoped>
.toggle-button-wrapper {
  @apply w-[120px] h-[40px] bg-gray-200 rounded-full relative overflow-hidden shadow-inner shadow-lg; /* Increased width, rounded corners, shadow */
  @apply flex items-center cursor-pointer; /* Flexbox for alignment */
}

.button {
  @apply w-1/2 h-full flex justify-center items-center z-10; /* Equal width, centered content, higher z-index */
  @apply text-gray-500 font-medium transition-colors duration-300; /* Text styling and transition */
}

.active {
  @apply text-white; /* Active text color */
}

.slider {
  @apply absolute w-1/2 h-full rounded-full bg-gradient-to-r from-gray-500 to-gray-600 transition-transform duration-300 ease-in-out; /* Slider styling and transitions */
  left: 0; /* Initial position */
}

.slide-left {
  @apply transform translate-x-full; /* Slide to the left */
}

.text {
  @apply text-base; /* Slightly smaller text */
}
</style>