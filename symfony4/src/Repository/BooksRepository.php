<?php

namespace App\Repository;

interface BooksRepository
{
    public function get(int $book_id);
}