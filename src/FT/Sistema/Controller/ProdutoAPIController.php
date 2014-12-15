<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 17/11/14
 * Time: 13:42
 */

namespace FT\Sistema\Controller;

use FT\Sistema\Interfaces\iProdutoAPIController;
use FT\Sistema\Entity\Produto;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

class ProdutoAPIController implements iProdutoAPIController
{
    public function getController(Application $app)
    {
        $produtoControllerApi = $app['controllers_factory'];

        //tenta localizar todos os registros de Produtos
        $produtoControllerApi->get('/api/produtos', function() use ($app) {
            try{
                $produtos = $app['produtoService']->findAll();
                $produtosArray = $app['produtoSerializeService']->ArrayOfProdutoToArray($produtos);
                return $app->json(['Produtos:'=>$produtosArray]);
            } catch (\Exception $e) {
                return $app->json(['ERRO:' => $e->getMessage()]);
            }
        });

        //-----------------------------------------------------------------------------
        //tenta localizar o registro cujo id foi informado
        $produtoControllerApi->get('/api/produtos/{id}', function($id) use ($app) {
            try{
                $produto = $app['produtoService']->fetch($id);

                if($produto instanceof Produto) {
                    $produtoArray = $app['produtoSerializeService']->ProdutoToArray($produto);
                    return $app->json(['Produto:'=>$produtoArray]);
                } else {
                    return $app->json(['ERRO:' => 'Produto nao localizado'], 404);
                }
            } catch (\Exception $e) {
                return $app->json(['ERRO:' => $e->getMessage()]);
            }
        })->convert('id', function($id) { return (int) $id; });

        //-----------------------------------------------------------------------------
        //valida e insere o registro do produto solicitado
        $produtoControllerApi->post('/api/produtos', function(Request $request) use ($app) {
            try{
                $dados = $app['produtoValidatorService']->validate($request->request->all());
                $produto = $app['produtoService']->insert($dados);

                if($produto instanceof Produto) {
                    $produtoArray = $app['produtoSerializeService']->ProdutoToArray($produto);
                    return $app->json(['SUCESSO:' => 'Produto cadastrado com sucesso', 'Produto'=>$produtoArray]);
                } else {
                    return $app->json(['ERRO:' => 'Erro ao inserir produto']);
                }
            } catch (\Exception $e) {
                return $app->json(['ERRO:' => $e->getMessage()]);
            }
        });

        //-----------------------------------------------------------------------------
        //valida e atualiza o registro de produto cujo id foi informado (é permitida atualização parcial)
        $produtoControllerApi->put('/api/produtos/{id}', function($id, Request $request) use ($app) {
            try{
                $produto = $app['produtoService']->fetch($id);
                if($produto instanceof Produto) {
                    $dados = $app['produtoValidatorService']->validateParcial($request->request->all(), $produto);
                    if($app['produtoService']->update($dados)) {
                        $produtoArray = $app['produtoSerializeService']->ProdutoToArray($produto);
                        return $app->json(['SUCESSO:' => 'Produto atualizado com sucesso', 'Produto:'=>$produtoArray]);
                    } else {
                        return $app->json(['ERRO:' => 'Houve um erro ao atualizar o produto']);
                    }
                } else {
                    return $app->json(['ERRO:' => 'Produto não localizado'], 404);
                }
            } catch (\Exception $e) {
                return $app->json(['ERRO:' => $e->getMessage()]);
            }
        })->convert('id', function($id) { return (int) $id; });

        //-----------------------------------------------------------------------------
        //deleta produto cujo id foi informado
        $produtoControllerApi->delete('/api/produtos/{id}', function($id) use ($app) {
            try{
                if($app['produtoService']->delete($id)) {
                    return $app->json(['SUCESSO:' => 'Produto deletado com sucesso']);
                } else {
                    return $app->json(['ERRO:' => 'Houve um erro ao deletar o produto']);
                }
            } catch (\Exception $e) {
                return $app->json(['ERRO:' => $e->getMessage()]);
            }
        })->convert('id', function($id) { return (int) $id; });

        //-----------------------------------------------------------------------------

        return $produtoControllerApi;
    }
} 