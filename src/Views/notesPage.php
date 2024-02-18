<?php
    function insert_note($n)
    {
        echo '<div class="note-item">';
        echo '<a class="note-item-show" href="/note/show/' . $n->getId() . '">' . $n->title . '</a>';
        echo '<a class="note-item-delete" href="/note/delete/' . $n->getId() . '">' . 'delete' . '</a>';
        echo '<a class="note-item-edit" href="/note/edit/' . $n->getId() . '">' . 'edit' . '</a>';
        echo '</div>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="src/Static/css/notesStyles.css">
    <meta charset="UTF-8">
    <title>Notes</title>
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
        <div class="content">
            <div class="inner">
                <?php
                foreach ($notes as $i)
                    insert_note($i);
                ?>
            </div>
        </div>
    </div>
</body>
</html>