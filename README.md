# Desafio DEV - GESUAS

Para execução da aplicação, utiliza-se o Docker para orquestração da aplicação, facilitando a orquestração da aplicação com o banco de dados e o phpmyadmin.

Para rodar, apenas execute:
```
docker-compose up --build
```

Aguarde a instalação das dependências e inicialização do banco de dados. Após concluído, acesse:

```
http://localhost:4500/nis/user
```

para acesso ao phpmyadmin, acesse:
```
http://localhost:4500/nis/user

login: root
senha: root
```

## Referência

 - [simple-mvc-php](https://github.com/alexmpereira/simple-mvc-php)
 - [docker-apache-php7-mysql](https://github.com/theandersonn/docker-apache-php7-mysql/blob/master/docker-compose.yaml)
  - [Algoritmo de Validação do PIS](https://www.macoratti.net/alg_pis.htm)
