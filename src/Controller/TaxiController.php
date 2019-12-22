<?php

namespace App\Controller;

use App\Entity\Taxi;
use App\Form\TaxiFormType;
use App\Repository\TaxiRepository;

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
class TaxiController extends FOSRestController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var TaxiRepository
     */
    private $taxiRepository;
    public function __construct(
        EntityManagerInterface $entityManager,
        TaxiRepository $taxiRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->taxiRepository=$taxiRepository;
    }
    //ShowAll
    /**
     * @Rest\Get("/Taxis",name="getTaxis")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function getTaxisAction()
    {   
        $Taxis=$this->taxiRepository->findAll();
        if (empty($Taxis)) {
            return new JsonResponse(['message' => 'not found'], Response::HTTP_NOT_FOUND);
        }
        return $Taxis;
    }
    //ShowOne
    /**
     * @Rest\Get("/Taxis/{id}",name="getTaxi")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function getTaxiAction($id)
    {
        $Taxi=$this->taxiRepository->find($id);
        if (empty($Taxi)) {
            return new JsonResponse(['message' => 'not found'], Response::HTTP_NOT_FOUND);
        }
        return $Taxi;
    }
    //New
    /**
     * @Rest\Post("/Taxis",name="NewTaxi")
     * @View()
     */
    public function postTaxiAction(Request $request)
    {
        $form=$this->createForm(TaxiFormType::class,new Taxi);
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
     * @Rest\Put("/Taxis/{id}",name="UpdateTaxi")
     * @View()
     */
    public function putTaxiAction(Request $request,$id)
    {
        $data = json_decode(
            $request->getContent(),
            true
        );
        $getTaxi=$this->taxiRepository->find($id);
        $form=$this->createForm(TaxiFormType::class,$getTaxi);
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
     * @Rest\Delete("/Taxis/{id}",name="DeleteTaxi")
     * @View()
     */
    public function deleteTaxiAction($id)
    {
        $getTaxi=$this->taxiRepository->find($id);
        $this->entityManager->remove($getTaxi);
        $this->entityManager->flush();
        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
