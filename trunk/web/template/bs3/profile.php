<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
	require_once("../../include/db_info.inc.php");
	if(isset($OJ_LANG)){
		require_once("../../lang/$OJ_LANG.php");
	}else{
		require_once("../../lang/en.php");
	}
    function checkmail(){
		
		$sql="SELECT count(1) FROM `mail` WHERE 
				new_mail=1 AND `to_user`='".$_SESSION['user_id']."'";
		$result=mysql_query($sql);
		if(!$result) return false;
		$row=mysql_fetch_row($result);
		$retmsg="<span id=red>(".$row[0].")</span>";
		mysql_free_result($result);
		return $retmsg;
	}
	$profile='';
		if (isset($_SESSION['user_id'])){
				$sid=$_SESSION['user_id'];
				$profile.= "<i class=icon-user></i><li><a href=./modifypage.php>$MSG_USERINFO</a></li>&nbsp;<li><a href='./userinfo.php?user=$sid'><span id=red>$sid</span></a></li>";
				$mail=checkmail();
				if ($mail)
					$profile.= "&nbsp;<i class=icon-envelope></i><li><a href=./mail.php>$mail</a></li>";
        $profile.="&nbsp;<li><a href='./status.php?user_id=$sid'><span id=red>Recent</span></a></li>";
                                
				$profile.= "&nbsp;<li><a href=./logout.php>$MSG_LOGOUT</a></li>&nbsp;";
			}else{
                if ($OJ_WEIBO_AUTH){
				    $profile.= "<li><a href=./login_weibo.php>$MSG_LOGIN(WEIBO)</a></li>&nbsp;";
                }
                if ($OJ_RR_AUTH){
				    $profile.= "<li><a href=./login_renren.php>$MSG_LOGIN(RENREN)</a></li>&nbsp;";
                }
                if ($OJ_QQ_AUTH){
            $profile.= "<li><a href=./login_qq.php>$MSG_LOGIN(QQ)</a></li>&nbsp;";
                }
				$profile.= "<li><a href=./loginpage.php>$MSG_LOGIN</a></li>&nbsp;";
				if($OJ_LOGIN_MOD=="hustoj"){
					$profile.= "<li><a href=./registerpage.php>$MSG_REGISTER</a></li>&nbsp;";
				}
			}
			if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])||isset($_SESSION['problem_editor'])){
           $profile.= "<li><a href=./admin/>$MSG_ADMIN</a></li>&nbsp;";
			
			}
	 //  $profile.="</ul></li>";
		?>
document.write("<?php echo ( $profile);?>");
document.getElementById("profile").innerHTML="<?php echo  $sid?$sid:$MSG_LOGIN  ?>";
