<?php

namespace App\Controller;

use App\Entity\Accommodation;
use App\Form\AccommodationFormType;
use App\Repository\AccommodationRepository;


use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AccommodationController extends FOSRestController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var AccommodationRepository
     */
    private $accommodationRepository;
    public function __construct(
        EntityManagerInterface $entityManager,
        AccommodationRepository $accommodationRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->accommodationRepository=$accommodationRepository;
    }
    //ShowAll
    /**
     * @Rest\Get("/Accommodations",name="getAccoms")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function getAccomsAction()
    {   
        $Accoms=$this->accommodationRepository->findAll();
        if (empty($Accoms)) {
            return new JsonResponse(['message' => 'not found'], Response::HTTP_NOT_FOUND);
        }
        return $Accoms;
    }
    //ShowOne
    /**
     * @Rest\Get("/Accommodations/{id}",name="getAccom")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function getAccomAction($id)
    {
        $Accom=$this->accommodationRepository->find($id);
        if (empty($Accom)) {
            return new JsonResponse(['message' => 'not found'], Response::HTTP_NOT_FOUND);
        }
        return $Accom;
    }
    //New
    /**
     * @Rest\Post("/Accommodations",name="NewAccom")
     * @View()
     */
    public function postAccomAction(Request $request)
    {
        $form=$this->createForm(AccommodationFormType::class,new Accommodation);
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
     * @Rest\Put("/Accommodations/{id}",name="UpdateAccom")
     * @View()
     */
    public function putAccomAction(Request $request,$id)
    {
        $data = json_decode(
            $request->getContent(),
            true
        );
        $getAccom=$this->accommodationRepository->find($id);
        $form=$this->createForm(AccommodationFormType::class,$getAccom);
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
     * @Rest\Delete("/Accommodations/{id}",name="DeleteAccom")
     * @View()
     */
    public function deleteAccomAction($id)
    {
        $getAccom=$this->accommodationRepository->find($id);
        $this->entityManager->remove($getAccom);
        $this->entityManager->flush();
        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
