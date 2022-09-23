

# TODO
- chartjs 導入
- ページネーション
- 非同期通信
- 必須入力フィールドにマーク
- 色々アイコン追加

# Tech
- Framework
    - Laravel (PHP framework)
- Design
    - Tailwind CSS
- Chart
    - chart.js
- Asynchronous communication
    - axios

# About this repository
This repository for 家計簿 Kakeibo (household accounts in Japanese) web application
using Laravel (PHP framework).
This application allows you to record and analyze your daily income and expenses.

# laravel-mix
Please add line below to package.json

```
// laravel-your-project/package.json

{
    ...
    omitted
    ...
    },
    "devDependencies": {
        ...
        omitted
        ...
        "laravel-mix": "^6.0.49",
        ...
    },
    "dependencies": {
        "chart.js": "^3.9.1"
    }
}
```


# Command
```
// show routing table
sail php artisan route:list | grep tweet

// show databases
sail mysql
show databases;
show tables from laratter;
use laratter;
show columns from tweets;

// update css
sail npm run build


cd resources/views
mkdir tweet
touch create.blade.php edit.blade.php index.blade.php show.blade.php
cd ../..
```
