<?php

if(isset($_POST['signup-submit']))
{

    require 'dbh.inc.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat) )
    {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) &&!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../signup.php?error=invalidmailuid");
        exit(); 
    }
    
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("Location: ../signup.php?error=invalidmail&uid=".$username);
        exit(); 
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../signup.php?error=invalidmail&mail=".$email);
        exit(); 
    }
    else if($password !== $passwordRepeat)
    {
        header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
        exit(); 
    }
    else
    {
        //Query
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        //Iniciando o STATEMENT para preparar as querys do sql
        $stmt = mysqli_stmt_init($conn);
        //associando o banco com a query, verifica se é possivel executa-la
        if (!mysqli_stmt_prepare($stmt, $sql)) 
        {
            //Retorna erro de SQL
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } 
        else
        {
            //Troca o "?" da query pelo valor desejado
            //refereciando o statement, o tipo de valor passado e o valor
            mysqli_stmt_bind_param($stmt, "s", $username);

            //Executa a query
            mysqli_stmt_execute($stmt);

            //Retorna o valor do banco e armazena na variavel stmt
            mysqli_stmt_store_result($stmt);

            //Retorna o número de linhas retornadas após a execução da query
            $resultCheck = mysqli_stmt_num_rows();
            
            // Se o número de linhas for maior que 0, significa que o usuário ja existe
            if ($resultCheck > 0) 
            {
                //ERRO de Usuário Existente
                header("Location: ../signup.php?error=usertakenk&mail=".$email);
                exit();
            }
            else 
            {
                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) 
                {
                    header("Location: ../signup.php?error=sqlerror2");
                    exit();
                } 
                else
                {
                    $hashPwd = password_hash($password, PASSWORD_DEFAULT);
                    // "sss" para 3 valores de string
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }

        }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    
}
else
{
    header("Location: ../signup.php");
    exit();
}

