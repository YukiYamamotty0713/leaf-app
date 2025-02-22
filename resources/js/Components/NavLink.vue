<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-2 pt-1 border-b-2 border-accent text-sm font-semibold text-gray-900 focus:outline-none focus:border-accent transition duration-150 ease-in-out bg-gradient-to-r'
        : 'inline-flex items-center px-2 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out',
);

</script>

<template>
    <Link :href="href" :class="classes">
        {{ active ? '📍' : '' }}
        <slot />
    </Link>
</template>
