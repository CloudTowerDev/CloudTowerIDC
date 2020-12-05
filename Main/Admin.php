<?php

namespace CloudTowerIDC\Admin;

class Admin{
    
    private $Database;
    public $Admin;
    
    public function __construct($Admin, private $Class){
        $this->Database = $Class->getSystem()->getDatabase();
        if(is_numeric($Admin)){
            $this->Admin = $this->Database->get_row("SELECT * FROM `ytidc_admin` WHERE `id`='{$Admin}'");
        }else{
            $this->Admin = $this->Database->get_row("SELECT * FROM `ytidc_admin` WHERE `username`='{$Admin}'");
        }
    }
    
    public function isExisted(){
        if(empty($this->Admin)){
            return false;
        }else{
            return true;
        }
    }
    
    public function getAll(){
        if(empty($this->Admin)){
            return false;
        }else{
            return $this->Admin;
        }
    }
    
    public function getId(){
        if(empty($this->Admin)){
            return false;
        }else{
            return $this->Admin['id'];
        }
    }
    
    public function getUsername(){
        if(empty($this->Admin)){
            return false;
        }else{
            return $this->Admin['username'];
        }
    }
    
    public function getPassword(){
        if(empty($this->Admin)){
            return false;
        }else{
            return $this->Admin['password'];
        }
    }
    
    public function getPermission(){
        if(empty($this->Admin)){
            return false;
        }else{
            return json_decode($this->Admin['permission'],true);
        }
    }
    
    public function getLastIp(){
        if(empty($this->Admin)){
            return false;
        }else{
            return $this->Admin['lastip'];
        }
    }
    
    public function getStatus(){
        if(empty($this->Admin)){
            return false;
        }else{
            return $this->Admin['status'];
        }
    }
    
    public function set($array){
        if(empty($this->Admin)){
            return false;
        }else{
            if(empty($array)){
                return true;
            }else{
                foreach($array as $k => $v){
                    $this->Database->exec("UPDATE `ytidc_admin` SET `{$k}`='{$v}' WHERE `id`='{$this->Admin['id']}'");
                }
                return true;
            }
        }
    }
    
    public function setLastIp($LastIp){
        if(empty($this->Admin)){
            return false;
        }else{
            return $this->Database->exec("UPDATE `ytidc_admin` SET `lastip`='{$LastIp}' WHERE `id`='{$this->Admin['id']}'");
        }
    }
    
    public function setStatus($Status = true){
        if(empty($this->Admin)){
            return false;
        }else{
            if($status){
                return $this->Database->exec("UPDATE `ytidc_admin` SET `status`='1' WHERE `id`='{$this->Admin['id']}'");
            }else{
                return $this->Database->exec("UPDATE `ytidc_admin` SET `status`='0' WHERE `id`='{$this->Admin['id']}'");
            }
        }
    }
    
}

?>