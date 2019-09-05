<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 23/08/2019
 * Time: 10:03
 */

namespace App\Helper;


class AclHelper
{

    private $acl;

    /**
     * AclHelper constructor.
     * If a route is not listed below it will always allowed if logged.
     */
    public function __construct()
    {
        $this->acl = [
            'protected'=>['SYSADMIN'],
            'usuario.list'=>['SYSADMIN','GESTOR'],
            'usuario.remove.json' => ['SYSADMIN','GESTOR']
        ];
    }


    public function isAllowed($route,$role){

        if(strcmp($role,'SYSADMIN')==0) {
            return true;
        }

        $aclRoute = array();
        if(isset($this->acl[$route])){
            $aclRoute = $this->acl[$route];
        }

        if(isset($this->acl[$route])){
            for( $i=0;$i<sizeof($aclRoute);$i++){
                if(strcmp($role,$aclRoute[$i])==0)
                    return true;
            }
        }else{
            return true;
        }
        return false;

    }



}