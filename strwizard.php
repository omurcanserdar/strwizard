<?php
namespace Cipher;

class StrWizard
{

    public array $chars,$symbols,$all;
    public const LIMIT=32;

    public function __construct()
    {
        $this->chars=array_merge(range('A', 'Z'), range('a', 'z'),range(0,9));
        $this->symbols=str_split("!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~");
        $this->all=array_merge($this->chars,$this->symbols);
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

    //callable

    public function charCipher(string $arg,int $limit=self::LIMIT):string
    {
        $secret="";
        for($i=0;$i<$limit;$i++){
            $randChar=array_rand($this->chars,1);
            $secret.=$this->chars[$randChar];
        }
        return $secret;
    }

    public function symbolCipher(string $arg,int $limit=self::LIMIT):string
    {
        $secret="";
        for($i=0;$i<$limit;$i++){
            $randChar=array_rand($this->symbols,1);
            $secret.=$this->chars[$randChar];
        }
        return $secret;
    }


    public function delSpesificSymbols(array $delSourceArr):array
    {
        $temp = array_splice($this->symbols, 0, count($this->symbols));
        foreach ($temp as $baseS){
            foreach ($delSourceArr as $delS) {
                if($baseS==$delS){
                    unset($temp[array_search($delS,$temp)]);
                }
            }
        }
        return array_values($temp);
    }

    public function delSpesificChars(array $delSourceArr):array
    {
        $temp = array_splice($this->chars, 0, count($this->chars));
        foreach ($temp as $baseS){
            foreach ($delSourceArr as $delS) {
                if($baseS==$delS){
                    unset($temp[array_search($delS,$temp)]);
                }
            }
        }
        return array_values($temp);
    }

    public function delSpesificAllChars(array $delSourceArr):array
    {
        $temp = array_splice($this->all, 0, count($this->all));
        foreach ($temp as $baseS){
            foreach ($delSourceArr as $delS) {
                if($baseS==$delS){
                    unset($temp[array_search($delS,$temp)]);
                }
            }
        }
        return array_values($temp);
    }


}
use \Cipher;
$wiz=new StrWizard();
$text="say hello to my little function";
//print_r($wiz->delSpesificSymbols(array("#","$","%","&","@","[")));
//print_r($wiz->delSpesificChars(array("0","A","a","X","x")));
//print_r($wiz->delSpesificAllChars(array("0","A","a","X","x","[","]","#","!")));
//echo $wiz->primitiveCipher("say hello to my little function");
echo $wiz->charCipher($text);
echo $wiz->charCipher($text,64);