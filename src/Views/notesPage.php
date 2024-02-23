<!DOCTYPE html>
<html lang="en">
<head>
    <?php include $elementsPath . "links.php"?>
    <link rel="stylesheet" href="/src/Static/css/notesStyles.css">
    <meta charset="UTF-8">
    <title>Notes</title>
</head>
<body>
    <div class="main-window">
        <?php include $elementsPath . "header.php" ?>
        <div class="content">
            <div class="inner">
                <?php 
                if (isset($n)) {
                    foreach ($n as $i) {?>
                        <div class="note-item">
                            <div class="note-item-title"><?= $i->title?></div>
                            <div class="note-item-nav">
                                <a href="/note/edit/<?=$i->getId()?>" class="note-item-nav-button">edit</a>
                                <a href="/note/delete/<?=$i->getId()?>" class="note-item-nav-button">delete</a>
                            </div>
                        </div>
                <?php
                    }
                } else {?>
                    <div class="no-items">no items to show</div>  
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>