<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 23.07.18 8:51.
 */

namespace App\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheckController extends AbstractController
{
    /**
     * @Route("/health-check", name="health_check")
     */
    public function check(): Response
    {
        return new Response();
    }
}
