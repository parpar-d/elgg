<?php
if(isset($_POST['secret'])&&isset($_POST['code']))
{
    require_once 'GoogleAuthenticator.php';
    $ga = new GoogleAuthenticator();
    if($ga -> verifyCode($_POST['secret'],$_POST['code'],10)) // 10*30 = 300 sec time telorance
    {
        echo "T";
    }
    else
    {
        echo "F";
    }
    
}
else
{
    echo "error";
}

?>