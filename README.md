<p align="center">
  <img src="https://menu.com.vc/media/store/logo/websites/1/Imagem1.png" width="200">
</p>

# Desafio Full Stack

Esse desafio tem como objetivo testar seu domínio sobre Desenvolvimento Full Stack: organização, boas práticas, APIs, conhecimento em frameworks e suas tecnologias.

## Regras

- Para expôr seus endpoints utilize de preferência um framework web simples e leve;
- Não utilize boilerplates, gostamos de ver como você organiza seu código;
- Fique a vontade para escolher o banco de dados que achar melhor;
- Utilize uma das seguintes linguagens no back-end: PHP, Python ou NodeJS;
- Utilize um dos seguintes frameworks/libs no front-end: ReactJS ou VueJS;
- Dockerize seu ambiente. Isso facilitará para quem está corrigindo seu teste.

## O desafio

- **API Rest**

  - /orders (GET, POST)
  - /orders/:id (GET, PUT, DELETE)
  - /customers (GET, POST)
  - /customers/:id (GET, PUT, DELETE)

- **Contratos:**

  - O recurso de "pedidos" deve conter:

    - Data do pedido
    - Status do pedido
    - Cliente correlacionado do pedido
    - Valor do pedido

  - O recurso de "clientes" deve conter:
    - Primeiro nome
    - Último nome
    - E-mail

## Instalação e Configuração

-   Clone ou faça o download deste repositório
-   Execute `cp .env.example .env` no Mac/Unix ou `COPY .env.example .env` no Windows
-   Execute `docker-compose up -d` para buildar e criar os containers
-   Execute `docker exec -it app composer install` para instalar todas as dependências
-   Execute `docker exec -it app php artisan migrate` para criar as tabelas
-   Finalmente execute `docker exec -it app php artisan db:seed` para popular as tabelas
-   Se tudo funcionou corretamente, você pode navegar para `http://localhost` 🚀
