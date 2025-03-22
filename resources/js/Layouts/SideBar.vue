<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { routes } from './menus';
import NavLink from '@/Components/NavLink.vue';
import { ref } from 'vue';
const page = usePage();
const pageroute:any = page.props.route;
const hoveredItem = ref<string | null>(null);
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faRightFromBracket } from '@fortawesome/free-solid-svg-icons';

console.log(pageroute);
console.log(routes);
</script>

<template>
  <div class="flex flex-col items-center justify-between py-12 gap-y-4 w-64 bg-blue-900">
    <div 
      v-for="item in routes" 
      :key="item.route"
      class="flex justify-start w-full pl-6"
      @mouseenter="hoveredItem = item.route"
      @mouseleave="hoveredItem = null"
    >
      <nav-link 
        :href="item.route"
        class="flex items-center gap-3 hover:text-white px-2 py-2 text-lg font-medium w-full transition-all duration-300"
        :class="[
          pageroute.name === item.route ? 'text-white font-bold' : '',
          hoveredItem === item.route ? 'translate-x-1' : ''
        ]"
        :active="pageroute.name === item.name"
      >
        <font-awesome-icon 
          :icon="item.icon" 
          class="w-5 h-5 transition-transform duration-300"
          :class="[
            hoveredItem === item.route ? 'rotate-6 scale-110' : '',
            pageroute.name === item.route ? 'text-white' : 'text-gray-300'
          ]"
        />
        <span>{{ item.title }}</span>
      </nav-link>
    </div>
    
    <div 
      class="flex justify-start w-full pl-6 mt-auto"
      @mouseenter="hoveredItem = 'logout'"
      @mouseleave="hoveredItem = null"
    >
      <nav-link 
        href="/logout"
        class="flex items-center gap-3 hover:text-white px-2 py-2 text-lg font-medium w-full transition-all duration-300"
        :class="hoveredItem === 'logout' ? 'translate-x-1' : ''"
      >
        <font-awesome-icon 
          :icon="faRightFromBracket" 
          class="w-5 h-5 text-gray-300 transition-transform duration-300"
          :class="hoveredItem === 'logout' ? 'rotate-6 scale-110 text-white' : ''"
        />
        <span>ログアウト</span>
      </nav-link>
    </div>
  </div>
</template>