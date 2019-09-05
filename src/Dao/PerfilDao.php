<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 05/08/2019
 * Time: 10:04
 */

namespace App\Dao;

use App\Abstracts\AbstractDao;

class PerfilDao extends AbstractDao
{
    public function __construct($entityManager)
    {
        parent::__construct($entityManager,'App\Entity\Perfil');
    }
}