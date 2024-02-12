<?php

declare(strict_types=1);

//grab data if user doesn't exist return false statement
function get_username(object $pdo, string $username)
{
    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}

function get_email(object $pdo, string $email){
    $query = "SELECT username FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}

function set_user(object $pdo, string $pwd,string $username,  string $email)
{
    $query = "INSERT INTO users (username, pwd, email) VALUES  (:username, :pwd, :email );";
    $stmt = $pdo->prepare($query);
    //prevent brute force
    $options =[
        'cost' => 12 
    ];
    //hash password

    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);


    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->bindParam(":email", $email);
    $stmt->execute();   
}