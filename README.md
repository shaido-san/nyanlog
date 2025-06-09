<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
# nyanlog プロジェクト概要

## 構成
- Laravel：ユーザー投稿・画像保存・一覧表示などのフロントエンド
- Flask：投稿画像を受信して機械学習で分類するAPI（猫の判定）

## 開発の流れ
1. Laravelで投稿・表示などの基本機能を構築
2. Flaskで画像分類APIを構築（PyTorch使用予定）
3. LaravelからFlask APIに画像を送信し、分類結果を受け取る
4. 分類結果をLaravelで表示・保存する

## 機械学習モデル
- 猫判定（is_cat）
- 学習データ：猫画像データセット（Kaggle or 独自収集）
- 精度目標：90%以上

## その他
- AWSにLaravelをデプロイ予定
- Flaskは別サーバーでホストする予定（またはDockerで統合）
