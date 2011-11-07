<?
CMSApplication::register_module("competitionentry", array("display_name"=>"Competition Entries", "link"=>"/admin/competitionentry/"));


//add in the custom model setup for the competition
WaxEvent::add("wildfire_dynamic_content.setup", function(){
  $obj = WaxEvent::data();
  $obj->define("competition_item", "BooleanField", array('group'=>"competition"));
  $obj->define("competition_content", "TextField", array('label'=>"Introduction", 'group'=>"competition"));
  $obj->define("competition_date_start", "DateTimeField", array('default'=>date("Y-m-d h:i:s"), 'output_format'=>"j F Y",'input_format'=> 'j F Y H:i', 'group'=>'competition'));
	$obj->define("competition_date_end", "DateTimeField", array('default'=>date("Y-m-d h:i:s",mktime(0,0,0, date("m"), date("j"), date("y")-10 )), 'output_format'=>"j F Y", 'input_format'=> 'j F Y H:i','group'=>'competition'));
	
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
  $obj->define("competition_type", "CharField", array('widget'=>'SelectInput', 'choices'=>$types, 'group'=>"competition"));
  
  foreach($comp_fields as $type=>$config) foreach($config as $field) $obj->define($field['name'], $field['type'], $field['options']);
  
});

?>