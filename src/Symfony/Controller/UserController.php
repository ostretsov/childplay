<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 11.07.18 8:46.
 */

namespace App\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function register(Request $request): Response
    {
        return new Response();
    }
}
