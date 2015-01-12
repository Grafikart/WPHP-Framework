<?php
class WPHP_Widget extends WP_Widget{

    public $name = 'Widget Name';
    public $description = 'Widget description';
    public $fields = array(
        'title'    => 'Title'
    );

    public function __construct() {
        parent::__construct(strtolower(get_class($this)), $this->name, array('description' => $this->description));
    }

    public function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    public function widget( $args, $instance ) {
        extract($args);
        echo $before_widget;
        if ( ! empty( $instance['title'] ) )
            echo $before_title . $instance['title'] . $after_title;
        echo $this->render($instance);
        echo $after_widget;
    }

    /**
     * Display the widget editor
     */
    public function form( $instance ) {
        foreach($this->fields as $id => $field){
            if(is_array($field)){
                $label = $field['label'];
                $value = isset($instance[$id]) ? $instance[$id] : $field['default'];
            }else{
                $label = $field;
                $value = isset($instance[$id]) ? $instance[$id] : '';
            }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( $id ); ?>"><?php echo $label; ?></label>
            <?php if(!isset($field['type'])): ?>
                <input class="widefat" id="<?php echo $this->get_field_id( $id ); ?>" name="<?php echo $this->get_field_name( $id ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
            <?php elseif($field['type'] == 'textarea'): ?>
                <textarea class="widefat" id="<?php echo $this->get_field_id( $id ); ?>" name="<?php echo $this->get_field_name( $id ); ?>" rows="16" cols="20"><?php echo esc_attr( $value ); ?></textarea>
            <?php endif; ?>
        </p>
        <?php
        }
    }

    /**
     * Allow rendering of the widget
     * @param  array $instance
     */
    public function render($instance){

    }

}