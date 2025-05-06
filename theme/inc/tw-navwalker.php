<?php
/**
 * Tailwind-compatible custom Nav Walker with submenu animation support
 */

class Tailwind_Navwalker extends Walker_Nav_Menu {
    // Start of submenu <ul>
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"ml-4 mt-2 hidden group-hover:block transition-all duration-300 ease-in-out\">\n";
    }

    // Start of a menu item
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = 'menu-item';

        $has_children = in_array('menu-item-has-children', $classes);
        if ($has_children) {
            $classes[] = 'group relative';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= "<li$class_names>";

        $atts = [
            'title'  => !empty($item->attr_title) ? $item->attr_title : '',
            'target' => !empty($item->target)     ? $item->target     : '',
            'rel'    => !empty($item->xfn)        ? $item->xfn        : '',
            'href'   => !empty($item->url)        ? $item->url        : '',
            'class'  => 'block px-4 py-2 hover:text-blue-500 transition-colors duration-200',
        ];

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= " $attr=\"$value\"";
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $output .= "<a$attributes>$title</a>";
    }

    // End of a menu item
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }

    // End of submenu <ul>
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= str_repeat("\t", $depth) . "</ul>\n";
    }
}
?>
