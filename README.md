# NXTED-testset

[![Test](https://github.com/TabithaLarkin/NXTED-testset/actions/workflows/main.yml/badge.svg)](https://github.com/TabithaLarkin/NXTED-testset/actions/workflows/main.yml)

## インストール

次のいずれかが必要です。

### GitHub Codespaces

https://github.com/codespaces/

Codespacesは自動で開発環境構築する、そしてネットで開発できます。Codespacesは自動でコードの依存関係やツールをインストールできます。

### Visual Studio Code

- Visual Studio Code (https://code.visualstudio.com/download)
- Docker (https://docs.docker.com/engine/install/)

> [!NOTE]
> Windowsを使い際、ソースコードをWSL2のLinuxディレクトリに置くことをお勧めします。これについては、このリンクを参照してください。
> https://docs.docker.com/desktop/wsl/best-practices/

### Local PHP installation

- PHP 8.2 (https://www.php.net/downloads.php)
  - DS [オプション] (https://www.php.net/manual/en/ds.installation.php)
- Composer (https://getcomposer.org/download/)

## 課題のコードを実行する

課題 1

```cmd
php ./src/kadai1.php
```

課題 2

```cmd
php ./src/kadai2.php
```

課題 3

```cmd
php ./src/kadai3.php
```

課題 4

```cmd
php ./src/kadai4.php
```


## テスト実行

テストを実行するためにこのコマンドを実行してください。

```cmd
./vendor/bin/phpunit
```

## デバッグ

VsCodeのXDebugについてコードは`.vscode/launch.json`にいます。
