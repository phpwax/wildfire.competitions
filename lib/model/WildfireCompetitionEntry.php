<?
class WildfireCompetitionEntry extends WaxModel{
  
  public function setup(){
    $this->define("name", "CharField", array('required'=>true, 'scaffold'=>true));
    $this->define("email", "CharField", array('required'=>true, 'scaffold'=>true));    
    $this->define("telephone", "CharField", array('label'=>'Telephone:'));    
    $this->define("date_of_birth", "DateTimeField", array('default'=>date("j F Y", mktime(0,0,0, date("m"), date("d"), date("Y")-30)), 'output_format'=>"j F Y", 'label'=>'Date of birth:'));
    $this->define("question", "CharField", array('scaffold'=>true));
    $this->define("answer", "CharField", array('scaffold'=>true, 'required'=>true));    
    
    $this->define("from_page", "CharField", array('scaffold'=>true));
    
    $this->define("occurred", "DateTimeField", array('scaffold'=>true,'editable'=>false));    
    $this->define("ip", "CharField", array('editable'=>false));
  }
  
  public function before_save(){
    if(!$this->ip) $this->ip = $_SERVER['REMOTE_ADDR'];
    if(!$this->occurred) $this->occurred = date("Y-m-d h:i:s");
  }
}
?>