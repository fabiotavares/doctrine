<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 17/11/14
 * Time: 13:42
 */

namespace FT\Sistema\Controller;

use Doctrine\ORM\EntityManager;
use FT\Sistema\Interfaces\iProdutoAPIController;
use FT\Sistema\Entity\Produto;
use FT\Sistema\Validador\ProdutoValidador;
use FT\Sistema\Serialize\ProdutoSerialize;
use FT\Sistema\Service\ProdutoService;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

class ProdutoAPIController implements iProdutoAPIController
{
    public function getController(Application $app, EntityManager $em)
    {
        $produtoControllerApi = $app['controllers_factory'];

        $app['produtoService'] = function() use($em) {
            $validador = new ProdutoValidador();
            $serialize = new ProdutoSerialize();
            return new ProdutoService($em, $validador, $serialize);
        };

        //-----------------------------------------------------------------------------
        //tenta localizar todos os registros de Produtos
        $produtoControllerApi->get('/api/produtos', function() use ($app) {
            try{
                $produtos = $app['produtoService']->findAll();
                $produtoSerialize = $app['produtoService']->getSerialize();
                return $app->json(['Produtos:'=>$produtoSerialize->ArrayOfProdutoToArray($produtos)]);
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
                    $produtoSerialize = $app['produtoService']->getSerialize();
                    return $app->json(['Produto:'=>$produtoSerialize->ProdutoToArray($produto)]);
                } else {
                    return $app->json(['ERRO:' => 'Produto nao localizado'], 404);
                }
            } catch (\Exception $e) {
                return $app->json(['ERRO:' => $e->getMessage()]);
            }
        })->convert('id', function($id) { return (int) $id; });

        //-----------------------------------------------------------------------------
        //valida e insere o registro de produto solicitado
        $produtoControllerApi->post('/api/produtos', function(Request $request) use ($app) {
            try{
                $validador = $app['produtoService']->getValidador();
                $dados = $validador->valide($request->request->all());
                $produto = $app['produtoService']->insert($dados);

                if($produto instanceof Produto) {
                    $produtoSerialize = $app['produtoService']->getSerialize();
                    return $app->json(['SUCESSO:' => 'Produto cadastrado com sucesso',
                    'Produto'=>$produtoSerialize->ProdutoToArray($produto)]);
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
                    $validador = $app['produtoService']->getValidador();
                    $dados = $validador->valideParcial($request->request->all(), $produto);
                    if($app['produtoService']->update($dados)) {
                        $produtoSerialize = $app['produtoService']->getSerialize();
                        return $app->json(['SUCESSO:' => 'Produto atualizado com sucesso',
                            'Produto:'=>$produtoSerialize->ProdutoToArray($produto)]);
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