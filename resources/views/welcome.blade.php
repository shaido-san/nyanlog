<!DOCTYPE html>
<html lang="en">
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>にゃんログ - ログイン</title>
    <style>
        body { font-family: sans-serif; padding: 2em; text-align: center; }
        .auth-buttons { margin-top: 2em; }
        .auth-buttons a { margin: 0 1em; padding: 1em; background: #eee; text-decoration: none; border-radius: 5px; }
        .description { margin-top: 3em; font-size: 1.2em; color: #555; }
    </style>
</head>
<body>
    <h1>にゃんログへようこそ</h1>

    <div class="auth-buttons">
        <a href="{{ route('login') }}">ログイン</a>
        <a href="{{ route('register') }}">会員登録</a>
    </div>

    <div class="description">
        <p>🐾 にゃんログは、あなたとのら猫の愛おしい毎日を記録するアプリです。</p>
        <p>写真・メモ・スケジュールで、猫との生活をもっと豊かに。</p>
        <p>朝活がしたい人も、今すぐにゃんログ！</p>
    </div>
</body>
</html>