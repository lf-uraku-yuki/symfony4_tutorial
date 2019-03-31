<?php

namespace App\Repository\Impl;

use App\Repository\BooksRepository;

class BooksRepositoryImpl implements BooksRepository
{

    /** @var \Doctrine\DBAL\Connection connection */
    protected $db;

    /** @var Psr\Log\LoggerInterface logger */
    protected $logger;

    public function __construct(\Doctrine\DBAL\Connection $con, \Psr\Log\LoggerInterface $logger)
    {
        $this->db = $con;
        $this->logger = $logger;
    }

    public function get(int $book_id)
    {
        $sql = "SELECT * FROM books WHERE book_id = :book_id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue("book_id", $book_id);
        $stmt->execute();

        $book = $stmt->fetch();

        return $book;
    }
}