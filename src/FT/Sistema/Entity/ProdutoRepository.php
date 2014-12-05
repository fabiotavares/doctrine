<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 04/12/14
 * Time: 18:59
 */

namespace FT\Sistema\Entity;

use Doctrine\ORM\EntityRepository;

class ProdutoRepository extends EntityRepository
{
    //exemplo usando QueryBuilder
    public function getProdutosOrdenados()
    {
        return $this
            ->createQueryBuilder("p")
            ->orderBy('p.valor', 'asc')
            ->getQuery()
            ->getResult();
    }

    //exemplo usando DQL (Doctrine Query Language)
    public function getProdutosDesc()
    {
        $dql = 'SELECT p FROM FT\Sistema\Entity\Produto p
                ORDER BY p.nome DESC ';

        return $this
            ->getEntityManager()
            ->createQuery($dql)
            ->getResult()
        ;
    }
} 