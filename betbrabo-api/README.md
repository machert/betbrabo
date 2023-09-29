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
- Teste unitário []
- Teste de integração []
- API Restful [x]
- Eloquent para persistência na api [x]
- Autenticação JWT token [x]
- Tratamento de exceptions [x]
- Paginação padrão nas rotas de listagem []
- Grafana para monitoramento []
- Documentação com swagger (alguns exemplos) [x]
    http://localhost/api/documentation#/

## Tecnologias
- Laravel [x]
- MySQL [x]
- Redis
- Laravel queue
- Nginx
- Docker [x]
- JWT token [x]
- Grafana

