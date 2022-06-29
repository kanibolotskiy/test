<?php 
    $users=[
        ["id"=>1,"name"=>"Dennis","email"=>"kanibolotskiy@gmail.com"],
        ["id"=>2,"name"=>"Dennis2","email"=>"kanibolotskiy1@gmail.com"],
        ["id"=>3,"name"=>"Dennis3","email"=>"kanibolotskiy2@gmail.com"],
    ];

    
    

    $flag=true;
    $email = htmlspecialchars($_POST['email']);
    $name = htmlspecialchars($_POST['name']);
    $sname = htmlspecialchars($_POST['sname']);
    $pass = htmlspecialchars($_POST['password']);
    $confirm = htmlspecialchars($_POST['confirmpassword']);
    $data['error']=[];
    if(!$email or !$name or !$sname or !$pass or !$confirm){
        $flag=false;
        $data['error'][]='Заполнены не все поля';
    }
    
    if($flag){
        $key_user = array_search($email, array_column($users, 'email'));
        if($key_user!==false){
            $flag=false;
            $data['error'][]='Email уже зарегистрирован';
        }
        
        if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email)) {
            $flag=false;
            $data['error'][]='Некорректный Email';
        }
        if($pass!=$confirm){
            $flag=false;
            $data['error'][]='Пароли не совпадают';
        }
    }

    $data_file="time:".time()."|result:".($flag*1)."|error:".implode(", ",$data['error'])."|name:".$name."|sname:".$sname."|email:".$email."\n";
    file_put_contents('log.txt', $data_file, FILE_APPEND);

    $data['success']=$flag;
    echo json_encode($data);
?>