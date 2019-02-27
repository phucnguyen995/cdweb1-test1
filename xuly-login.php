 <?php
 session_start();
 require "db/db.php";
 $db = new db();
  if (isset($_POST['login']))
      {
        
        date_default_timezone_set('Asia/Ho_Chi_Minh');
       
        $now = time();
       
        $now = date('Y-m-d H:i:s', $now);
        
        $user = $db->getUser($_POST['email']);
        $fail = $user['attempt'];
        $lastAccess = $user['last_access'];
        $txtEmail = $_POST['email'];
        $txtPassword = sha1($_POST['password']);

        $lastAccess =  strtotime($lastAccess);
        $now = strtotime($now);
        var_dump(($now - $lastAccess));
        if ($fail < 3)
        {
            if ($db->login($txtEmail, $txtPassword, $user['email'], $user['password'])){
            $_SESSION['id'] = $user['id'];
            $_SESSION['user'] = $user['name'];
            $lastAcess = $db->lastAccess($user['email']);
            $db->reset_login($user['email']);
            header('location:index.php');
            }
            else
            {
                $_SESSION['loginfail'] = "Login failed!";
                $checkEmail = $db->checkEmail($_POST['email']);
                if ($checkEmail > 0)
                {
                    $id = $user['id'];
                    $user['attempt']++;
                    $coutAtt = $db->countAttempt($user['attempt'], $id);
                    $lastAcess = $db->lastAccess($user['email']);
                    
                }
                header('location:login.php');
            }
        }

        else if($fail >= 3 && ($now - $lastAccess) < 30*60) 
        {
            $t = ((30*60) - ($now - $lastAccess))/60;
            $_SESSION['fail_3time'] = "Bạn đăng nhập sai " . $fail . " lần! Thử lại sau " . round($t,0) ." minute!";
            header('Location:login.php');
        }

        else if($fail >= 3 && ($now - $lastAccess) > 30*60) 
        {
            if ($db->login($txtEmail, $txtPassword, $user['email'], $user['password'])){
            $_SESSION['id'] = $user['id'];
            $_SESSION['user'] = $user['name'];
            $lastAcess = $db->lastAccess($user['email']);
            $db->reset_login($user['email']);
            header('location:index.php');
            }
            else
            {
                $_SESSION['loginfail'] = "Login failed!";
                $checkEmail = $db->checkEmail($_POST['email']);
                if ($checkEmail > 0)
                {
                    $id = $user['id'];
                    $user['attempt']++;
                    $coutAtt = $db->countAttempt($user['attempt'], $id);
                    $lastAcess = $db->lastAccess($user['email']);
                    
                }
                header('location:login.php');
            }
        } 
    }
 
?>