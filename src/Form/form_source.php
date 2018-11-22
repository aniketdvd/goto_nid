<?php 

namespace Drupal\goto_nid\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Implements a node redirect block form.
 */

class form_source extends FormBase {

  /**
   * {@inheritdoc}
  */

   public function getFormId() {
    return 'goto_nid';
  }

  /**
   * {@inheritdoc}
  */

  public function buildForm(array $form, FormStateInterface $form_state){
    $form['inp_nid'] = [
      '#required' => TRUE,
      '#type' => 'number',
      '#title' => $this->t('Enter the Node ID'),
    ];
    $form['actions']['#type'] = 'actions';
    $form['actions']['button'] = [
      '#type' => 'submit',
      '#value' => $this->t('GO TO THE NODE'),
      '#button_type' => 'primary',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
  **/

  public function validateForm(array &$form, FormStateInterface $form_state){
    if($form_state -> getValue('inp_nid')<1){
      $form_state -> setErrorByName('inp_nid', $this->t('Sorry, invalid node. Use only numbers that are greater 1'));
    }
    if(!(is_numeric($form_state -> getValue('inp_nid')))){
      $form_state -> setErrorByName('inp_nid', $this->t('Sorry, invalid node. Use only numbers that are greater 1'));
    }
  }

  /**
   * {@inheritdoc}
  **/

  public function submitForm(array &$form, FormStateInterface $form_state){
    $nid = $form_state->getValue('inp_nid');
    $routeName = 'entity.node.canonical';
    $routeParameters = ['node' => $nid];
    $url = \Drupal::url($routeName, $routeParameters);
    $redirect=new RedirectResponse($url);
    $redirect -> send();
  }
}
