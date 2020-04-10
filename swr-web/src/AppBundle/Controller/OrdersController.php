<?php

namespace AppBundle\Controller;

use EventBundle\Entity\Event;
use EventBundle\Entity\Sponsorship;
use JMS\Payment\CoreBundle\PluginController\PluginController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\Payment\CoreBundle\Form\ChoosePaymentMethodType;
use AppBundle\Entity\Order;
use Symfony\Component\HttpFoundation\Request;

use JMS\Payment\CoreBundle\Plugin\Exception\Action\VisitUrl;
use JMS\Payment\CoreBundle\Plugin\Exception\ActionRequiredException;
use JMS\Payment\CoreBundle\PluginController\Result;
/**
 * @Route("/orders")
 */
class OrdersController extends Controller
{
    /**
     * @Route("/newS/{id}", name="CreateSpons")
     */
    public function newSAction($id,Request $request)
    {
        $x = null;

        $evt = $this->getDoctrine()->getManager()->getRepository(Event::class)->find($id);
        $still=$evt->getStillneededEvt();
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $alreadyis = 0;
        $logo=$request->files->get('url');
        $amount=$request->request->get('amount');


            if ($request->isMethod('POST') and $still>=$amount) {
                $repositoryy = $this->getDoctrine()->getManager()->getRepository(Event::class);
                $dif=$still-$amount;

                $repositoryy->updateStillEvent($id,$dif);

                $idU = $user->getId();
                $repository = $this->getDoctrine()->getManager()->getRepository(Sponsorship::class);
                $check = $repository->CheckSponsorEvent($idU, $id);
                if ($check == NULL) {
                    $em = $this->getDoctrine()->getManager();
                    $par = new Sponsorship();
                    $par->setIdEvt($id);
                    $par->setIdSponsor($idU);
                    /**
                     * @var UploadedFile $file
                     */
                    $par->setLogo($logo);
                    $file=$par->getLogo();
                    $filename= md5(uniqid()).'.'.$file->guessExtension();
                    $file->move(
                        $this->getParameter('image_directory'),$filename
                    );
                    $par->setLogo($filename);
                    $par->setGivenSponsor($amount);
                    $par->setDateSponsor(new \DateTime());
                    $em->persist($par);
                    $em->flush();


                    $repositoryy->IncNbSponsorEvent($id);
                    $order = new Order($amount);
                    $em->persist($order);
                    $em->flush();
                    $alreadyis = 1;
                  return $this->redirectToRoute('app_orders_show',array('id' => $id, 'u' => $user,'alreadyis'=>$alreadyis,'orderId'=>$order->getId(),'p'=>1));
                } else{

                    $repository = $this->getDoctrine()->getManager()->getRepository(Sponsorship::class);
                    $filename= md5(uniqid()).'.'.$logo->guessExtension();
                    $logo->move(
                        $this->getParameter('image_directory'),$filename
                    );
                    $repository->updateAmount($idU,$id,$amount,$filename);
                    $em = $this->getDoctrine()->getManager();
                    $order = new Order($amount);
                    $em->persist($order);
                    $em->flush();
                    $alreadyis = 2;
                    return $this->redirectToRoute('app_orders_show',array('id' => $id, 'u' => $user,'alreadyis'=>$alreadyis,'orderId'=>$order->getId(),'p'=>1));
                }
            }
        }
            return $this->redirectToRoute('event_singleS', array('id' => $id, 'evt' => $evt, 'u' => $user,'alreadyis'=>$alreadyis));

    }


    /**
     * @Route("/{orderId}/show")
     */
    public function showAction($orderId, Request $request, PluginController $ppc)
    {
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $idU=$user->getId();}
        $order = $this->getDoctrine()->getManager()->getRepository(Order::class)->find($orderId);

        $form = $this->createForm(ChoosePaymentMethodType::class, null, [
            'amount'   => $order->getAmount(),
            'currency' => 'USD',
            'default_method'  => 'paypal_express_checkout',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ppc->createPaymentInstruction($instruction = $form->getData());

            $order->setPaymentInstruction($instruction);

            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush($order);

            return $this->redirectToRoute('app_orders_paymentcreate', [
                'orderId' => $order->getId(),
            ]);
        }

        return $this->render('Orders/show.html.twig', [
            'order' => $order,
            'form'  => $form->createView(),'u'=>$user
        ]);
    }

    private function createPayment(Order $order, PluginController $ppc)
    {
        $instruction = $order->getPaymentInstruction();
        $pendingTransaction = $instruction->getPendingTransaction();

        if ($pendingTransaction !== null) {
            return $pendingTransaction->getPayment();
        }

        $amount = $instruction->getAmount() - $instruction->getDepositedAmount();

        return $ppc->createPayment($instruction->getId(), $amount);
    }

    /**
     * @Route("/{orderId}/payment/create")
     */
    public function paymentCreateAction($orderId, PluginController $ppc)
    {
        $order = $this->getDoctrine()->getManager()->getRepository(Order::class)->find($orderId);

        $payment = $this->createPayment($order, $ppc);

        $result = $ppc->approveAndDeposit($payment->getId(), $payment->getTargetAmount());

        if ($result->getStatus() === Result::STATUS_SUCCESS) {
            return $this->redirectToRoute('app_orders_paymentcomplete', [
                'orderId' => $order->getId(),
            ]);
        }
        if ($result->getStatus() === Result::STATUS_PENDING) {
            $ex = $result->getPluginException();

            if ($ex instanceof ActionRequiredException) {
                $action = $ex->getAction();

                if ($action instanceof VisitUrl) {
                    return $this->redirect($action->getUrl());
                }
            }
        }

        throw $result->getPluginException();


        // In a real-world application you wouldn't throw the exception. You would,
        // for example, redirect to the showAction with a flash message informing
        // the user that the payment was not successful.
    }


    /**
     * @Route("/{orderId}/payment/complete")
     */
    public function paymentCompleteAction($orderId)
    {
        return new Response('Payment complete');
    }

}
