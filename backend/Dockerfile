# 基本的なPHPとApacheのセットアップ
FROM php:8.2-apache

# 作業ディレクトリの設定
WORKDIR /var/www/html

# 必要な拡張機能のインストール
RUN docker-php-ext-install pdo pdo_mysql

# Composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ApacheのドキュメントルートをLaravelのpublicディレクトリに設定
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Apacheのmod_rewriteを有効化
RUN a2enmod rewrite

# Laravelプロジェクトのソースコードをコピー
COPY ./src /var/www/html

# storage と bootstrap/cache フォルダに書き込み権限を設定（Composerインストール前にも実施）
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# ComposerでLaravel依存関係をインストール
RUN composer install --no-scripts --no-autoloader --no-cache

# 再度、storage と bootstrap/cache フォルダに書き込み権限を設定（ファイルが追加されるため）
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# セッションテーブルが存在しない場合のみ作成
RUN if [ ! -f /var/www/html/database/migrations/*_create_sessions_table.php ]; then \
      php artisan session:table; \
    fi \
    && php artisan migrate

# 80ポートを公開
EXPOSE 80

# コンテナ起動時のコマンド
CMD ["apache2-foreground"]
