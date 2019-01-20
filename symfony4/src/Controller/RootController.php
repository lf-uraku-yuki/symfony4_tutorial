<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
    public function bookDetailAction($book_id)
    {
        return $this->render('books/detail.html.twig', [
            'book_id' => $book_id,
            'book_detail' => 'dumy text'
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

}
