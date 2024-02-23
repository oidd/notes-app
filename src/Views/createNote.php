<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/src/Static/css/createStyles.css">
    <title>Create new note</title>
</head>
<body>
    <div class="main-window">
        <div class="header">
            <div class="inner">
                <div class="logo">NOTES-APP</div>
                <p class="cur_user">Currently logged as <?=$username?></p>
                <a class="logout" href="/logout">Logout</a>
            </div>
        </div>
        <div class="create-field">
            <div class="inner">
                <div class="errmsg">
                    <?php
                    if (isset($err))
                        foreach ($err as $i)
                            echo $i . " ";
                    ?>
                </div>
                <form method="POST">
                    <input type="text" name="title" placeholder="title" value="<?php 
                            if (isset($fields['title']))
                                echo $fields['title'];
                        ?>" require>
                    <textarea name="data" cols="30" rows="10" placeholder="your text" require><?php 
                            if (isset($fields['data']))
                                echo $fields['data'];?></textarea>
                    <button type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>