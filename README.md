### 概要
こちらは英単語学習アプリ「Leaf」のアプリケーションリポジトリです。  
Leafはシンプルながらも機能豊富な設計を採用し、効率的かつ効果的な英単語学習をサポートします。
直感的な操作性と高いパフォーマンスを目指して作成しました。

**webサーバー：** Nginx

### 使用している技術
- **バックエンド：** Laravel  
- **フロントエンド：** Vue、Typescript、TailwindCSS  
- **データベース：** MySQL  
- **外部API：** GeminiAPI

### 使用しているデザインパターン
- **バックエンド:** Repository/Serviceパターン
  説明:外部データアクセス層（DB,API)をRepositoryに委譲し、Serviceはビジネスロジックを担当
  Controllerは受け取るデータとエラーハンドリングを担当
  
- **フロントエンド:** Atomic Design
  Atom...単純なUIパーツ
  Molecule...UIパーツを組み合わせたものを
  Organisms...ページの１構成（モーダルの中身や登録フォームなど）
  Template...Pagesが条件によって複数ページにまたがるときに実装（印刷や、複雑なレスポンシブデザインになったとき）
  Pages...Webページ全体のコンポーネント

### ワークフロー
Github Actionsを使用(workflow/ci.yml)
トリガー: mainブランチに対するpush、もしくはmainブランチに対するpull request

#### ビルドジョブ
1.コードのチェックアウトおよびPHPのセットアップ
2.composerのインストール
3.ビルド

#### デプロイジョブ
HerokuCLIのインストール,およびHerokuリモートリポジトリに強制的にプッシュ
※機密情報はGithub Secretsにて保護


### ユニットテスト
PHPUnit , Jest
