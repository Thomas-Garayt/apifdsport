<?php

namespace AppBundle\Controller\Axe;

// Required dependencies for Controller and Annotations
use FOS\RestBundle\Controller\Annotations\QueryParam;
use \AppBundle\Controller\ControllerBase;
use FOS\RestBundle\Request\ParamFetcher;
use References\Fixture\ODM\MongoDB\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

// Exception
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// Entity
use AppBundle\Entity\Axe;
use AppBundle\Entity\User;

class AxeController extends ControllerBase {

    /**
    * @ApiDoc(
    *      resource=true, section="Axe",
    *      description="Get all the axes",
    *      output= { "class"=Axe::class, "collection"=true, "groups"={"base"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "axe"})
    * @Rest\Get("/axes")
    */
    public function getAxesAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $axes = $em->getRepository(Axe::class)->findAll();

        if (empty($axes)) {
            throw $this->getAxeNotFoundException();
        }

        return $axes;
    }


    /**
    * @ApiDoc(
    *      resource=true, section="Axe",
    *      description="Get one axe by id",
    *      output= { "class"=Axe::class, "collection"=false, "groups"={"base", "axe"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "axe"})
    * @Rest\Get("/axes/{id}")
    */
    public function getAxeByIdAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $axe = $em->getRepository(Axe::class)->find($request->get("id"));

        if (empty($axe)) {
            throw $this->getAxeNotFoundException();
        }

        return $axe;
    }

    private function getAxeNotFoundException() {
        return new NotFoundHttpException("No axes found");
    }

}
