<template>
    <div class="bg-white shadow-sm sm:rounded-lg p-6 border border-gray-200 max-w-full">
            <h2 class="text-2xl font-bold text-slate-800 mb-2">
                <slot name="header"/>
            </h2>
        <slot/>
    </div>
</template>
