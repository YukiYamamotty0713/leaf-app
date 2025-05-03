import { useSidebar } from './useSidebar';
import { describe, it, expect } from '@jest/globals';

describe('useSidebar', () => {
  it('初期値がfalseの場合、showSidebarMobileはfalseで、sidebarIconは≡であること', () => {
    const { showSidebarMobile, sidebarIcon } = useSidebar();
    expect(showSidebarMobile.value).toBe(false);
    expect(sidebarIcon.value).toBe('≡');
  });

  it('初期値がtrueの場合、showSidebarMobileはtrueで、sidebarIconは×であること', () => {
    const { showSidebarMobile, sidebarIcon } = useSidebar(true);
    expect(showSidebarMobile.value).toBe(true);
    expect(sidebarIcon.value).toBe('×');
  });

  it('toggleSidebarを呼び出すと、showSidebarMobileの値が反転すること', () => {
    const { showSidebarMobile, toggleSidebar } = useSidebar();

    // 初期値はfalse
    expect(showSidebarMobile.value).toBe(false);

    // 1回目のtoggleでtrueになる
    toggleSidebar();
    expect(showSidebarMobile.value).toBe(true);

    // 2回目のtoggleでfalseに戻る
    toggleSidebar();
    expect(showSidebarMobile.value).toBe(false);
  });

  it('showSidebarMobileの値が変更されると、sidebarIconの値も連動して変わること', () => {
    const { showSidebarMobile, sidebarIcon } = useSidebar();

    // 初期値
    expect(showSidebarMobile.value).toBe(false);
    expect(sidebarIcon.value).toBe('≡');

    // showSidebarMobileをtrueに変更
    showSidebarMobile.value = true;
    expect(sidebarIcon.value).toBe('×');

    // showSidebarMobileをfalseに戻す
    showSidebarMobile.value = false;
    expect(sidebarIcon.value).toBe('≡');
  });
});