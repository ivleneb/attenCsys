<?php 
	
	namespace UserBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
	use Symfony\Component\HttpFoundation\Response;
	use UserBundle\Entity\Currentattendance;
	use UserBundle\Entity\Users;
	use UserBundle\Entity\Regattendance;

	/**
	* 
	*/
	class MailingController extends Controller
	{

		/**
		 * @Route("/mailing/{type}", name="mailing" )
		 */
		public function sendAction ($type)
		{
			$message = \Swift_Message::newInstance()
		        ->setSubject('Hello Email')
		        ->setFrom('send@example.com')
		        ->setTo('beenelvi.godoy@gmail.com')
		        ->setBody(
		            $this->renderView(
		                'UserBundle:Emails:alert.html.twig',
		                array('type' => $type)
		            ),
		            'text/html'
		        )
		    ;

		    $this->get('mailer')->send($message);

		    return new Response('<html><body>Email '.$type.' send!</body></html>', Response::HTTP_OK);
		}
		
	}

?>