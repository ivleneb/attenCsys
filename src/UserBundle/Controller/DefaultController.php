<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\Currentattendance;
use UserBundle\Entity\Users;
use UserBundle\Entity\Regattendance;

class DefaultController extends Controller
{
    /**
     * @Route("/registration/{uid}", name="registrationPage")
     */
    public function registrationAction($uid="Non uid enter")
    {
        $user = $this->getDoctrine()->getRepository('UserBundle:Users')->findOneBy(array('uid'=>$uid));

        if (!$user) {
        	return new Response("Not found user with uid: ".$uid);
        }else{
        	$currentAtt = $this->getDoctrine()->getRepository('UserBundle:Currentattendance')->findOneBy(array('email'=>$user->getEmail()));

        	$time = new \DateTime();

        	if (!$currentAtt) {
        		//New entry For an user Entry
        		$saludo = "@Hello@";
        		$currentAtt = new Currentattendance();
        		$currentAtt->setUsername($user->getUsername());
                $currentAtt->setName($user->getName());
                $currentAtt->setEmail($user->getEmail());
        		$currentAtt->setCurrententry($time);
        		$em=$this->getDoctrine()->getManager();
        		$em->persist($currentAtt);
        		$em->flush();

        	} elseif ($currentAtt->getCurrentdepart() == NULL) {
        		//Set depart time
        		$saludo = "@Bye@";
        		$em=$this->getDoctrine()->getManager();
        		$currentAtt->setCurrentdepart($time);
        		$em->flush();
        	}elseif ($currentAtt->getCurrentdepart() != NULL) {
        		//Reset entry time
        		$saludo = "@Hello@";
        		$em=$this->getDoctrine()->getManager();

        		$newReg = new Regattendance();
        		$newReg->setUsername($user->getUsername());
                $newReg->setName($user->getName());
                $newReg->setEmail($user->getEmail());
        		$newReg->setEntry($currentAtt->getCurrententry());
        		$newReg->setDepart($currentAtt->getCurrentdepart());

                $diff = date_diff($newReg->getDepart(), $newReg->getEntry());
                /*$diffMin = ($diff->h)*60+($diff->i); 

                $entryH = intval($newReg->getEntry()->format('%h'));
                $entryM = intval($newReg->getEntry()->format('%i'));
                $departH = intval($newReg->getDepart()->format('%h'));
                $departM = intval($newReg->getDepart()->format('%i'));*/

                $newReg->setDifference($diff->format('%h:%i')); 
                    
        		$em->persist($newReg);
        		$em->flush();

               /* if (($diffMin > 7*60+20) or ($diffMin < 3*60-5) or (($entryH*60+$entryM)>12*60 and ($entryH*60+$entryM)<14*60)) {
                    
                    $message = \Swift_Message::newInstance()
                        ->setSubject('Alert: POSSIBLE ATTENDANCE INFRACTION')
                        ->setFrom('info@waposat.com')
                        ->setTo('beenelvi.godoy@gmail.com')
                        ->setBody(
                            $this->renderView(
                            'UserBundle:Emails:alert.html.twig',
                            array('registerAlert' => $newReg)
                            ),
                            'text/html'
                        )
                        ;
                    $this->get('mailer')->send($message);                    


                    /*if ($diffMin > 7*60+20) {
                        $saludo = $saludo." mayor q 7";
                    } elseif ( $diffMin < 3*60-5) {
                        $saludo = $saludo." menor q 3";
                    } elseif (($entryH*60+$entryM)>12*60 and ($entryH*60+$entryM)<14*60) {
                        $saludo  = "aaa";
                    } */
                //}

               
        		$currentAtt->setCurrententry($time);
        		$currentAtt->setCurrentdepart(NULL);
        		$em->persist($currentAtt);
        		$em->flush();
        	}
        		
        	return new Response($saludo." user ".$user->getUsername());
        }

    }


    /**
     * @Route("/userarea/home", name="homePage")
     */
    public function home()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }

    /**
     * @Route("/userarea/register", name="registerPage")
     */
    public function registerAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT r FROM UserBundle:Regattendance r ORDER BY r.id DESC');
        $register = $query->getResult();

        return $this->render('UserBundle:Default:allregisters.html.twig',array('registers'=>$register)); 
    }


    /**
     * @Route("/userarea/current", name="currentPage")
     */
    public function currentregAction()
    {
        $current = $this->getDoctrine()->getRepository('UserBundle:Currentattendance')->findAll();

        return $this->render('UserBundle:Default:current.html.twig', array('currentReg'=>$current));
    }

    /**
     * @Route("/{type}/editcurrententry", name="editCurrent")
     */
    public function editcurrAction($type)
    {

    }

    /**
     * @Route("/{type}/editregister", name="editRegister")
     */
    public function editregisterAction($type)
    {

    }

    /**
     * @Route("/userarea/deleteregister/{id}", name="deleteRegister")
     * @Method("POST")
     */
    public function deleteRegAction($id)
    {
        $register = $this->getDoctrine()->getRepository('UserBundle:Regattendance')->findOneBy(array('id'=>$id));
        if (!$register) {
            return new Response("Not found user");
        } else {
            $em=$this->getDoctrine()->getManager();
            $em->remove($register);
            $em->flush();

            return $this->redirectToRoute('registerPage');
        }
    }

    /**
     * @Route("/userarea/deletecurrentregister/{id}", name="deleteCurrRegister")
     * @Method("POST")
     */
    public function deleteCurrAction($id)
    {
        $register = $this->getDoctrine()->getRepository('UserBundle:Currentattendance')->findOneBy(array('id'=>$id));
        if (!$register) {
            return new Response("Not found user");
        } else {
            $em=$this->getDoctrine()->getManager();
            $em->remove($register);
            $em->flush();

            return $this->redirectToRoute('currentPage');
        }
    }

}
