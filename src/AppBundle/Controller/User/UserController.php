<?php

namespace AppBundle\Controller\User;

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
use AppBundle\Entity\Axe;
use AppBundle\Entity\Cookie;
use AppBundle\Entity\User;

// Form
use AppBundle\Form\Type\User\UserType;

class UserController extends ControllerBase {

    /**
    * @ApiDoc(
    *      resource=true, section="User",
    *      description="Get the Users",
    *      output= { "class"=User::class, "collection"=false, "groups"={"base", "user"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "user"})
    * @Rest\Get("/users")
    */
    public function getUsersAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository(User::class)->findAll();

        if (empty($users)) {
            throw $this->getUserNotFoundException();
        }


        return $users;
    }

    /**
    * @ApiDoc(
    *      resource=true, section="User",
    *      description="Get user by id",
    *      output= { "class"=User::class, "collection"=false, "groups"={"base", "user"} }
    * )
    *
    * @Rest\View(serializerGroups={"base", "user"})
    * @Rest\Get("/users/{id}")
    */
    public function getUserByIdAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository(User::class)->find($request->get("id"));

        if (empty($user)) {
            throw $this->getUserNotFoundException();
        }

        return $user;
    }

    /**
    * @ApiDoc(
    *      resource=true, section="User",
    *      description="Create new user",
    *      input={"class"=User::class, "name"=""},
    *      statusCodes = {
    *          201 = "Created",
    *          400 = "Bad Request"
    *      },
    *      responseMap={
    *          201 = { "class"=User::class, "groups"={"base", "user"}},
    *          400 = { "class"=User::class, "fos_rest_form_errors"=false, "name" = ""}
    *      }
    * )
    *
    * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"base", "user"})
    * @Rest\Post("/users/create")
    */
    public function postCreateUserAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $data = $request->request->all();

        if(empty($data) || !isset($data['cookie']) || !isset($data['cookie']['name']) || empty($data['cookie']['name'])) {
            throw new \Exception('Cookie name is empty !');
        }

        $user = new User();
        $user->setFirstname('user_' . $data['cookie']['name']);

        $cookie = new Cookie();
        $cookie->setName($data['cookie']['name']);
        $user->setCookie($cookie);

        $axe = new Axe();
        $axe->setUser($user);
        $em->persist($axe);
        
        $user->setAxe($axe);
        $em->persist($user);
        $em->flush();

        /*$form = $this->createForm(UserType::class, $user);

        $form->submit($request->headers);


        if ($form->isValid()) {



        } else {
            return $form;
        }*/

        return $user;
    }

    private function getUserNotFoundException() {
        return new NotFoundHttpException("No users found");
    }

}
