<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 06/11/14
 * Time: 18:52
 */

namespace FT\Sistema\Service;

use Doctrine\ORM\EntityManager;
use FT\Sistema\Entity\Produto as ProdutoEntity;
use FT\Sistema\Interfaces\iProdutoService;
use Symfony\Component\HttpFoundation\Request;

class ProdutoService implements iProdutoService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFormConsulta(Request $criterios)
    {
        try{
            return $this->em->getRepository('FT\Sistema\Entity\Produto')->getFormConsulta($criterios);

        } catch (\PDOException $e) {
            echo "ERROR: Unable to list the data in the database!";
            die("Code: {$e->getCode()} <br> Message: {$e->getMessage()} <br>  File: {$e->getFile()} <br> Line: {$e->getLine()}");
        }
    }

    public function fetchAll()
    {
        try{

            return $this->em->getRepository('FT\Sistema\Entity\Produto')->findAll();

        } catch (\PDOException $e) {
            echo "ERROR: Unable to list the data in the database!";
            die("Code: {$e->getCode()} <br> Message: {$e->getMessage()} <br>  File: {$e->getFile()} <br> Line: {$e->getLine()}");
        }
    }

    public function fetch($id)
    {
        try{

            return $this->em->getRepository('FT\Sistema\Entity\Produto')->find($id); //pesquisa pela chave
            /*
             * exemplos de findby:
             * $repo = $this->em->getRepository('FT\Sistema\Entity\Produto');
             * $repo->findBy(array("nome"=>"Fabio", "email"=>"fabreder@gmail.com"));
             * $repo->findByNome("Fabio");
             * $repo->findByEmail("fabreder@gmail.com");
             */

        } catch (\PDOException $e) {
            echo "ERROR: Unable to list the data in the database!";
            die("Code: {$e->getCode()} <br> Message: {$e->getMessage()} <br>  File: {$e->getFile()} <br> Line: {$e->getLine()}");
        }
    }

    public function delete($id)
    {
        try{
            $produtoEntity = $this->em->getReference('FT\Sistema\Entity\Produto', $id);
            if(isset($produtoEntity)) {
                $this->em->remove($produtoEntity);
                $this->em->flush();
                return true;
            }
            return false; //não localizou o produto

        } catch (\PDOException $e) {
            echo "ERROR: Unable to delete the data in the database!";
            die("Code: {$e->getCode()} <br> Message: {$e->getMessage()} <br>  File: {$e->getFile()} <br> Line: {$e->getLine()}");
        }
    }

    public function update(array $data)
    {
        try{
            $produtoEntity = $this->em->getReference('FT\Sistema\Entity\Produto', $data['id']);
            $produtoEntity->setNome($data['nome']);
            $produtoEntity->setDescricao($data['descricao']);
            $produtoEntity->setValor($data['valor']);

            $this->em->persist($produtoEntity);
            $this->em->flush();

            return $produtoEntity;

        } catch (\PDOException $e) {
            echo "ERROR: Unable to update the data in the database!";
            die("Code: {$e->getCode()} <br> Message: {$e->getMessage()} <br>  File: {$e->getFile()} <br> Line: {$e->getLine()}");
        }
    }

    public function insert(array $data)
    {
        try{
            $produtoEntity = new ProdutoEntity();
            $produtoEntity->setNome($data['nome']);
            $produtoEntity->setDescricao($data['descricao']);
            $produtoEntity->setValor($data['valor']);

            $this->em->persist($produtoEntity);
            $this->em->flush();

            return $produtoEntity;

        } catch (\PDOException $e) {
            echo "ERROR: Unable to insert the data in the database!";
            die("Code: {$e->getCode()} <br> Message: {$e->getMessage()} <br>  File: {$e->getFile()} <br> Line: {$e->getLine()}");
        }
    }

} 