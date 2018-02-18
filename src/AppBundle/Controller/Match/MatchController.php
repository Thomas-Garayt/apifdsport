<?php

namespace AppBundle\Controller\Match;

// Required dependencies for Controller and Annotations
use FOS\RestBundle\Controller\Annotations\QueryParam;
use \AppBundle\Controller\ControllerBase;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use AppBundle\Entity\Match;
use AppBundle\Entity\Ticket;

/**
 * MatchController
 */
class MatchController extends ControllerBase {

    /**
    * @ApiDoc(
    *      resource=true, section="Match",
    *      description="Get all the match.",
    *      output= { "class"=Match::class, "collection"=false, "groups"={"base", "match"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "match"})
    * @Rest\Get("/matchs")
    */
    public function getAllMatchsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $matchs = $em->getRepository(Match::class)->findAvailable();

        if (empty($matchs)) {
            throw $this->getMatchNotFoundException();
        }

        return $matchs;
/*
        $matchs = $em->getRepository(Match::class)->findAll();

        if (empty($matchs)) {
            throw $this->getMatchNotFoundException();
        }

        return $matchs;
*/
    }

    /**
    * @ApiDoc(
    *      resource=true, section="Match",
    *      description="Get most recent matchs",
    *      output= { "class"=Match::class, "collection"=true, "groups"={"base", "match"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "match"})
    * @Rest\Get("/matchs/shortly/{limit}")
    */
    public function getLatestMatchsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $limit = $request->get("limit");

        //$tickets = $em->getRepository(Ticket::class)->findBy(array("date" => new DateTime()), null, $limit);
        $matchs = $em->getRepository(Match::class)->findAvailable($limit);

        if (empty($matchs)) {
            throw $this->getMatchNotFoundException();
        }

        return $matchs;
    }

    /**
    * @ApiDoc(
    *      resource=true, section="Match",
    *      description="Get one match",
    *      output= { "class"=Match::class, "collection"=false, "groups"={"base", "match"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "match"})
    * @Rest\Get("/matchs/{id}")
    */
    public function getMatchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $match = $em->getRepository(Match::class)->findOneById($request->get("id"));

        if (empty($match)) {
            throw $this->getMatchNotFoundException();
        }

        return $match;
    }

    /**
    * @ApiDoc(
    *      resource=true, section="Match",
    *      description="Get the ticket of a match",
    *      output= { "class"=Ticket::class, "collection"=false, "groups"={"base", "ticket"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "ticket"})
    * @Rest\Get("/matchs/{id}/tickets")
    */
    public function getTicketMatchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $tickets = $em->getRepository(Ticket::class)->findByMatch($request->get("id"));

        if (empty($tickets)) {
            throw $this->getTicketsNotFoundException();
        }

        return $tickets;

    }

    private function getTicketsNotFoundException() {
        return new NotFoundHttpException("No tickets found");
    }

    private function getMatchNotFoundException() {
        return new NotFoundHttpException("No match found");
    }

}
