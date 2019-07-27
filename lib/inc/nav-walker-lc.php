<?php
/**
 * Created by PhpStorm.
 * User: Md Nayeem
 * Date: 6/16/2019
 * Time: 2:50 AM
 */

class nav_walker_lc extends  Walker_Nav_Menu{

    function start_lvl(&$output, $depth = 0, $args = array())
    {
       // $indent = str_repeat('\t', $depth);
        $submenu = ($depth == 0 || $depth > 0 ) ? ' lc-submenu' : '';

        $output .="\n<ul class =\"$submenu deft_$depth\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
       // / parent::start_el($output, $item, $depth, $args, $id); // TODO: Change the autogenerated stub

        $indent = ($depth) ? str_repeat("\t", $depth): '';

        $li_attributes = '';

        $class_names = $value = '';

        $class = empty($item->classes) ? array() :(array) $item->classes;

        $class[] = ($args->walker->has_children) ? 'dropdown' : '';
        $class[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
        $class[] = 'menu-item-'.$item->ID;

        if($depth && $args->has_children){
            $class[] = 'dropdown-submenu';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($class), $item, $args));

        $class_names = 'class="nav-item '.esc_attr($class_names).'"';

        $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);

        $id = strlen($id) ? 'id="'.esc_attr($id).'"' : "";

        $output .= $indent.'<li '.$id.$value.$class_names.$li_attributes.'>';

        $attributes = !empty($item->attr_title) ? 'title="'.esc_attr($item->attr_title).'"': '';
        $attributes .= !empty($item->target) ? 'target="'.esc_attr($item->target).'"': '';
        $attributes .= !empty($item->xfn) ? 'rel="'.esc_attr($item->xfn).'"': '';
        $attributes .= !empty($item->url) ? 'href="'.esc_attr($item->url).'"': '';
        $attributes .= !empty($item->url) ? 'class="nav-link"': '';
        $item_output= $args->before;
        $item_output .= '<a '.$attributes.'>';
        $item_output .= $args->link_before.apply_filters('the_title', $item->title, $item->ID).$args->link_after;
        $item_output .= ($depth = 0 && $args->has_children) ? '<i class="icon-expand_more"></i></a>': '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $depth, $args);

    }

}