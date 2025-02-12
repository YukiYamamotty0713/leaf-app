<template>
    <div class="bg-white shadow-sm sm:rounded-lg p-6 border border-gray-200">
            <h2 class="text-2xl font-bold text-primary mb-2">
                <slot name="header"/>
            </h2>
        <slot/>
    </div>
</template>
