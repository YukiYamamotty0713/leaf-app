# カラーシステム

プロジェクトで使用するカラーシステムのドキュメントです。

## 背景色（Background Colors）

| 名前 | カラーコード | プレビュー | 用途 |
|------|------------|------------|------|
| Primary | `#B69F7E` | ![Primary](https://via.placeholder.com/15/B69F7E/B69F7E.png) | メインの背景色 |
| Secondary | `#8C7A63` | ![Secondary](https://via.placeholder.com/15/8C7A63/8C7A63.png) | セカンダリの背景色 |
| Accent | `#566A56` | ![Accent](https://via.placeholder.com/15/566A56/566A56.png) | アクセントとして使用 |
| Light | `#F5F5F5` | ![Light](https://via.placeholder.com/15/F5F5F5/F5F5F5.png) | 明るい背景 |
| Dark | `#2D2D2D` | ![Dark](https://via.placeholder.com/15/2D2D2D/2D2D2D.png) | 暗い背景 |
| Muted | `#E5E5E5` | ![Muted](https://via.placeholder.com/15/E5E5E5/E5E5E5.png) | 控えめな背景 |

## テキストカラー（Text Colors）

| 名前 | カラーコード | プレビュー | 用途 |
|------|------------|------------|------|
| Primary | `#2D2D2D` | ![Primary](https://via.placeholder.com/15/2D2D2D/2D2D2D.png) | メインテキスト |
| Secondary | `#4A4A4A` | ![Secondary](https://via.placeholder.com/15/4A4A4A/4A4A4A.png) | サブテキスト |
| Accent | `#566A56` | ![Accent](https://via.placeholder.com/15/566A56/566A56.png) | アクセントテキスト |
| Light | `#FFFFFF` | ![Light](https://via.placeholder.com/15/FFFFFF/FFFFFF.png) | 明るいテキスト |
| Dark | `#1A1A1A` | ![Dark](https://via.placeholder.com/15/1A1A1A/1A1A1A.png) | 暗いテキスト |
| Muted | `#6B6B6B` | ![Muted](https://via.placeholder.com/15/6B6B6B/6B6B6B.png) | 控えめなテキスト |

## 使用例

### Tailwindでの使用
```html
<!-- 背景色の使用 -->
<div class="bg-primary">プライマリ背景</div>
<div class="bg-secondary">セカンダリ背景</div>
<div class="bg-accent">アクセント背景</div>
<div class="bg-muted">控えめな背景</div>

<!-- テキストカラーの使用 -->
<div class="text-primary">プライマリテキスト</div>
<div class="text-secondary">セカンダリテキスト</div>
<div class="text-accent">アクセントテキスト</div>
<div class="text-muted">控えめなテキスト</div>
```

### コンポーネントでの使用例
- ヘッダー: `bg-primary text-light`
- メインコンテンツ: `bg-light text-primary`
- サイドバー: `bg-secondary text-light`
- ボタン: `bg-accent text-light`
- 補足テキスト: `text-muted`

## 設定ファイル

### tailwind.config.js
```javascript
module.exports = {
  theme: {
    extend: {
      backgroundColor: {
        primary: '#B69F7E',
        secondary: '#8C7A63',
        accent: '#566A56',
        light: '#F5F5F5',
        dark: '#2D2D2D',
        muted: '#E5E5E5',
      },
      textColor: {
        primary: '#2D2D2D',
        secondary: '#4A4A4A',
        accent: '#566A56',
        light: '#FFFFFF',
        dark: '#1A1A1A',
        muted: '#6B6B6B',
      }
    }
  }
}
```

## 更新履歴

- 2024-11-09: カラーシステムの初期設定
- 2024-11-09: Muted カラーの追加（背景色とテキストカラー）