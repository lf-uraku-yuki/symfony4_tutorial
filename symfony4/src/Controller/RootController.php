<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\BooksService;

class RootController extends AbstractController
{
    /**
     * @Route("/root", name="root")
     */
    public function index()
    {
        return $this->render('root/index.html.twig', [
            'controller_name' => 'RootController',
        ]);
    }

    /**
     * @Route("/root/demo", name="root_demo")
     */
    public function demoAction()
    {
        return $this->render('root/index.html.twig', [
            'controller_name' => 'RootController::demo',
        ]);
    }

    /**
     * @Route("/books/detail/{book_id}/", name="book_detail", 
     * requirements={"book_id"="\d+"})
     */
    public function bookDetailAction($book_id, BooksService $booksService)
    {
        $book = $booksService->bookDetail($book_id);

        return $this->render('books/detail.html.twig', [
            'book_id' => $book_id,
            'book_detail' => $book
        ]);
    }

    /**
     * @Route("/books/detail/", name="book_detail_for_query")
     */
    public function bookDetailActionForQuery(Request $req)
    {
        $book_id = $req->query->get('book_id');

        return $this->render('books/detail.html.twig', [
            'book_id' => $book_id,
            'book_detail' => 'dumy text'
        ]);
    }

    /**
     * @Route("/books/edit/", name="book_edit_exec", methods={"POST"})
     */
    public function bookEditExecAction(Request $req)
    {
        return $this->render('books/detail.html.twig', [
            'book_id' => 0,
            'book_detail' => '編集に成功しました'
        ]);
    }

    /**
     * @Route("/demo404")
     */
    public function demo404Action()
    {
        throw $this->createNotFoundException('見つからないようです');
    }


    /**
     * @Route("/demoJsonResponse")
     */
    public function demoJsonResponse()
    {
        return $this->json([
            'データ1' => 100,
            'データ2' => 200
        ]);
    }


    // 利用するサービスクラスをメソッドインジェクションする

    /**
     * @Route("/service/useService1", methods={"GET"})
     */
    public function useSerivce1(\App\Service\SampleService $sampleService)
    {
        $result = $sampleService->helloWorld();
        
        return $this->render('/service/use_service.html.twig', [
            'body' => $result
        ]);
    }


    // 利用するサービスクラスをコンストラクタインジェクションする
    private $sampleService;
    private $mailService;

    public function __construct(\App\Service\SampleService $sampleService,
        \App\Service\MailService $mailService)
    {
        $this->sampleService = $sampleService;
        $this->mailService = $mailService;
    }

    /**
     * @Route("/service/useService2", methods={"GET"})
     */
    public function useSerivce2()
    {
        $result = $this->sampleService->helloWorld();
        
        return $this->render('/service/use_service.html.twig', [
            'body' => $result
        ]);
    }
}
