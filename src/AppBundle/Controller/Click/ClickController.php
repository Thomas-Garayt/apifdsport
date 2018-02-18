<?php

namespace AppBundle\Controller\Click;

// Required dependencies for Controller and Annotations
use FOS\RestBundle\Controller\Annotations\QueryParam;
use \AppBundle\Controller\ControllerBase;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

// Entity
use AppBundle\Entity\Axe;
use AppBundle\Entity\Click;
use AppBundle\Entity\Cookie;
use AppBundle\Entity\Product;
use AppBundle\Entity\Match;
use AppBundle\Entity\User;

// Exception
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ClickController extends ControllerBase {

    /**
    * @ApiDoc(
    *      resource=true, section="Click",
    *      description="Get the Clicks",
    *      output= { "class"=Click::class, "collection"=false, "groups"={"base", "click"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "click"})
    * @Rest\Get("/clicks")
    */
    public function getClicksAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $clicks = $em->getRepository(Click::class)->findAll();

        if (empty($clicks)) {
            throw $this->getClickNotFoundException();
        }

        return $clicks;
    }


    /**
    * @ApiDoc(
    *      resource=true, section="Click",
    *      description="Get click by id",
    *      output= { "class"=Click::class, "collection"=false, "groups"={"base", "click"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "click"})
    * @Rest\Get("/clicks/{id}")
    */
    public function getClickByIdAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $click = $em->getRepository(Click::class)->findOneById($request->get("id"));

        if (empty($click)) {
            throw $this->getClickNotFoundException();
        }

        return $click;
    }


    /**
    * @ApiDoc(
    *      resource=true, section="Click",
    *      description="Get click by user cookie name",
    *      output= { "class"=Click::class, "collection"=false, "groups"={"base", "click"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "click"})
    * @Rest\Get("/clicks/user/{cookieName}")
    */
    public function getClickByUserAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $cookieName = $request->get('cookieName');

        $cookie = $em->getRepository(Cookie::class)->findOneByName($cookieName);

        if(empty($cookie)) {
            throw new \Exception('Cookie not found');
        }

        $user = $em->getRepository(User::class)->findOneByCookie($cookie);

        if(empty($user)) {
            throw new \Exception('User not found');
        }

        $click = $em->getRepository(Click::class)->findBy([
            "user" => $user
        ], ["id" => "DESC"]);

        if (empty($click)) {
            throw $this->getClickNotFoundException();
        }

        return $click;
    }

    /**
    * @ApiDoc(
    *      resource=true, section="Click",
    *      description="Update User and product Axe - Add new entry into clicks",
    *      output= { "class"=User::class, "collection"=false, "groups"={"base", "user"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "user"})
    * @Rest\Put("/clicks/product/{id}")
    */
    public function updateUserProductAxeAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $data = $request->request->all();
        if(!$data || !isset($data['cookie']) || !isset($data['cookie']['name']) || empty($data['cookie']['name'])) {
            throw new \Exception('Cookie name is empty');
        }

        $cookieName = $data['cookie']['name'];
        $cookie = $em->getRepository(Cookie::class)->findOneByName($cookieName);
        if(!$cookie) {
            throw new \Exception('Cookie not found');
        }

        $user = $em->getRepository(User::class)->findOneByCookie($cookie);
        if(!$user) {
            throw new \Exception('User not found');
        }

        $userAxe = $user->getAxe();
        if(!$userAxe) {
            throw new \Exception('User Axe does not exist');
        }

        $product = $em->getRepository(Product::class)->find($request->get("id"));
        if(!$product) {
            throw new \Exception('Product not found');
        }
        $productAxe = $product->getAxe();


        $this->addProductClick($user, $product);

        if(!$productAxe) {
            $productAxe = new Axe();
            $productAxe->setAge($userAxe->getAge());
            $productAxe->setBrand($userAxe->getBrand());
            $productAxe->setFemale($userAxe->getFemale());
            $productAxe->setMale($userAxe->getMale());
            $productAxe->setCity($userAxe->getCity());
            $productAxe->setCsp($userAxe->getCsp());
            $productAxe->setSport($userAxe->getSport());
            $productAxe->setProduct($product);
            $productAxe->setIsFixed(false);

            $em->persist($productAxe);
            $product->setAxe($productAxe);
            $em->persist($product);

            //$em->merge($product);
            $em->flush();
        }

        $clickUser = $em->getRepository(Click::class)->findByUser($user);

        // Update de l'axe de l'user selon tous ses clicks
        $maleSum = 0;
        $femaleSum = 0;
        $ageSum = 0;
        $cspSum = 0;
        //$countsCity = array();
        //$countsSport = array();

        foreach($clickUser as $click) {

            $product = $click->getProduct();
            $match = $click->getMatch();

            if($product) {
                if($product->getAxe()) {
                    $maleSum += intval($product->getAxe()->getMale());
                    $femaleSum += intval($product->getAxe()->getFemale());
                    $ageSum += intval($product->getAxe()->getAge());
                    $cspSum += intval($product->getAxe()->getCsp());
/*
                    if($product->getAxe()->getCity()) {
                        $countsCity[$product->getAxe()->getCity()]++;
                    }
                    if($product->getAxe()->getSport()) {
                        $countsSport[$product->getAxe()->getSport()]++;
                    }
                    */
                }
            }

            if($match) {
                if($match->getAxe()) {
                    $maleSum += intval($match->getAxe()->getMale());
                    $femaleSum += intval($match->getAxe()->getFemale());
                    $ageSum += intval($match->getAxe()->getAge());
                    $cspSum += intval($match->getAxe()->getCsp());
/*
                    if($match->getAxe()->getCity()) {
                        $countsCity[$match->getAxe()->getCity()]++;
                    }
                    if($match->getAxe()->getSport()) {
                        $countsSport[$match->getAxe()->getSport()]++;
                    }
                    */
                }
            }
        }

        //sort($countsCity, SORT_NUMERIC);
        //sort($countsSport, SORT_NUMERIC);

        //$city = array_keys($countsCity, end($countsCity))[0];
        //$sport = array_keys($countsCity, end($countsCity))[0];

        $nbClick = count($clickUser);
        if($nbClick != 0) {
            $userAxe->setMale($maleSum / $nbClick);
            $userAxe->setFemale($femaleSum / $nbClick);
            $userAxe->setAge($ageSum / $nbClick);
            $userAxe->setCsp($cspSum / $nbClick);
            //$userAxe->setCity($city);
            //$userAxe->setSport($sport);
        }


        $em->persist($userAxe);
        $em->flush();

        // L'axe du produit n'est pas fixé, on l'update donc
        if(!$productAxe->getIsFixed()) {

            $clickProduct = $em->getRepository(Click::class)->findByProduct($product);

            $maleSum = 0;
            $femaleSum = 0;
            $ageSum = 0;
            $cspSum = 0;

            foreach($clickProduct as $click) {

                $user = $click->getUser();

                $maleSum += intval($user->getAxe()->getMale());
                $femaleSum += intval($user->getAxe()->getFemale());
                $ageSum += intval($user->getAxe()->getAge());
                $cspSum += intval($user->getAxe()->getCsp());
                //$countsCity[$user->getAxe()->getCity()]++;
                //$countsSport[$user->getAxe()->getSport()]++;

            }

            //sort($countsCity, SORT_NUMERIC);
            //sort($countsSport, SORT_NUMERIC);

            //$city = array_keys($countsCity, end($countsCity))[0];
            //$sport = array_keys($countsCity, end($countsCity))[0];

            $nbClick = count($clickProduct);
            if($nbClick != 0) {
                $productAxe->setMale($maleSum / $nbClick);
                $productAxe->setFemale($femaleSum / $nbClick);
                $productAxe->setAge($ageSum / $nbClick);
                $productAxe->setCsp($cspSum / $nbClick);
                //$productAxe->setCity($city);
                //$productAxe->setSport($sport);
            }


            $em->persist($productAxe);
        }

        $em->flush();

        return $user;
    }


    /**
    * @ApiDoc(
    *      resource=true, section="Click",
    *      description="Update User and Match Axe - Add new entry into clicks",
    *      output= { "class"=User::class, "collection"=false, "groups"={"base", "user"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "user"})
    * @Rest\Put("/clicks/matchs/{id}")
    */
    public function updateUserTicketAxeAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $data = $request->request->all();
        if(!$data || !isset($data['cookie']) || !isset($data['cookie']['name']) || empty($data['cookie']['name'])) {
            throw new \Exception('Cookie name is empty');
        }

        $cookieName = $data['cookie']['name'];
        $cookie = $em->getRepository(Cookie::class)->findOneByName($cookieName);
        if(!$cookie) {
            throw new \Exception('Cookie not found');
        }

        $user = $em->getRepository(User::class)->findOneByCookie($cookie);
        if(!$user) {
            throw new \Exception('User not found');
        }

        $userAxe = $user->getAxe();
        if(!$userAxe) {
            throw new \Exception('User Axe does not exist');
        }

        $match = $em->getRepository(Match::class)->find($request->get("id"));
        if(!$match) {
            throw new \Exception('Match not found');
        }
        $matchAxe = $match->getAxe();


        $this->addMatchClick($user, $match);

        if(!$matchAxe) {
            $matchAxe = new Axe();
            $matchAxe->setAge($userAxe->getAge());
            $matchAxe->setBrand($userAxe->getBrand());
            $matchAxe->setFemale($userAxe->getFemale());
            $matchAxe->setMale($userAxe->getMale());
            $matchAxe->setCity($userAxe->getCity());
            $matchAxe->setCsp($userAxe->getCsp());
            $matchAxe->setSport($userAxe->getSport());
            $matchAxe->setProduct($product);
            $matchAxe->setIsFixed(false);

            $em->persist($matchAxe);
            $match->setAxe($matchAxe);
            $em->persist($product);

            //$em->merge($product);
            $em->flush();
        }

        $clickUser = $em->getRepository(Click::class)->findByUser($user);

        // Update de l'axe de l'user selon tous ses clicks
        $maleSum = 0;
        $femaleSum = 0;
        $ageSum = 0;
        $cspSum = 0;
        //$countsCity = array();
        //$countsSport = array();

        foreach($clickUser as $click) {

            $product = $click->getProduct();
            $match = $click->getMatch();

            if($product) {
                if($product->getAxe()) {
                    $maleSum += intval($product->getAxe()->getMale());
                    $femaleSum += intval($product->getAxe()->getFemale());
                    $ageSum += intval($product->getAxe()->getAge());
                    $cspSum += intval($product->getAxe()->getCsp());
/*
                    if($product->getAxe()->getCity()) {
                        $countsCity[$product->getAxe()->getCity()]++;
                    }
                    if($product->getAxe()->getSport()) {
                        $countsSport[$product->getAxe()->getSport()]++;
                    }
                    */
                }
            }

            if($match) {
                if($match->getAxe()) {
                    $maleSum += intval($match->getAxe()->getMale());
                    $femaleSum += intval($match->getAxe()->getFemale());
                    $ageSum += intval($match->getAxe()->getAge());
                    $cspSum += intval($match->getAxe()->getCsp());
/*
                    if($match->getAxe()->getCity()) {
                        $countsCity[$match->getAxe()->getCity()]++;
                    }
                    if($match->getAxe()->getSport()) {
                        $countsSport[$match->getAxe()->getSport()]++;
                    }
                    */
                }
            }
        }

        //sort($countsCity, SORT_NUMERIC);
        //sort($countsSport, SORT_NUMERIC);

        //$city = array_keys($countsCity, end($countsCity))[0];
        //$sport = array_keys($countsCity, end($countsCity))[0];

        $nbClick = count($clickUser);
        if($nbClick != 0) {
            $userAxe->setMale($maleSum / $nbClick);
            $userAxe->setFemale($femaleSum / $nbClick);
            $userAxe->setAge($ageSum / $nbClick);
            $userAxe->setCsp($cspSum / $nbClick);
            //$userAxe->setCity($city);
            //$userAxe->setSport($sport);
        }

        $em->persist($userAxe);
        $em->flush();

        // L'axe du produit n'est pas fixé, on l'update donc
        if(!$matchAxe->getIsFixed()) {

            $clickMatch = $em->getRepository(Click::class)->findByProduct($match);

            $maleSum = 0;
            $femaleSum = 0;
            $ageSum = 0;
            $cspSum = 0;

            foreach($clickMatch as $click) {
                $user = $click->getUser();

                $maleSum += intval($user->getAxe()->getMale());
                $femaleSum += intval($user->getAxe()->getFemale());
                $ageSum += intval($user->getAxe()->getAge());
                $cspSum += intval($user->getAxe()->getCsp());
                //$countsCity[$user->getAxe()->getCity()]++;
                //$countsSport[$user->getAxe()->getSport()]++;

            }

            //sort($countsCity, SORT_NUMERIC);
            //sort($countsSport, SORT_NUMERIC);

            //$city = array_keys($countsCity, end($countsCity))[0];
            //$sport = array_keys($countsCity, end($countsCity))[0];

            $nbClick = count($clickProduct);
            if($nbClick != 0) {
                $matchAxe->setMale($maleSum / $nbClick);
                $matchAxe->setFemale($femaleSum / $nbClick);
                $matchAxe->setAge($ageSum / $nbClick);
                $matchAxe->setCsp($cspSum / $nbClick);
                //$productAxe->setCity($city);
                //$productAxe->setSport($sport);
            }

            $em->persist($matchAxe);
        }

        $em->flush();

        return $user;
    }

    private function addProductClick($user, $product) {
        $em = $this->getDoctrine()->getManager();
        $click = new Click();
        $click->setUser($user);
        $click->setProduct($product);
        $em->persist($click);
        $em->flush();
    }


    private function addMatchclick($user, $match) {
        $em = $this->getDoctrine()->getManager();
        $click = new Click();
        $click->setUser($user);
        $click->setMatch($match);
        $em->persist($click);
        $em->flush();
    }

    private function getClickNotFoundException() {
        return new NotFoundHttpException("No clicks found");
    }

}
