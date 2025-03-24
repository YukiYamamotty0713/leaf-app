### 概要
英単語学習アプリ「Leaf」のアプリケーションリポジトリです。  
効率的かつ効果的な英単語学習をサポートします。


### 使用している技術
- **バックエンド：** Laravel  
- **フロントエンド：** Vue、Typescript、TailwindCSS  
- **データベース：** MySQL
- **webサーバー：** Nginx
- **外部API：** GeminiAPI

### 使用しているデザインパターン
- **バックエンド:** Repository/Serviceパターン
、Serviceはビジネスロジックを担当
  
- **フロントエンド:** Atomic Design

### CI/CDパイプライン
Github Actionsを使用(workflow/ci.yml)
トリガー: mainブランチに対するpush、もしくはmainブランチに対するpull request
ビルドが通過すれば、herokuへプッシュ

### ユニットテスト
PHPUnit , Jest
