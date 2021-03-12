<?php
class StrWizard{

    public $c1,$c2,$chars;

    public function __construct(){
        $this->c1=array_merge(range('A', 'Z'), range('a', 'z'),range(0,9));
        $this->c2=str_split("!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~");
        $this->chars=array_merge($this->c1,$this->c2);
    }

    /*
    $tr_chars=array('Ç','ç','Ğ','ğ','İ','Ö','ö','Ü','ü');
    üretilen metinde ne kadar tr karakter kullanılırsa, uretilendeki toplam uzunluk;
    kullanılan tr karakter sayısı kadar artacak
    */

    //https://www.php.net/manual/tr/migration71.new-features.php   public function primitiveGenerator($arg):string{
    public function primitiveGenerator($arg):string{
        $secret="";
        for($i=0;$i<strlen($arg);$i++){
            $randchar=array_rand($this->chars,1);
            $secret.=$this->chars[$randchar];
        }
        return $secret;
    }
}

$wiz=new StrWizard();
echo $uretilen=$wiz->primitiveGenerator("say hello to my little function");
