<?php
/**
*Plugin Name: Simple BarCode generator
*Description: Génération de code barre
*Version: 1.0
*Author: Julia GALINDO
*Author URI: https://creanet.fr/webmaster
**/

add_action('wp_enqueue_scripts','barcode_js_init');

function barcode_js_init() {
    wp_enqueue_script( 'barcode-js', plugins_url( '/js/barcode.js', __FILE__ ));
}
add_action('widgets_init','barcode_init');

function barcode_init(){
  register_widget("barcode");
}

class barcode extends WP_widget{
  function barcode(){
    $option=array(
      "classname" => "barcode-widget",
      "description" => "Un wiget qui permet de créer des BARcode"
    );
    $this->WP_widget("widget-barcode", "barcode",$options);

  }
  function widget($args,$instance){
    extract($args);
    echo $before_widget;
    echo $before_title.$instance["titre"].$after_title;
    ?>
    <div class="container-fluid">
      <div class="text-center">
        <img src="<?php echo plugins_url( 'images/ISBN.png', __FILE__ )?>"
         class="bar-code img-thumbnail img-responsive" id="bar-code">
      </div>

      <div class="form-horizontal">
        <div class="form-group">
          <label class="control-label col-sm-2" for="contentbar"><?php echo $instance["label"]?> :</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="contentbar" placeholder="9781234567809">
          </div>
        </div>
        <div class="form-group"> 
          <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-default" id="generate-bar" onclick="generate_bar()">Générer</button>
          </div>
        </div>
      </div>
    </div>
    <?php
    echo $after_widget;
  }
  function update($new,$old){
    return $new;
  }
  function form($instance){
    $defaut=array(
      "titre" => "barcode",
      "label" => "Contenu"
    );
    $instance=wp_parse_args($instance,$defaut);
      ?>
      <p>
        <label for="<?php echo $this->get_field_id("titre"); ?>">Titre : </label>
        <input value="<?php echo $instance["titre"]?>" name="<?php echo $this->get_field_name("titre");?>" id="<?php echo $this->get_field_id("titre");?>" type="text"/>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id("label"); ?>">Label : </label>
        <input value="<?php echo $instance["label"]?>" name="<?php echo $this->get_field_name("label");?>" id="<?php echo $this->get_field_id("label");?>" type="text"/>
      </p>      <?php
  }
}
?>