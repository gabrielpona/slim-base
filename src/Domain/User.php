<?php
namespace App\Domain;

use App\Abstracts\AbstractDomain;
use Doctrine\ORM\Mapping as ORM;
use App\Auth\Bcrypt;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends AbstractDomain
{

    /** @ORM\Column(type="string", length=100) **/
    private $username;

    /** @ORM\Column(type="string", length=100) **/
    private $password;

    public function __construct(Array $data = [])
    {
        if (!empty($data['username']))
            $this->username = $data['username'];

        /*
        if (!empty($data['password'])) {
            $bcrypt = new Bcrypt();
            $this->password = $bcrypt->setHash($data['password']);
        }
        */
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function __toArray()
    {
        $data = [];
        foreach ($this as $k=>$v)
            $data[$k] = $v;

        return $data;
    }


}