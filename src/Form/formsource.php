<?php 
  namespace Drupal\goto_nid\Form;
?>
<style>
.topr{
    font-size: 25px;
    padding-left: 20px;
    padding-right: 20px;
    background: #00598E;
    color: #ffffff;
    text-align: right;
    width: 250px;
    margin-left: -20px; 
    border-top-left-radius: 5pt;
    border-top-right-radius: 5pt;
}
.container-body{
    font-size: 18px;
    padding-left: 20px;
    padding-right: 20px;
    background: #0077C0;
    color: #ffffff;
    width: 250px;
    float: left;
    border-radius: 5pt;
}
.container-body input[type=submit]{
    font-weight: 700;
    font-size: 12px;
    color: white;
    background-color: #00598E;
    padding: 18px;
    width: 200px;
    border: 2px solid white; 
    border-radius: 40pt;
    text-align: center;

}
.container-body input{
    font-weight: 700;
    font-size: 26px;
    color: #00598E;
    display: block;
    background: #ffffff;
    padding: 8px;
    width:100%;
    border: 2px solid #00598E;
    border-radius: 40pt;
    text-align: center;
}
</style>

<?php

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Implements a node redirect block form.
 */

class formsource extends FormBase {

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
      '#prefix' => '<div class="container-body"><div class="topr">GOTO Node ID</div>',
      '#required' => TRUE,
      '#type' => 'number',
      '#title' => $this->t('Enter the Node ID'),
    ];
    $form['actions']['#type'] = 'actions';
    $form['actions']['button'] = [
      '#type' => 'submit',
      '#value' => $this->t('GO TO THE NODE'),
      '#button_type' => 'primary',
      '#suffix' => '</div>'
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
