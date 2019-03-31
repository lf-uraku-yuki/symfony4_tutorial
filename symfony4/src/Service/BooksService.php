<?php
namespace App\Service;

use App\Repository\BooksRepository;

class BooksService
{
    private $booksRepository;

    /** @var Psr\Log\LoggerInterface logger */
    protected $logger;

    public function __construct(BooksRepository $booksRepository, \Psr\Log\LoggerInterface $logger)
    {
        $this->booksRepository = $booksRepository;
        $this->logger = $logger;
    }

    public function bookDetail(int $book_id)
    {
        $this->logger->log('info', 'book_id: ' . $book_id . ' の詳細データを取得して返します');
        return $this->booksRepository->get($book_id);
    }

}
