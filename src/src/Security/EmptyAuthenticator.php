<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class EmptyAuthenticator extends AbstractAuthenticator {
  use TargetPathTrait;
  private UrlGeneratorInterface $urlGenerator;

  public function __construct(UrlGeneratorInterface $urlGenerator)
  {
    $this->urlGenerator = $urlGenerator;
  }


  public function supports( Request $request )
  : ?bool {
    // TODO: Implement supports() method.
    return $request->attributes->get( '_route' ) === 'app_login'
           && $request->isMethod( 'POST' );
  }

  public function authenticate( Request $request )
  : Passport {
    // TODO: Implement authenticate() method.


    $email    = $request->request->get( 'email' );
    $password = $request->request->get( 'password' );
    $csrf = $request->request->get('csrf');

    return new Passport(
        new UserBadge( $email ),
        new PasswordCredentials( $password ),
        [
          new CsrfTokenBadge('login_form', $csrf)
        ]
    );
  }
//testt
  public function onAuthenticationSuccess( Request $request, TokenInterface $token, string $firewallName )
  : ?Response {
    // TODO: Implement onAuthenticationSuccess() method.
    if ( $targetPath = $this->getTargetPath( $request->getSession(), $firewallName ) ) {
      return new RedirectResponse( $targetPath );
    }

    return new RedirectResponse( $this->urlGenerator->generate( 'app_home' ) );
  }

  public function onAuthenticationFailure( Request $request, AuthenticationException $exception )
  : ?Response {
    // TODO: Implement onAuthenticationFailure() method.
    dd( $request );
  }

//    public function start(Request $request, AuthenticationException $authException = null): Response
//    {
//        /*
//         * If you would like this class to control what happens when an anonymous user accesses a
//         * protected page (e.g. redirect to /login), uncomment this method and make this class
//         * implement Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface.
//         *
//         * For more details, see https://symfony.com/doc/current/security/experimental_authenticators.html#configuring-the-authentication-entry-point
//         */
//    }
}
