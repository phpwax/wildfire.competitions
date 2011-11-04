<?
class WildfireCompetitionController extends WaxController{
  
  public $entry_model_class = "WildfireCompetitionEntry";
  
  public function __competition_form(){
    $this->entry_model = new $this->entry_model_class;
    $this->comp_form = new WaxForm($this->entry_model);
    if($saved = $this->comp_form->save()){
      $this->redirect_to("/thanks/competition/");
    }
  }
 
  
}
?>