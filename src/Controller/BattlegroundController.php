<?php

namespace App\Controller;

use App\Service\Battleground;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class BattlegroundController extends AbstractController
{
    #[Route("/battle/{army1?}&{army2}", name:"app_home")]
    /**
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function home(Request $request, $army1, $army2, Battleground $battleground): Response
    {
        $alliance = (int)$army1;
        $horde = (int)$army2;
        if ($alliance <= 0 || $horde <= 0) {
            throw new BadRequestHttpException('Enter proper values for both alliance and horde');
        }
        return new Response($battleground->battleStart($alliance,$horde));
    }
}
