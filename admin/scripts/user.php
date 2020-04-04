<?php 
function createUser($username, $password, $email){
    $pdo = Database::getInstance()->getConnection();
    
    $create_user_query = 'INSERT INTO tbl_user_info(user_name, user_pass, user_email, user_ip)';
    $create_user_query .= ' VALUES(:username, :password, :email, "no" )';

    $create_user_set = $pdo->prepare($create_user_query);
    $create_user_result = $create_user_set->execute(
        array(
            ':username'=>$username,
            ':password'=>$password,
            ':email'=>$email,
        )
    );
     //redirect to login after create user successfully
    if($create_user_result){
        redirect_to('admin_login.php');
    }else{
        return 'The user did not go through';
    }
}

function getSingleUser($id){
    $pdo = Database::getInstance()->getConnection();

    $get_user_query = 'SELECT * FROM tbl_user_info WHERE user_id = :id';
    $get_user_set = $pdo->prepare($get_user_query);
    $get_user_result = $get_user_set->execute(
        array(
            ':id'=>$id
        )
    );

    if($get_user_result && $get_user_set->rowCount()){
        return $get_user_set;
    }else{
        return false;
    }
}

function editUser($id, $username, $password, $email){
    $pdo = Database::getInstance()->getConnection();

    $update_user_query = 'UPDATE tbl_user_info SET user_name=:username';
    $update_user_query .= ', user_pass=:password, user_email=:email';
    $update_user_query .= ' WHERE user_id=:id';
    $update_user_set = $pdo->prepare($update_user_query);
    $update_user_result = $update_user_set->execute(
        array(
            ':username'=>$username,
            ':password'=>$password,
            ':email'=>$email,
            ':id'=>$id
        )
    );

    if($update_user_result){
        redirect_to('admin_login.php');
    }else{
        return 'Failed! Please Try Again!';
    }
}

