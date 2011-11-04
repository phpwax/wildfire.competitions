<?
class WildfireCompetition extends WildfireContent{
  public $table = "wildfire_content";

  public function setup(){
    parent::setup();
    $this->define("competition_title", "CharField", array('label'=>"Title (internal use)", 'group'=>"competition"));
    $this->define("competition_content", "TextField", array('label'=>"Introduction", 'group'=>"competition"));

    if(!$comp_fields = Config::get("competition/fields")){
      $comp_fields = array(
                      'multiple_choice'=>array(
                          array('name'=>'multiple_choice_question', 'type'=>'CharField', 'options'=>array('group'=>'competition', 'sub'=>'multiple_choice')),
                          array('name'=>'multiple_choice_option_a', 'type'=>'CharField', 'options'=>array('group'=>'competition', 'sub'=>'multiple_choice')),
                          array('name'=>'multiple_choice_option_b', 'type'=>'CharField', 'options'=>array('group'=>'competition', 'sub'=>'multiple_choice')),
                          array('name'=>'multiple_choice_option_c', 'type'=>'CharField', 'options'=>array('group'=>'competition', 'sub'=>'multiple_choice'))
                        ),
                        'free_text'=>array(
                          array('name'=>'free_text_question', 'type'=>'CharField', 'options'=>array('group'=>'competition', 'sub'=>'free_text')),
                        )
                      );
    }
    $types = array(''=>'-- select --');
    foreach(array_keys($comp_fields) as $name) $types[$name] = ucwords(str_replace("_", " ", $name));
    
    $this->define("competition_type", "CharField", array('widget'=>'SelectInput', 'choices'=>$types, 'group'=>"competition"));
    
    foreach($comp_fields as $type=>$config) foreach($config as $field) $this->define($field['name'], $field['type'], $field['options']);
        
  }

}
?>