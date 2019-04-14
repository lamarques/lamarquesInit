<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(UserRepository $userRepository)
    {
        if (!$this->isGranted('CREATE', 'Administração')) {
            echo "to fora"; exit();
        }
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'users' => $userRepository->findAll()
        ]);
    }
}
