<?php

namespace FT\Sistema\Controller;

use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

class ProdutoController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $produtoController = $app['controllers_factory'];

        //-----------------------------------------------------------------------------

        $produtoController->get('/', function() use ($app) {

            return $app->redirect($app['url_generator']->generate('produtos'));

        })->bind('index');

        //-----------------------------------------------------------------------------

        $produtoController->get('/produtos', function(Request $request) use ($app) {

            $parametros = $request->query->all();
            $produtos = $app['produtoService']->getProdutos($request);

            return $app['twig']->render('produtos.twig', [
                'parametros'=>$parametros,
                'produtos'=>$produtos['arrayProdutos'],
                'paginador'=>$produtos['htmlPaginador']
                ]
            );

        })->bind('produtos');

        //-----------------------------------------------------------------------------

        $produtoController->get('/produtos/novo', function() use ($app) {

            //exibe formulário para entrada de dados de novo produto
            return $app['twig']->render('produto_new.twig', []);

        })->bind('produtoNovo');

        //-----------------------------------------------------------------------------

        $produtoController->post('/produtos/insert', function(Request $request) use ($app) {

            $salvar = $request->get('salvar');
            if(isset($salvar)) {
                $dados['nome'] = $request->get('nome');
                $dados['valor'] = $request->get('valor');
                $dados['descricao'] = $request->get('descricao');
                //insere novo produto no banco de dados
                $produto = $app['produtoService']->insert($dados);
                if(!isset($produto)) {
                    $app->abort(500, "ERROR: Erro ao inserir produto!");
                }
            }

            return $app->redirect($app['url_generator']->generate('produtos'));

        })->bind('produtoInsert');

        //-----------------------------------------------------------------------------

        $produtoController->get('/produtos/edit/{id}', function($id) use ($app) {

            $produto = $app['produtoService']->fetch($id);
            return $app['twig']->render('produto_edit.twig', ['produto'=>$produto]);

        });

        //-----------------------------------------------------------------------------

        $produtoController->post('/produtos/edit', function(Request $request) use ($app) {

            $salvar = $request->get('salvar');
            if(isset($salvar)) {
                $dados['id'] = $request->get('id');
                $dados['nome'] = $request->get('nome');
                $dados['valor'] = $request->get('valor');
                $dados['descricao'] = $request->get('descricao');
                if(!$app['produtoService']->update($dados)) {
                    $app->abort(500, "ERROR: Erro ao atualizar o cadastro!");
                }
            }

            return $app->redirect($app['url_generator']->generate('produtos'));

        })->bind('produtoEdit');

        //-----------------------------------------------------------------------------

        $produtoController->get('/produtos/delete/{id}', function($id) use ($app) {

            $produto = $app['produtoService']->fetch($id);
            return $app['twig']->render('produto_delete.twig', ['produto'=>$produto]);

        });

        //-----------------------------------------------------------------------------

        $produtoController->post('/produtos/delete', function(Request $request) use ($app) {

            $salvar = $request->get('salvar');
            if(isset($salvar)) {
                if(!$app['produtoService']->delete($request->get('id'))) {
                    $app->abort(500, "ERROR: Erro ao deletar o cadastro!");
                }

            }
            return $app->redirect($app['url_generator']->generate('produtos'));

        })->bind('produtoDelete');

        //-----------------------------------------------------------------------------

        return $produtoController;
    }
} 