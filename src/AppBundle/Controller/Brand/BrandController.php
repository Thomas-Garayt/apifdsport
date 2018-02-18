<?php

namespace AppBundle\Controller\Brand;

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
use AppBundle\Entity\Brand;


class BrandController extends ControllerBase {

    /**
    * @ApiDoc(
    *      resource=true, section="Brand",
    *      description="Get the Brands",
    *      output= { "class"=Brand::class, "collection"=true, "groups"={"base", "brand"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "brand"})
    * @Rest\Get("/brands")
    */
    public function getBrandsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $brands = $em->getRepository(Brand::class)->findAll();

        if (empty($brands)) {
            throw $this->getBrandNotFoundException();
        }

        return $brands;
    }


    /**
    * @ApiDoc(
    *      resource=true, section="Brand",
    *      description="Get one brand by id",
    *      output= { "class"=Brand::class, "collection"=false, "groups"={"base", "brand"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "brand"})
    * @Rest\Get("/brands/{id}")
    */
    public function getBrandByIdAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $brand = $em->getRepository(Brand::class)->find($request->get("id"));

        if (empty($brand)) {
            throw $this->getBrandNotFoundException();
        }

        return $brand;
    }

    private function getBrandNotFoundException() {
        return new NotFoundHttpException("No brands found");
    }

}
