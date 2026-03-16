<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/orders', name: 'order_list')]
    public function index(OrderRepository $orderRepository): Response
    {
        /*$orders = $orderRepository->findBy(
            ['user' => $this->getUser()],
            ['createdAt' => 'DESC']
        );*/

        $orders = $orderRepository->findOrdersForUser($this->getUser());

        return $this->render('order/list.html.twig', [
            'orders' => $orders,
        ]);
    }
}