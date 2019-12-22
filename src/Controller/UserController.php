<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;

class UserController extends FOSRestController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserRepository
     */
    private $userRepository;
    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $taxiRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->taxiRepository=$taxiRepository;
    }
    /**
     * @Rest\Post("/User",name="NewUser")
     * @View()
     */
    public function new (Request $request)
    {
        $form=$this->createForm(UserType::class,new User);
        $form->submit($request->request->all());
        
        $this->entityManager->persist($form->getData());
        $this->entityManager->flush();
        return new JsonResponse(['status' => 'ok',], Response::HTTP_CREATED);
    }
}
