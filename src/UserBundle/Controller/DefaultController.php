<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
        	$currentAtt = $this->getDoctrine()->getRepository('UserBundle:Currentattendance')->findOneBy(array('uidtag'=>$user->getUid()));

        	$time = new \DateTime();

        	if (!$currentAtt) {
        		//New entry For an user Entry
        		$saludo = "Hello";
        		$currentAtt = new Currentattendance();
        		$currentAtt->setUsername($user->getUsername());
                $currentAtt->setName($user->getName());
        		$currentAtt->setUidtag($user->getUid());
        		$currentAtt->setCurrententry($time);
        		$em=$this->getDoctrine()->getManager();
        		$em->persist($currentAtt);
        		$em->flush();


        	} elseif ($currentAtt->getCurrentdepart() == NULL) {
        		//Set depart time
        		$saludo = "Bye";
        		$em=$this->getDoctrine()->getManager();
        		$currentAtt->setCurrentdepart($time);
        		$em->flush();
        	}elseif ($currentAtt->getCurrentdepart() != NULL) {
        		//Reset entry time
        		$saludo = "Hello";
        		$em=$this->getDoctrine()->getManager();

        		$newReg = new Regattendance();
        		$newReg->setUsername($currentAtt->getUsername());
                $newReg->setName($currentAtt->getName());
                $newReg->setEmail($user->getEmail());
        		$newReg->setUid($currentAtt->getUidtag());
        		$newReg->setEntry($currentAtt->getCurrententry());
        		$newReg->setDepart($currentAtt->getCurrentdepart());

        		$em->persist($newReg);
        		$em->flush();


        		$currentAtt->setCurrententry($time);
        		$currentAtt->setCurrentdepart(NULL);
        		$em->persist($currentAtt);
        		$em->flush();
        	}
        		
        	
        	return new Response($saludo." user ".$user->getUsername());
        }

    }

    /**
     * @Route("/userarea/register", name="registerPage")
     */
    public function registerAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT r FROM UserBundle:Regattendance r ORDER BY r.id DESC');
        $register = $query->getResult();
    	//$register = $this->getDoctrine()->getRepository('UserBundle:Regattendance')->findAll(array('id'=>'ASC'));
        /*if ($type=='user') {
            return $this->render('UserBundle:Default:registrationU.html.twig',array('registers'=>$register, 'type'=>$type)); 
        } elseif ($type=='admin') {
            return $this->render('UserBundle:Default:registrationA.html.twig',array('registers'=>$register, 'type'=>$type));
        } */
        return $this->render('UserBundle:Default:allregisters.html.twig',array('registers'=>$register)); 
    }


    /**
     * @Route("/userarea/current", name="currentPage")
     */
    public function currentregAction()
    {
        $current = $this->getDoctrine()->getRepository('UserBundle:Currentattendance')->findAll();
        /*if ($type=='user') {
            return $this->render('UserBundle:Default:currentU.html.twig', array('currentReg'=>$current, 'type'=>$type));
        } elseif ($type=='admin') {
            return $this->render('UserBundle:Default:currentA.html.twig', array('currentReg'=>$current, 'type'=>$type));
        }	*/
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

}
