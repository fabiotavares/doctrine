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
use FT\Sistema\Mapper\ProdutoMapper;
use FT\Sistema\Service\ProdutoService;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

class ProdutoAPIController implements iProdutoAPIController
{
    public function getController(Application $app, EntityManager $em)
    {
        $produtoControllerApi = $app['controllers_factory'];

        $app['produtoService'] = function() use($em) {
            $produtoEntity = new Produto();
            $produtoMapper = new ProdutoMapper($em);
            $produtoService = new ProdutoService($produtoEntity, $produtoMapper);

            return $produtoService;
        };

        //-----------------------------------------------------------------------------

        $produtoControllerApi->get('/api/produtos', function() use ($app) {

            $produtos = $app['produtoService']->fetchAll();
            return $app->json($produtos, 200);

        });

        //-----------------------------------------------------------------------------

        $produtoControllerApi->get('/api/produtos/{id}', function($id) use ($app) {

            if(!$this->valideId($id)) {
                return $app->json(['ERRO' => 'Informe um valor inteiro para o id'], 404);
            }

            $produto = $app['produtoService']->fetch($id);
            if($produto instanceof Produto) {
                return $app->json($produto, 200);
            } else {
                return $app->json(['ERRO' => 'Produto não localizado'], 404);
            }

        })->convert('id', function($id) { return (int) $id; });

        //-----------------------------------------------------------------------------

        $produtoControllerApi->post('/api/produtos', function(Request $request) use ($app) {

            $dados['nome'] = $request->get('nome');
            $dados['valor'] = $request->get('valor');
            $dados['descricao'] = $request->get('descricao');

            if(!$this->validNome($dados['nome'])) {
                return $app->json(['ERRO' => 'Informe um nome para o produto'], 404);
            }
            if(!$this->valideValor($dados['valor'])) {
                return $app->json(['ERRO' => 'Informe um valor valido para o produto'], 404);
            }
            if(!$this->valideDescricao($dados['descricao'])) {
                return $app->json(['ERRO' => 'Informe uma descricao para o produto'], 404);
            }

            //insere novo produto no banco de dados
            $produto = $app['produtoService']->insert($dados);
            if(isset($produto)) {
                return $app->json([
                    'SUCESSO' => 'Produto cadastrado com sucesso!',
                    'Id' => $produto->getId(),
                    'Nome' => $produto->getNome(),
                    'Valor' => $produto->getValor(),
                    'Descricao' => $produto->getDescricao()
                ], 200);
            } else {
                return $app->json(['ERRO' => 'Erro ao inserir produto!'], 404);
            }

        });

        //-----------------------------------------------------------------------------

        $produtoControllerApi->put('/api/produtos/{id}', function($id, Request $request) use ($app) {

            //permite atualização parcial do produto
            $dados['id'] = $id;
            if(!$this->valideId($dados['id'])) {
                return $app->json(['ERRO' => 'Informe um valor inteiro para o id'], 404);
            }

            $produto = $app['produtoService']->fetch($id);
            if(isset($produto)) {

                $dados['nome'] = $request->get('nome');
                if( (isset($dados['nome'])) && !$this->validNome($dados['nome']) ) {
                    return $app->json(['ERRO' => 'Informe um nome para o produto'], 404);
                } elseif(!isset($dados['nome'])) {
                    $dados['nome'] = $produto['nome'];
                }

                $dados['valor'] = $request->get('valor');
                if( (isset($dados['valor'])) && !$this->valideValor($dados['valor']) ) {
                    return $app->json(['ERRO' => 'Informe um valor valido para o produto'], 404);
                } elseif(!isset($dados['valor'])) {
                    $dados['valor'] = $produto['valor'];
                }

                $dados['descricao'] = $request->get('descricao');
                if( (isset($dados['descricao'])) && !$this->valideDescricao($dados['descricao']) ) {
                    return $app->json(['ERRO' => 'Informe uma descricao para o produto'], 404);
                } elseif(!isset($dados['descricao'])) {
                    $dados['descricao'] = $produto['descricao'];
                }

                if($app['produtoService']->update($dados)) {
                    return $app->json(['SUCESSO' => 'Produto atualizado com sucesso'], 200);
                } else {
                    return $app->json(['ERRO' => 'Houve um erro ao atualizar o produto'], 404);
                }

            } else {
                return $app->json(['ERRO' => 'Produto não localizado'], 404);
            }

        })->convert('id', function($id) { return (int) $id; });

        //-----------------------------------------------------------------------------

        $produtoControllerApi->delete('/api/produtos/{id}', function($id) use ($app) {

            if(!$this->valideId($id)) {
                return $app->json(['ERRO' => 'Informe um valor inteiro par ao id'], 404);
            }

            if($app['produtoService']->delete($id)) {
                return $app->json(['SUCESSO' => 'Produto deletado com sucesso'], 200);
            } else {
                return $app->json(['ERRO' => 'Houve um erro ao deletar o produto'], 404);
            }

        })->convert('id', function($id) { return (int) $id; });

        //-----------------------------------------------------------------------------

        return $produtoControllerApi;
    }

    private function valideId($id)
    {
        return ($id > 0);
    }

    private function validNome(&$nome)
    {
        $nome = trim($nome);
        return (strlen($nome) > 0);
    }

    private function valideValor($valor)
    {
        return (is_numeric($valor) && $valor > 0);
    }

    private function valideDescricao(&$descricao)
    {
        $descricao = trim($descricao);
        if(empty($descricao)) {
            return false;
        }
        return true;
    }

} 