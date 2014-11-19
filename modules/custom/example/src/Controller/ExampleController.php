<?php

namespace Drupal\example\Controller;

use Drupal\Component\Utility\String;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\user\UserInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ExampleController implements ContainerInjectionInterface {

  use StringTranslationTrait;

  /**
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $currentUser;

  public static function create(ContainerInterface $container) {
    return new self($container->get('current_user'));
  }

  public function __construct(AccountInterface $current_user) {
    $this->currentUser = $current_user;
  }

  public function content() {
    return array(
      'user' => array(
        '#markup' => $this->currentUser->getUsername(),
      ),
      'content' => array(
        '#markup' => 'Hello',
      )
    );
  }

  public function title() {
    return $this->t('Hello from title callback @name', array(
      '@name' => $this->currentUser->getUsername(),
    ));
  }

  public function titleByUser(UserInterface $user) {
    return $this->t('Hello from title callback @name', array(
      '@name' => $user->getUsername(),
    ));
  }

  public function contentByUser(UserInterface $user) {
    return array(
      'user' => array(
        '#markup' => String::checkPlain($user->getUsername()),
      ),
      'content' => array(
        '#markup' => 'Hello',
      )
    );
  }

}