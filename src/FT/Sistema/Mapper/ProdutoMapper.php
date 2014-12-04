<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 06/11/14
 * Time: 18:49
 */

namespace FT\Sistema\Mapper;

use Doctrine\ORM\EntityManager;
use FT\Sistema\Interfaces\iProduto;
use FT\Sistema\Interfaces\iProdutoMapper;


class ProdutoMapper implements iProdutoMapper
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
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

            return $this->em->getRepository('FT\Sistema\Entity\Produto')->find($id);

        } catch (\PDOException $e) {
            echo "ERROR: Unable to list the data in the database!";
            die("Code: {$e->getCode()} <br> Message: {$e->getMessage()} <br>  File: {$e->getFile()} <br> Line: {$e->getLine()}");
        }
    }

    public function delete($id)
    {
        try{
            $produto = $this->em->getRepository('FT\Sistema\Entity\Produto')->find($id);
            if(isset($produto)) {
                $this->em->remove($produto);
                $this->em->flush();
                return true;
            }
            return false; //não localizou o produto

        } catch (\PDOException $e) {
            echo "ERROR: Unable to delete the data in the database!";
            die("Code: {$e->getCode()} <br> Message: {$e->getMessage()} <br>  File: {$e->getFile()} <br> Line: {$e->getLine()}");
        }
    }

    public function update(iProduto $produto)
    {
        try{
            $this->em->merge($produto);
            $this->em->flush();

            return $produto;

        } catch (\PDOException $e) {
            echo "ERROR: Unable to update the data in the database!";
            die("Code: {$e->getCode()} <br> Message: {$e->getMessage()} <br>  File: {$e->getFile()} <br> Line: {$e->getLine()}");
        }
    }

    public function insert(iProduto $produto)
    {
        try{
            $this->em->persist($produto);
            $this->em->flush();

            return $produto;

        } catch (\PDOException $e) {
            echo "ERROR: Unable to insert the data in the database!";
            die("Code: {$e->getCode()} <br> Message: {$e->getMessage()} <br>  File: {$e->getFile()} <br> Line: {$e->getLine()}");
        }
    }
} 