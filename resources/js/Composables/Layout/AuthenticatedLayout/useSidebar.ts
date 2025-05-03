import { computed, ref, Ref, ComputedRef } from 'vue';

export function useSidebar(defaultBool:boolean = false) {

    const showSidebarMobile: Ref<boolean> = ref<boolean>(defaultBool);

    const toggleSidebar = () => {
        showSidebarMobile.value = !showSidebarMobile.value;
    };

    const sidebarIcon : ComputedRef<string> = computed(() => showSidebarMobile.value ? '×' : '≡');

    return {
        showSidebarMobile,
        toggleSidebar,
        sidebarIcon
    };
}