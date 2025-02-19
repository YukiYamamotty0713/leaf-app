<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
  <div
    class="flex min-h-screen flex-col items-center bg-primary_color pt-6 sm:justify-center sm:pt-0"
  >
    <application-logo />
    <div
      class="mt-6 w-[calc(100vw-40px)] max-w-md mx-auto overflow-hidden bg-gray-100 px-6 py-4 shadow-md rounded-lg text-white shadow-lg"
    >
      <slot />
    </div>
  </div>
</template>