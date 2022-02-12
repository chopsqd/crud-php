<?php

    include 'db.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $get_id = $_GET['id'];

    //Create
    if(isset($_POST['add'])) {
        $sql = ("INSERT INTO users (name, email, flag) VALUES (?,?,?)");
        $query = $pdo->prepare($sql);
        $query->execute([$name, $email, 1]);
        if($query) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    //Read
    $sql = $pdo->prepare("SELECT * FROM users WHERE flag = 1");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_OBJ);

    //Update
    if(isset($_POST['edit'])) {
        $sql = ("UPDATE users SET name=?, email=?, flag=? WHERE id=?");
        $query = $pdo->prepare($sql);
        $query->execute([$name, $email, 1, $get_id]);
        if($query) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    //Delete
    if(isset($_POST['delete'])) {
        $sql = ("UPDATE users SET flag = 0 WHERE id=?");
        $query = $pdo->prepare($sql);
        $query->execute([$get_id]);
        if($query) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

