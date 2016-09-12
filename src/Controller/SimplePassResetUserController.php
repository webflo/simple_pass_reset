<?php

namespace Drupal\simple_pass_reset\Controller;

use Drupal\user\Controller\UserController;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 */
class SimplePassResetUserController extends UserController {

  /**
   * Returns the user password reset page.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The request.
   * @param int $uid
   *   UID of user requesting reset.
   * @param int $timestamp
   *   The current timestamp.
   * @param string $hash
   *   Login link hash.
   *
   * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
   *   The form structure or a redirect response.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
   *   If the login link is for a blocked user or invalid user ID.
   */
  public function resetPass(Request $request, $uid, $timestamp, $hash) {

    if (in_array(\Drupal::routeMatch()->getRouteName(), [
      'simple_pass_reset.reset','simple_pass_reset.reset_brief'])) {
      /* @var \Drupal\user\UserInterface $user */
      $user = $this->userStorage->load($uid);
      return $this->entityFormBuilder()->getForm($user);
    }

    $origin = parent::resetPass($request, $uid, $timestamp, $hash);

    return $origin;
  }

}
