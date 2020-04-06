<?php

namespace App\Controller;

use App\Entity\Party;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatsController extends AbstractController
{
    /**
     * @Route("/stats", name="stats")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $parties = $this->getDoctrine()->getRepository(Party::class)->findBy(
            ['state' => 1], // Tableau de filtre
            ['id' => 'DESC'], // Tableau de order by
            10 // Nombre max de résultat
        );

        return $this->render('stats/index.html.twig', [
            'controller_name' => 'StatsController',
            'parties' => $parties,
        ]);
    }
}
