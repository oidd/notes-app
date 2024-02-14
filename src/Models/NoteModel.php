<?php

namespace App\Models;

class NoteModel
{
    function __construct(private $id, private $title, private $data)
    {}
}