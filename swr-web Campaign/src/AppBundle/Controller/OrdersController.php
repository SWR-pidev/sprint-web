<?php

namespace AppBundle\Controller;

use CompaignBundle\Entity\Compaign;
use CompaignBundle\Entity\Donation;
use JMS\Payment\CoreBundle\PluginController\PluginController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use JMS\Payment\CoreBundle\Form\ChoosePaymentMethodType;
use AppBundle\Entity\Order;
use Symfony\Component\HttpFoundation\Request;

use JMS\Payment\CoreBundle\Plugin\Exception\Action\VisitUrl;
use JMS\Payment\CoreBundle\Plugin\Exception\ActionRequiredException;
use JMS\Payment\CoreBundle\PluginController\Result;
/**
 * @Route("/orders")
 */
class OrdersController extends AbstractController
{
    /**
     * @Route("/new/{idc}", name="CreateDon")
     */
    public function newAction($idc,Request $request)
    {
        $x=null;
        $repository=$this->getDoctrine()->getManager()->getRepository(Compaign::class);
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $idU=$user->getId();
            $x=$user;
            if ($request->isMethod('POST')) {
                $WeCanDonate=$repository->WeCanDonate($idc,$request->request->get('given'));
                if ( $WeCanDonate!=0)
                {
                    $ano=0;
                    $mon=0;
                    $fun=0;
                    $given=$request->request->get('given');
                    if ( $request->request->get('anno')=="on"){$ano=1;}
                    if ( $request->request->get('mon')=="on"){$mon=1;}
                    if ($request->request->get('funds')=="on"){$fun=1;}
                    $repository->IncrementNbDon($idc);
                    $repository->UpdateStillNeeded($idc,$given);
                    $repository->UpdateRaised($idc,$given);
                    $don=new Donation();
                    $don->setIdUser($idU);
                    $don->setIdCmp($idc);
                    $don->setAnnonym($ano);
                    $don->setMonthly($mon);
                    $don->setFunds($fun);
                    $don->setMessage($request->request->get('desc'));
                    $don->setGiven($given);
                    $don->setDated(new \DateTime());
                    $time = new \DateTime();
                    $time->format('H:i:s \O\n Y-m-d');
                    $don->setTimed($time);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($don);
                    $em->flush();
                    $em = $this->getDoctrine()->getManager();
                    $order = new Order($given);
                    $em->persist($order);
                    $em->flush();
                }
            }
            return $this->redirectToRoute('app_orders_show', [
                'orderId' => $order->getId(),
                'u'=>$x
            ]);
        }


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
