<template>
    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6 border border-gray-200">
        <!-- タイトルなどを表示するスロット -->
        <slot name="header">
            <!-- デフォルトのタイトル（必要なら） -->
            <h2 class="text-2xl font-bold text-primary_color mb-4">Default Title</h2>
        </slot>
        
        <!-- メインコンテンツのスロット -->
        <slot>
            <!-- デフォルトのコンテンツ（必要なら） -->
            <p class="text-gray-700">
                This is the default content if no content is provided.
            </p>
        </slot>
    </div>
</template>

<style scoped>
.text-primary_color {
  @apply text-[#B69F7E]; /* ベースカラー */
}
</style>