<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Party;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Controller\UserController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $repository = $this->getDoctrine()->getRepository(Party::class);

        $party = $repository->findOneBy(['user_id'=> $this->getUser()->getId(),'state' => 0]);

        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
            'party' => $party
        ]);
    }

    /**
     * @Route("/updateNbTry", name="updateNbTry", methods="POST")
     * @param Request $request
     * @return Response
     */
    public function updateNbTry(Request $request){
        $nbtry = $request->get('nbtry');
        $id = $request->get('partyid');

        $entityManager = $this->getDoctrine()->getManager();
        $party = $entityManager->getRepository(Party::class)->find($id);

        if (!$party) {
            throw $this->createNotFoundException(
                'Aucune partie trouvée pour cet id '
            );
        }
        $party->setNbTry($nbtry);
        $entityManager->flush();
        $response = new Response(json_encode($nbtry));
        return $response;
    }

    /**
     * @Route("/updateCards", name="updateCards", methods="POST")
     * @param Request $request
     * @return Response
     */
    public function updateCards(Request $request){

        $cards = $request->get('cards');
        $id = $request->get('partyid');

        $entityManager = $this->getDoctrine()->getManager();
        $party = $entityManager->getRepository(Party::class)->find($id);

        if (!$party) {
            throw $this->createNotFoundException(
                'Aucune partie trouvée pour cet id '
            );
        }
        $party->setCards($cards);
        $entityManager->flush();
        $response = new Response(json_encode($cards));
        return $response;
    }
    /**
     * @Route("/updateState", name="updateState", methods="POST")
     * @param Request $request
     * @return Response
     */
    public function updateState(Request $request){

        $state = $request->get('state');
        $id = $request->get('partyid');

        $entityManager = $this->getDoctrine()->getManager();
        $party = $entityManager->getRepository(Party::class)->find($id);

        if (!$party) {
            throw $this->createNotFoundException(
                'Aucune partie trouvée pour cet id '
            );
        }
        $party->setState($state);
        $entityManager->flush();
        $response = new Response(json_encode($state));
        return $response;
    }
    /**
     * @Route("/game_create", name="game_create", methods="POST")
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return Response
     * @throws \Exception
     */
    public function create(Request $request,ValidatorInterface $validator){
        $cards = [];
        for($i = 1; $i < ($request->get('nb_cards')/2)+1; $i++){
            array_push($cards, $i."x0");
            array_push($cards, $i."x0");
        }
        shuffle($cards);
        $party = new Party();
        $party->setDateStarted(new \DateTime());
        $party->setUserId($this->getUser()->getId());
        $party->setNbTry(0);
        $party->setCards(join($cards, ";"));
        $party->setNbCards($request->get('nb_cards'));
        $party->setState(0);
        $entityManager = $this->getDoctrine()->getManager();


        $errors = $validator->validate($party);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }
        $entityManager->persist($party);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->redirectToRoute('game');
    }
    /**
     * @Route("/leaveGame/{id}/", name="leaveGame")
     * @param Request $request
     */
    public function delete(Request $request, $id){
        $entityManager = $this->getDoctrine()->getManager();
        $party = $entityManager->getRepository(Party::class)->find($id);

        $entityManager->remove($party);
        $entityManager->flush();

        return $this->redirectToRoute('game');
    }
}
