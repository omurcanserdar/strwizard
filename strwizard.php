<?php
namespace Wizard;

class Cipher
{

    public array $chars,$specials,$all;
    public const LIMIT=32;

    public function __construct()
    {
        $this->chars=array_merge(range('A', 'Z'), range('a', 'z'),range(0,9));
        $this->specials=str_split("!\"#$%&'()*+,-./:;?@[\]^_`{|}~");
        $this->all=array_merge($this->chars,$this->specials);
    }

    /**
     * @return array
     */
    public function getChars(): array
    {
        return $this->chars;
    }

    /**
     * @return array
     */
    public function getSpecials(): array
    {
        return $this->specials;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->all;
    }

    public function primitiveCipher(string $arg):string
    {
        $secret="";
        for($i=0;$i<strlen($arg);$i++){
            $randChar=array_rand($this->chars,1);
            $secret.=$this->chars[$randChar];
        }
        return $secret;
    }

    public function delSpesific(array $baseArr,array $delSourceArr):array{
        $temp = array_splice($baseArr, 0, count($baseArr));
        foreach ($temp as $base){
            foreach ($delSourceArr as $del) {
                if($base==$del){
                    unset($temp[array_search($del,$temp)]);
                }
            }
        }
        return array_values($temp);
    }

    //callable

    public function cipher(array $baseArr,int $limit=self::LIMIT):string
    {
        $secret="";
        for($i=0;$i<$limit;$i++){
            $randChar=array_rand($baseArr,1);
            $secret.=$baseArr[$randChar];
        }
        return $secret;
    }

    public function looper(int $limit, array $arr):array{
        $myarr=array();
        for($i=0;$i<$limit;$i++){
            array_push($myarr,call_user_func_array(array($this,'cipher'),array($arr)));
        }
        return $myarr;
    }

    /*
    public function specialCipher(string $arg,int $limit=self::LIMIT):string
    {
        $secret="";
        for($i=0;$i<$limit;$i++){
            $randChar=array_rand($this->specials,1);
            $secret.=$this->chars[$randChar];
        }
        return $secret;
    }
    */

}
use \Wizard;
$cip=new Cipher();
$text="say hello to my little function";
//echo $wiz->primitiveCipher("say hello to my little function");
//echo $wiz->charCipher($text);
//echo $wiz->charCipher($text,64);

/*
print_r($cip->delSpesific($cip->getAll(),array("0","A","a","X","x","[","]","#","!")));
print_r($cip->getAll());
print_r($cip->delSpesific($cip->getChars(),array("0","A","a","X","x")));
print_r($cip->getChars());
print_r($cip->delSpesific($cip->getSpecials(),array("#","$","%","&","@","[")));
print_r($cip->getSpecials());
*/
$cip=new Cipher();
//print_r($cip->getAll());
$arr=$cip->delSpesific($cip->getAll(),array("0","A","a","X","x","[","]","#","!"));
//print_r($arr);
//echo $cip->cipher($arr);
//echo $cip->cipher($arr,64);
print_r($cip->looper(23,$arr));
