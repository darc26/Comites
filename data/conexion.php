 <?php

	error_reporting(0);
	define("cServidor", "localhost");
	define("cUsuario", "root");
	define("cPass","");
	define("cBd","bdproyecto1");
	$userName = 'andres.199207@gmail.com'; //"adminpavas@pavas.com.co"
	$passWord = 'Bayron.1214';
	$from = "ADMIN TRILLADORA";
	$smtp = true;

    $conectar = mysqli_connect(cServidor, cUsuario, cPass, cBd);
	mysqli_query($conectar,"SET NAMES 'utf8'");
	$urlweb = $_SERVER["HTTP_HOST"]."/TRILLADORA/";
    $inactivo = 60;

    function br2nl($string)
	{
	    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
	}

	function decrypt($string, $key)
    {
       $result = "";
       $string = base64_decode($string);
       for($i=0; $i<strlen($string); $i++) 
       {
           $char = substr($string, $i, 1);
           $keychar = substr($key, ($i % strlen($key))-1, 1);
           $char = chr(ord($char)-ord($keychar));
           $result.=$char;
       }
       return $result;
    }
    function encrypt($string, $key) 
    {
       $result = "";	
       for($i=0; $i<strlen($string); $i++) 
       {	
           $char = substr($string, $i, 1);
           $keychar = substr($key, ($i % strlen($key))-1, 1);
           $char = chr(ord($char)+ord($keychar));
           $result.=$char;
       }
       return base64_encode($result);
    }
?>
