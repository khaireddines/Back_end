<?php

namespace App\Controller;

use App\Entity\CarRent;
use App\Form\CarRentFormType;
use App\Repository\CarRentRepository;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * @Rest\Prefix("api")
 */
class CarRentController extends FOSRestController
{
     /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var CarRentRepository
     */
    private $carRentRepository;
    public function __construct(
        EntityManagerInterface $entityManager,
        CarRentRepository $carRentRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->carRentRepository=$carRentRepository;
    }
    //ShowAll
    /**
     * @Rest\Get("/Cars",name="getCars")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function getCarsAction()
    {   
        $Cars=$this->carRentRepository->findAll();
        if (empty($Cars)) {
            return new JsonResponse(['message' => 'not found'], Response::HTTP_NOT_FOUND);
        }
        return $Cars;
    }
    //ShowOne
    /**
     * @Rest\Get("/Cars/{id}",name="getCar")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function getCarAction($id)
    {
        $Car=$this->accommodationRepository->find($id);
        if (empty($Car)) {
            return new JsonResponse(['message' => 'not found'], Response::HTTP_NOT_FOUND);
        }
        return $Car;
    }
    //New
    /**
     * @Rest\Post("/Cars",name="NewCar")
     * @View()
     */
    public function postCarAction(Request $request)
    {
        $form=$this->createForm(CarRentFormType::class,new CarRent);
        $form->submit($request->request->all());
        if (false === $form->isValid()) 
        {
            return $form;
        }
        $this->entityManager->persist($form->getData());
        $this->entityManager->flush();
        return new JsonResponse(['status' => 'ok',], Response::HTTP_CREATED);
    }
    //Update
    /**
     * @Rest\Put("/Cars/{id}",name="UpdateCar")
     * @View()
     */
    public function putCarAction(Request $request,$id)
    {
        $data = json_decode(
            $request->getContent(),
            true
        );
        $getCar=$this->carRentRepository->find($id);
        $form=$this->createForm(CarRentFormType::class,$getCar);
        $form->submit($data);
        if (false === $form->isValid()) 
        {
            return new JsonResponse(
                [
                    'status' => 'error',
                    'errors' => $this->formErrorSerializer->convertFormToArray($form),
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
        $this->entityManager->flush();
        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }
    //Delete
    /**
     * @Rest\Delete("/Cars/{id}",name="DeleteCar")
     * @View()
     */
    public function deleteCarAction($id)
    {
        $getCar=$this->carRentRepository->find($id);
        $this->entityManager->remove($getCar);
        $this->entityManager->flush();
        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
