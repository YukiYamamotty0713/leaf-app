<template>
  <div class="logo-container">

  </div>
</template>

<script setup>
import { computed } from 'vue';

/**
 * @typedef {Object} Props
 * @property {string} [width='w-20'] - Tailwind CSSの幅クラス。デフォルトは 'w-20'。
 * @property {string} [height='h-20'] - Tailwind CSSの高さクラス。デフォルトは 'h-20'。
 */

/**
 * LogoComponentはロゴ画像を表示するためのコンポーネントです。
 * 親コンポーネントから幅と高さを指定することができます。
 * @component
 * @param {Props} props - コンポーネントのプロパティ。
 */
const props = defineProps({
  width: {
    type: String,
    default: 'w-20', // デフォルトの幅
  },
  height: {
    type: String,
    default: 'h-20', // デフォルトの高さ
  },
});

/**
 * @function computedSize
 * @description widthとheightのプロパティを組み合わせて、動的にクラス名を生成します。
 * @returns {string} - 組み合わせたクラス名。デフォルトは"w-20 h-20"
 */
const computedSize = computed(() => {
  return `${props.width} ${props.height}`;
});
</script>

