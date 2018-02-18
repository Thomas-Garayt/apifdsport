<?php

namespace AppBundle\Controller\Cookie;

// Required dependencies for Controller and Annotations
use FOS\RestBundle\Controller\Annotations\QueryParam;
use \AppBundle\Controller\ControllerBase;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

// Exception
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// Entity
use AppBundle\Entity\Cookie;

class CookieController extends ControllerBase {

    /**
    * @ApiDoc(
    *      resource=true, section="Cookie",
    *      description="Get all Cookies",
    *      output= { "class"=Cookie::class, "collection"=false, "groups"={"base", "cookie"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "cookie"})
    * @Rest\Get("/cookies")
    */
    public function getCookiesAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $cookies = $em->getRepository(Cookie::class)->findAll();

        if (empty($cookies)) {
            throw $this->getCookieNotFoundException();
        }

        return $cookies;
    }

    /**
    * @ApiDoc(
    *      resource=true, section="Cookie",
    *      description="Get one cookie by id",
    *      output= { "class"=Cookie::class, "collection"=false, "groups"={"base", "cookie"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "cookie"})
    * @Rest\Get("/cookies/{id}")
    */
    public function getCookieByIdAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $cookie = $em->getRepository(Cookie::class)->findOneById($request->get("id"));

        if (empty($cookie)) {
            throw $this->getCookieNotFoundException();
        }

        return $cookie;
    }

    private function getCookieNotFoundException() {
        return new NotFoundHttpException("No cookies found");
    }

}
