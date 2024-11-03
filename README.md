# laravel_docker-app

# 以下のコマンドで環境を立ち上げることができる
docker-compose up -d

# 以下のurlにアクセス
http://localhost:8080/

# laravel_appのサーバーにログイン
以下のコマンドを実行
・docker exec -it laravel_app bash


# DB対応
init.sqlにDocker起動時の実行されるSQLを記載している
⇒テーブルや初期データ作成を行う
Docker経由の接続コマンドは下記。
・docker exec -it mysql_db mysql -u root -p


