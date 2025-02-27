<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { routes } from './menus';  // menus.ts の場所は適宜調整してください
import NavLink from '@/Components/NavLink.vue';
import { ref, onMounted, onUnmounted } from 'vue';


const props = defineProps<{
    show: boolean;
}>();

const emit = defineEmits(['close']);


const page = usePage();
const pageroute: any = page.props.route;

const close = () => {
    emit('close');
};

const closeOnEscape = (event: KeyboardEvent) => {
  if (event.key === 'Escape' && props.show) {
    close();
  }
};

onMounted(() => {
  document.addEventListener('keydown', closeOnEscape);
});

onUnmounted(() => {
  document.removeEventListener('keydown', closeOnEscape);
});

</script>

<template>
  <Transition
    enter-active-class="transition duration-200 ease-out"
    enter-from-class="transform opacity-0"
    enter-to-class="opacity-100"
    leave-active-class="transition duration-200 ease-in"
    leave-from-class="opacity-100"
    leave-to-class="transform opacity-0"
  >
    <div v-if="show" class="fixed inset-0 z-40 flex">
      <Transition
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition duration-200 ease-in"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <div
          class="fixed inset-0 bg-black bg-opacity-50"
          aria-hidden="true"
          @click="close"
        ></div>
      </Transition>

      <Transition
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="transform translate-x-full"
        enter-to-class="translate-x-0"
        leave-active-class="transition duration-200 ease-in"
        leave-from-class="translate-x-0"
        leave-to-class="transform translate-x-full"
      >
        <div
          class="relative flex flex-col w-full max-w-xs h-full overflow-y-auto bg-secondary shadow-xl"
        >
          <div class="absolute top-0 right-0 pt-2 pr-2">
             <button
              type="button"
              class="rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
              @click="close"
             >
                <span class="sr-only">Close menu</span>
                <!-- Heroicon name: outline/x -->
                <svg
                    class="h-6 w-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
             </button>
          </div>
            <div class="flex flex-col items-center justify-between py-12 gap-y-4 w-full  border-l-4 border-l-black">
                <div
                    v-for="item in routes"
                    :key="item.route"
                    class="flex justify-start w-full pl-6"
                >
                    <nav-link
                        :href="route(item.route)"
                        class="hover:text-white px-2 py-2 text-lg font-medium"
                        :active="pageroute.name === item.route"
                    >
                        {{ item.title }}
                    </nav-link>
                </div>
                <div class="flex justify-start w-full pl-6">
                    <nav-link
                        href="/logout"
                        class="hover:text-white px-2 py-2 text-lg font-medium"
                    >
                        ログアウト
                    </nav-link>
                </div>
            </div>
        </div>
      </Transition>
    </div>
  </Transition>
</template>

<style scoped>
/* Add any custom styles for your mobile sidebar here */
</style>