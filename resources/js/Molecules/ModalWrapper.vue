<template>
    <Transition
      enter-active-class="transition duration-300 ease-out"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition duration-300 ease-in"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-if="isOpen"
        class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50"
        @click.self="close"
      >
        <Transition
          enter-active-class="transition duration-300 ease-out"
          enter-from-class="transform scale-95 opacity-0"
          enter-to-class="transform scale-100 opacity-100"
          leave-active-class="transition duration-300 ease-in"
          leave-from-class="transform scale-100 opacity-100"
          leave-to-class="transform scale-95 opacity-0"
        >
          <div class="bg-white rounded-lg p-6 max-w-md w-full relative">
            <!-- 閉じるボタン（×） -->
            <button
              @click="close"
              class="absolute top-2 right-2 p-1 hover:bg-gray-100 rounded-full text-gray-500"
            >
              <span class="text-xl">&times;</span>
            </button>
  
            <!-- コンテンツエリア -->
            <div class="mt-4">
              <slot />
            </div>
  
            <!-- 閉じるボタン -->
            <div class="mt-6 text-right">
              <button
                @click="close"
                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition-colors"
              >
                閉じる
              </button>
            </div>
          </div>
        </Transition>
      </div>
    </Transition>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue'
  
  const isOpen = ref(false)
  
  const open = () => {
    isOpen.value = true
  }
  
  const close = () => {
    isOpen.value = false
  }
  
  defineExpose({
    open,
    close
  })
  </script>