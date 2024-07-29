# RESE- レストラン予約管理システム
## 作成した目的
外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。
### 注意事項
- ログインが必要です。初回利用時にはユーザー登録を行ってください。
- 管理者権限を持つアカウントを使用している場合、管理パネルにアクセスできます。

## アプリケーションURL
[Reseアプリケーション](https://rese-app.example.com)

## 機能一覧
- ユーザー登録およびログイン機能
- レストランの検索とフィルタリング
- お気に入り店舗の追加・削除
- 店舗の予約機能
- 予約後の評価とレビュー投稿機能
- 管理者による店舗代表者の管理
- QRコードを利用した予約確認

- ## 使用技術
- **言語とフレームワーク**: PHP 7.4, Laravel 8.x
- **データベース**: MySQL
- **フロントエンド**: HTML, CSS, JavaScript, Blade
- **その他**: Composer, Git, Simple QrCode

## 環境構築
以下の手順に従ってプロジェクトをセットアップします。

1. リポジトリをクローンします。
   ```bash
   git clone https://github.com/username/rese.git
   cd rese
2. Composerで依存関係をインストールします。
   ```bash
   composer install
3. 環境設定ファイルを作成し、設定を行います。
   ```bash
   cp .env.example .env
   php artisan key:generate
4. 環境設定ファイル.envの以下の項目を設定します。
- **DB_CONNECTION=mysql**:
- **DB_HOST=rese_mysql_1**:
- **DB_PORT=3306**:
- **DB_DATABASE=laravel_db**:
- **DB_USERNAME=laravel_user**:
- **DB_PASSWORD=laravel_pass**:
5. データベースをマイグレートし、シーディングを行います。
   ```bash
   php artisan migrate --seed
6. ローカルサーバーを起動します。
   ```bash
   php artisan serve
7. ブラウザでhttp://localhost:8000を開き、アプリケーションを確認します。
## ER図
　![ER図](images\image.png)
