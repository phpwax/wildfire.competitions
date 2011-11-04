jQuery(document).ready(function(){
  jQuery("div.comp_spliter").hide();
  jQuery("#wildfire_content_competition_type").change(function(){
    var val = jQuery(this).val();
    jQuery("div.comp_spliter:not(."+val+")").slideUp("fast");
    jQuery("div.comp_spliter."+val).slideDown("fast");
  });
});