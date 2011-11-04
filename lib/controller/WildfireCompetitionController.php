<?
class WildfireCompetitionController extends WaxController{
  
  public $entry_model = "WildfireCompetitionEntry";
  
  public function _form(){
    $this->comp_form = new WaxForm(new WildfireCompetitionEntry);
    if($saved = $this->comp_form->save()){
      $this->redirect_to("/thanks/competition/");
    }
  }
 
  
}
?>