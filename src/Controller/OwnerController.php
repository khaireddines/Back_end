<?php

namespace App\Controller;

use App\Entity\Owner;
use App\Form\OwnerFormType;
use App\Repository\OwnerRepository;

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
class OwnerController extends FOSRestController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var OwnerRepository
     */
    private $ownerRepository;
    //Injecting The EntityManager Via Constructor
    public function __construct(
        EntityManagerInterface $entityManager,
        OwnerRepository $ownerRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->ownerRepository=$ownerRepository;
    }
    //ShowAll
    /**
     * @Rest\Get("/Owners",name="getOwners")
     * @View()
     */
    public function getOwnersAction()
    {   $owners=$this->ownerRepository->findAll();
        if (empty($owners)) {
            return new JsonResponse(['message' => 'not found'], Response::HTTP_NOT_FOUND);
        }
        return $owners;
    }
    //ShowOne
    /**
     * @Rest\Get("/Owners/{id}",name="getOwner")
     * @View()
     */
    public function getOwnerAction($id)
    {
        $owner=$this->ownerRepository->find($id);
        if (empty($owner)) {
            return new JsonResponse(['message' => 'not found'], Response::HTTP_NOT_FOUND);
        }
        return $owner;
    }
    //New
    /**
     * @Rest\Post("/Owners",name="NewOwner")
     * @View()
     */
    public function postOwnerAction(Request $request)
    {
        $form=$this->createForm(OwnerFormType::class,new Owner);
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
     * @Rest\Put("/Owners/{id}",name="UpdateOwner")
     * @View()
     */
    public function putOwnerAction(Request $request,$id)
    {
        $data = json_decode(
            $request->getContent(),
            true
        );
        $getOwner=$this->ownerRepository->find($id);
        $form=$this->createForm(OwnerFormType::class,$getOwner);
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
     * @Rest\Delete("/Owners/{id}",name="DeleteOwner")
     * @View()
     */
    public function deleteOwnerAction($id)
    {
        $getOwner=$this->ownerRepository->find($id);
        $this->entityManager->remove($getOwner);
        $this->entityManager->flush();
        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
