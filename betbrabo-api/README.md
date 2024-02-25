# Betbrabo
Projeto Laravel - API de apostas

## Requisitos
- PHP
- Composer
- Docker
- Insomnia, postman ou similar

## Como configurar o projeto
- Baixe o repositorio ou faça um clone do projeto na sua maquina
- Abra o terminal na raiz da pasta do projeto
- Vá até a raiz do projeto da api e execute os comandos:
- ./vendor/bin/sail up para iniciar o docker
- php artisan migrate:fresh --seed para criar e popular o bd
- Autenticação jwt token email/senha: admin@gmail.com/1234

## O que há no projeto
- Teste unitário [x]
- Teste de integração [x]
- API Restful [x]
- Eloquent para persistência na api [x]
- Autenticação JWT token [x]
- Tratamento de exceptions [x]
- Paginação padrão nas rotas de listagem []
- Grafana para monitoramento []
- Documentação com swagger (alguns exemplos) [x]
    http://localhost/api/documentation
    http://127.0.0.1:8000/api/documentation

## Tecnologias
- Laravel [x]
- MySQL [x]
- Redis []
- Laravel queue []
- Nginx []
- Docker [x]
- JWT token [x]
- Grafana []

## Instalações
composer require barryvdh/laravel-cors


sudo apt install git-all
sudo git clone https://github.com/machert/betbrabo.git


php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

php composer.phar install

docker-compose build

composer require laravel/sail --dev

Na raiz do ubuntu crie uma pasta qualquer e execute:

mkdir projetos

cd projetos

sudo curl -sS https://getcomposer.org/installer | php

sudo mv /projetos/composer.phar /usr/local/bin/composer

assim teremos o composer no ubuntu instalado e pronto para uso

sudo apt-get install php-mysql