<?php

/**
 * @file
 * Contains \Drupal\simple_pass_reset\Controller\SimplePassResetUserController.
 */

namespace Drupal\simple_pass_reset\Controller;

use Drupal\user\Controller\UserController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SimplePassResetUserController extends UserController {

  /**
   * Returns the user password reset page.
   *
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
  public function resetPass($uid, $timestamp, $hash) {
    $origin = parent::resetPass($uid, $timestamp, $hash);
    if ($origin instanceof RedirectResponse) {
      return $origin;
    }

    /* @var \Drupal\user\UserInterface $user */
    $user = $this->userStorage->load($uid);
    return $this->entityFormBuilder()->getForm($user);
  }

}
