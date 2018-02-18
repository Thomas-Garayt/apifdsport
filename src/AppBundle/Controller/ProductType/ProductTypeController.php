<?php

namespace AppBundle\Controller\ProductType;

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
use AppBundle\Entity\ProductType;

class ProductTypeController extends ControllerBase {

    /**
    * @ApiDoc(
    *      resource=true, section="ProductType",
    *      description="Get all the products types",
    *      output= { "class"=ProductType::class, "collection"=false, "groups"={"base", "product_type"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "product_type"})
    * @Rest\Get("/product_types")
    */
    public function getProductTypesAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $product_types = $em->getRepository(ProductType::class)->findAll();

        if (empty($product_types)) {
            throw $this->getProductTypeNotFoundException();
        }

        return $product_types;
    }

    /**
    * @ApiDoc(
    *      resource=true, section="ProductType",
    *      description="Get one type of product by id",
    *      output= { "class"=ProductType::class, "collection"=false, "groups"={"base", "product_type"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "product_type"})
    * @Rest\Get("/product_types/{id}")
    */
    public function getProductTypeByIdAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $product_type = $em->getRepository(ProductType::class)->find($request->get("id"));

        if (empty($product_type)) {
            throw $this->getProductTypeNotFoundException();
        }

        return $product_type;
    }

    private function getProductTypeNotFoundException() {
        return new NotFoundHttpException("No productTypes found");
    }

}
