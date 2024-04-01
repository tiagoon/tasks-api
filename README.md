## Testando a API

Documentação disponível no Postman:

[![Run in Postman](https://run.pstmn.io/button.svg)](https://www.postman.com/gold-meadow-49815/workspace/lista-de-tarefas/collection/18711252-7c597347-1fe0-4b74-b59c-2ec5c033080d?action=share&creator=18711252)



## Configurando o ambiente

Configure o *.env*

```cp .env.example .env```

Instale as dependências

```composer install```

Configure o db

```sail artisan migrate```

Crie um usuário (via CLI)

```sail artisan user:create --name "maria souza" --email "maria.souza@gmail.com" --phone "79988888888"```


## Recursos
- Mailtrap para testes de envio de e-mail
- Postman para documentação
