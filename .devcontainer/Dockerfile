FROM mcr.microsoft.com/devcontainers/php:1-8.2-bullseye

# Install data structures package for php
RUN curl -sSL https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - | sh -s \
  ds
