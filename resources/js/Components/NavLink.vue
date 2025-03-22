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
        ? 'inline-flex items-center px-2 pt-1 border-b-2 border-accent text-sm font-semibold text-white focus:text-slate-200 transition duration-150 ease-in-out'
        : 'inline-flex items-center px-2 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-300 hover:text-white focus:text-slate-200 transition duration-150 ease-in-out',
);

</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
