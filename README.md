###Code Education
----
- Projeto de curso
- Módulo: DOCTRINE
- Fase 1: Persistência com Doctrine
- Autor: Fábio Tavares
- Data: 04/12/2014

###Instalação
- É requirido PHP versão 5.5 ou superior
- Utilizar o servidor interno do PHP
- Importar o banco de dados produtos.sql
- Em um terminal na raiz do projeto digite: php -S localhost:8888 -t public

###Testes WEB
- Em um navegador digite: localhost:8888
- Opções disponíveis: Visualizar, Inserir, Alterar e Excluir

###Testes REST
Utilizando uma ferramento como Postman, faça:
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
Tabela produtos: id (1, 2, 3, 4), nome, valor, descricao