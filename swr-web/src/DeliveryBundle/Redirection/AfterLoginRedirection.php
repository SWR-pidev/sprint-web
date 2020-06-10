<?php


namespace DeliveryBundle\Redirection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    private $router;

    /*
    * AfterLoginRedirection constructor.
    *
    * @param RouterInterface $router
    */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /*
    * @param Request        $request
    *
    * @param TokenInterface $token
    *
    * @return RedirectResponse
    */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $redirection = new RedirectResponse($this->router->generate('Goods_lister'));
        $roles = $token->getRoles();

        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);

        if (in_array('ROLE_ADMIN', $rolesTab, true)) {

            $redirection = new RedirectResponse($this->router->generate('Delivery_homepage'));
        }
        if (in_array('ROLE_USER', $rolesTab, true)) {

            $redirection = new RedirectResponse($this->router->generate('Goods_lister'));
        }

        return $redirection;
    }

}