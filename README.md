###Projeto de curso Code Education
----
- Módulo: DOCTRINE
- Fase 2: Sistema de Busca com DQL
- Autor: Fábio Tavares
- Data: 11/12/2014

###Instalação
- É requirido PHP versão 5.5 ou superior
- Utilizar o servidor interno do PHP
- Importar o banco de dados produtos.sql
- Em um terminal na raiz do projeto digite: php -S localhost:8888 -t public

###Testes WEB
- Em um navegador digite: localhost:8888
- Opções disponíveis: Busca, Visualizar, Inserir, Alterar e Excluir

###Testes REST
Utilizando uma ferramenta como Postman, faça:
- Para listar os produtos (método GET):
```sh
localhost:8888/api/produtos
```
- Para exibir um produto (método GET):
```sh
localhost:8888/api/produtos/1
```
- Para inserir um produto (método POST):
```sh
localhost:8888/api/produtos
```
- Para alterar um produto (método PUT):
```sh
localhost:8888/api/produtos/1
```
- Para alterar um excluir (método DELETE):
```sh
localhost:8888/api/produtos/1
```
Tabela produtos: id (1 .. 20), nome, valor, descricao