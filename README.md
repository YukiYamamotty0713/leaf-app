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

---

### 🎨 採用しているデザインパターン

#### 🔧 バックエンド：Repository / Service パターン

- **Repository：** DB や外部APIなど、データアクセス層の責務を分離  
- **Service：** ビジネスロジックを担当  
- **Controller：** 入力の受け取りとエラーハンドリングを担当

#### アダプターパターン
- **Adapter:** 外部APIとの接続の際は、Adapterにラップ
ex) gemini

#### 🧱 フロントエンド：Atomic Design

| レイヤー     | 説明                                                                 |
|--------------|----------------------------------------------------------------------|
| **Atom**     | 単純なUIパーツ（ボタン、アイコンなど）                              |
| **Molecule** | 複数のAtomを組み合わせたUIパーツ（検索ボックスなど）                |
| **Organism** | ページ構成単位の複合パーツ（登録フォーム、モーダルの中身など）      |
| **Template** | レイアウトテンプレート（印刷対応や複雑なレスポンシブ構造時）         |
|


### 📄 ドキュメントリンク

- [要件定義](docs/要件定義.md)
- [テーブル定義](docs/テーブル定義.md)
