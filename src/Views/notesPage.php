<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notes</title>
</head>
<body>
    <?php
    if (isset($notes) && count($notes) > 0)
    {
        echo "Notes list: <br>";
        foreach ($notes as $i)
        {
            echo "$i->title " . "<a href='/note/show/{$i->getId()}'>see</a> <a href='/note/delete/{$i->getId()}'>delete</a><br>";
        }
    }
    else
        echo "seems that you don't have any notes yet.";
    ?>

    <div>
        <a href='/note/create'>click to add new note</a>
    </div>
</body>
</html>