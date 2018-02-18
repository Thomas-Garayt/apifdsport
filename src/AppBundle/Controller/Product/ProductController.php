<?php

namespace AppBundle\Controller\Product;

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
use AppBundle\Entity\Product;

/**
 * ProductController
 */
class ProductController extends ControllerBase {

    /**
    * @ApiDoc(
    *      resource=true, section="Product",
    *      description="Get the products",
    *      output= { "class"=Product::class, "collection"=true, "groups"={"base", "product"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "product", "axe"})
    * @Rest\Get("/products")
    */
   public function getProductsAction(Request $request) {
       $em = $this->getDoctrine()->getManager();

       $products = $em->getRepository(Product::class)->findNewest();

       if (empty($products)) {
           throw $this->getProductNotFoundException();
       }

       return $products;
   }


    /**
    * @ApiDoc(
    *      resource=true, section="Product",
    *      description="Get newest products",
    *      output= { "class"=Product::class, "collection"=true, "groups"={"base", "product"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "product", "axe"})
    * @Rest\Get("/products/newest/{limit}")
    */
   public function getNewestProductsAction(Request $request) {
       $em = $this->getDoctrine()->getManager();

       $limit = $request->get('limit');

       $products = $em->getRepository(Product::class)->findNewest($limit);

       if (empty($products)) {
           throw $this->getProductNotFoundException();
       }

       return $products;
   }

    /**
    * @ApiDoc(
    *      resource=true, section="Product",
    *      description="Get the products for man",
    *      output= { "class"=Product::class, "collection"=true, "groups"={"base", "product"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "product", "axe"})
    * @Rest\Get("/products/man")
    */
   public function getProductsManAction(Request $request) {
       $em = $this->getDoctrine()->getManager();

       $products = $em->getRepository(Product::class)->findByType("1");

       if (empty($products)) {
           throw $this->getProductNotFoundException();
       }

       return $products;
   }


    /**
    * @ApiDoc(
    *      resource=true, section="Product",
    *      description="Get the products for wooman",
    *      output= { "class"=Product::class, "collection"=true, "groups"={"base", "product"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "product", "axe"})
    * @Rest\Get("/products/woman")
    */
   public function getProductsWomanAction(Request $request) {
       $em = $this->getDoctrine()->getManager();

       $products = $em->getRepository(Product::class)->findByType("2");

       if (empty($products)) {
           throw $this->getProductNotFoundException();
       }

       return $products;
   }

    /**
    * @ApiDoc(
    *      resource=true, section="Product",
    *      description="Get the products for kid",
    *      output= { "class"=Product::class, "collection"=true, "groups"={"base", "product"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "product", "axe"})
    * @Rest\Get("/products/kid")
    */
    public function getProductsKidAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository(Product::class)->findByType("3");

        if (empty($products)) {
            throw $this->getProductNotFoundException();
        }

        return $products;
    }

    /**
    * @ApiDoc(
    *      resource=true, section="Product",
    *      description="Get the products accessories",
    *      output= { "class"=Product::class, "collection"=true, "groups"={"base", "product"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "product", "axe"})
    * @Rest\Get("/products/accessories")
    */
   public function getProductsAccessoriesAction(Request $request) {
       $em = $this->getDoctrine()->getManager();

       $products = $em->getRepository(Product::class)->findByType("4");

       if (empty($products)) {
           throw $this->getProductNotFoundException();
       }

       return $products;
   }

    /**
    * @ApiDoc(
    *      resource=true, section="Product",
    *      description="Get product by id",
    *      output= { "class"=Product::class, "collection"=false, "groups"={"base", "product"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "product"})
    * @Rest\Get("/products/{id}")
    */
   public function getProductByIdAction(Request $request) {
       $em = $this->getDoctrine()->getManager();

       $product = $em->getRepository(Product::class)->findOneById($request->get("id"));

       if (empty($product)) {
           throw $this->getProductNotFoundException();
       }

       return $product;
   }

   private function getProductNotFoundException() {
       return new NotFoundHttpException("Product not found");
   }

}
