<?php

// Id
$settings['id'] = substr(uniqid(), -3);

// Grid
$grid  = 'uk-child-width-1-'.$settings['columns'];
$grid .= $settings['columns_small'] ? '  uk-child-width-1-'.$settings['columns_small'].'@s': '';
$grid .= $settings['columns_medium'] ? '  uk-child-width-1-'.$settings['columns_medium'].'@m' : '';
$grid .= $settings['columns_large'] ? '  uk-child-width-1-'.$settings['columns_large'].'@l' : '';
$grid .= $settings['columns_xlarge'] ? ' uk-child-width-1-'.$settings['columns_xlarge'].'@xl' : '';

if ($settings['grid'] == 'dynamic') {

    // Filter Tags
    $tags = array();

    if (isset($settings['filter_tags']) && is_array($settings['filter_tags'])) {
        $tags = $settings['filter_tags'];
    }

    if(!count($tags)){
        foreach ($items as $i => $item) {
            if ($item['tags']) {
                $tags = array_merge($tags, $item['tags']);
            }
        }
        $tags = array_unique($tags);

        natsort($tags);
        $tags = array_values($tags);
    }

    // Filter Nav
    $tabs_center = '';
    if ($settings['filter'] == 'tabs') {

        $filter  = '{wk}-tab';
        $filter .= ($settings['filter_align'] == 'right') ? ' {wk}-tab-flip' : '';
        $filter .= ($settings['filter_align'] != 'center') ? ' {wk}-margin' : '';
        $tabs_center  = ($settings['filter_align'] == 'center') ? '{wk}-tab-center {wk}-margin' : '';

    } elseif ($settings['filter'] != 'none') {

        switch ($settings['filter']) {
            case 'text':
                $filter = '{wk}-subnav';
                break;
            case 'lines':
                $filter = '{wk}-subnav {wk}-subnav-line';
                break;
            case 'nav':
                $filter = '{wk}-subnav {wk}-subnav-pill';
                break;
        }

        $filter .= ' {wk}-flex-' . $settings['filter_align'];
    }

    // JS Options
    $options   = array();
    $options[] = ($settings['gutter_dynamic']) ? 'gutter: \'' . $settings['gutter_v_dynamic'] . ' ' . $settings['gutter_dynamic'] . '\'' : '';
    $options[] = ($settings['filter'] != 'none') ? 'controls: \'#wk-' . $settings['id'] . '\'' : '';
    $options[] = (count($tags) && $settings['filter'] != 'none' && !$settings['filter_all']) ? 'filter: \'' . $tags[0] . '\'': '';
    $options   = implode(',', array_filter($options));

    $grid_js   = $options ? 'data-{wk}-grid="{' . $options . '}"' : 'data-{wk}-grid';

} else {
    $grid .= ' uk-grid-match';
    $grid .= in_array($settings['gutter'], array('collapse','large','medium','small')) ? ' uk-grid-'.$settings['gutter'] : '' ;

    $grid_js = ' uk-grid';

    if ($settings['parallax']) {
        $grid_js .= '="parallax: ' . ($settings['parallax_translate'] ? intval($settings['parallax_translate']) . '"' : '0px');
    }
}

// card
$card     = 'uk-card';
$card_alt = '';
switch ($settings['card']) {
    case 'blank' :
        $card .= '';

        break;
    case 'default' :
        $card .= ' uk-card-default';
        break;
    case 'primary' :
        $card .= ' uk-card-primary';
        break;
    case 'secondary' :
        $card .= ' uk-card-secondary';
        break;
    case 'sequence1' :
        $card .= '';
        $card_alt .= 'uk-card-primary';
        break;
    case 'sequence2' :
        $card .= ' ';
        $card_alt .= 'uk-card uk-card-secondary';
        break;
    case 'sequence3' :
        $card .= ' uk-card-primary';
        $card_alt .= 'uk-card uk-card-secondary';
        break;
    case 'sequence4' :
        $card .= ' uk-card-secondary';
        $card_alt .= 'uk-card uk-card-primary';
        break;
}

// card Sequence
$card = array(
    $card,
    $card_alt ? $card_alt : $card
);

// Card Size
if(in_array($settings['card_size'], array('small', 'large'))){
    $card_size = ' uk-card-'.$settings['card_size']; 
}else{
    $card_size = '';
}

// Muss ich noch checken                                                                                                            +++++++++++++++++++++++++++++++++++++
// Media Width
$media_width = 'uk-width-' . $settings['media_breakpoint'] . '-' . $settings['media_width'];

switch ($settings['media_width']) {
    case '1-5':
        $content_width = '4-5';
        break;
    case '1-4':
        $content_width = '3-4';
        break;
    case '3-10':
        $content_width = '7-10';
        break;
    case '1-3':
        $content_width = '2-3';
        break;
    case '2-5':
        $content_width = '3-5';
        break;
    case '1-2':
        $content_width = '1-2';
        break;
}

$content_width = '{wk}-width-' . $settings['media_breakpoint'] . '-' . $content_width;

// Content Align
$content_align  = $settings['content_align'] ? '{wk}-flex-middle' : '';

// Title Size
switch ($settings['title_size']) {
    case 'card':
        $title_size = '{wk}-card-title';
        break;
    case 'large':
        $title_size = '{wk}-heading-large {wk}-margin-top-remove';
        break;
    default:
        $title_size = '{wk}-' . $settings['title_size'] . ' {wk}-margin-top-remove';
}

// Link Style
switch ($settings['link_style']) {
    case 'button':
        $link_style = 'uk-button uk-button-default';
        break;
    case 'primary':
        $link_style = 'uk-button uk-button-primary';
        break;
    case 'secondary':
        $link_style = 'uk-button uk-button-secondary';
        break;
    case 'danger':
        $link_style = 'uk-button uk-button-danger';
        break;
    case 'button-link':
        $link_style = 'uk-button uk-button-link';
        break;
    case 'text':
    default:
        $link_style = 'uk-button uk-button-text';
}

switch ($settings['button_size']) {
    case 'small':
        $button_size = ' uk-button-small';
        break;
    case 'large':
        $button_size = ' uk-button-large';
        break;
    case 'default':
    default:
        $button_size = '';
}

// Badge Style
switch ($settings['badge_style']) {
    case 'badge':
        $badge_style = '{wk}-badge';
        break;
    case 'success':
        $badge_style = '{wk}-badge {wk}-badge-success';
        break;
    case 'warning':
        $badge_style = '{wk}-badge {wk}-badge-warning';
        break;
    case 'danger':
        $badge_style = '{wk}-badge {wk}-badge-danger';
        break;
    case 'text-muted':
        $badge_style  = '{wk}-text-muted';
        $badge_style .= ($settings['badge_position'] == 'card') ? ' {wk}-card-badge' : '';
        break;
    case 'text-primary':
        $badge_style  = '{wk}-text-primary';
        $badge_style .= ($settings['badge_position'] == 'card') ? ' {wk}-card-badge' : '';
        break;
}

// Media Border
$border = ($settings['media_border'] != 'none') ? '{wk}-border-' . $settings['media_border'] : '';

// Animation
$animation = ($settings['animation'] != 'none') ? ' data-{wk}-scrollspy="{cls:\'{wk}-animation-' . $settings['animation'] . ' {wk}-invisible\', target:\'> div > .{wk}-card\', delay:300}"' : '';

// Link Target
$link_target = ($settings['link_target']) ? ' target="_blank"' : '';

?>

<?php if (isset($tags) && $tags && $settings['filter'] != 'none') : ?>

    <?php if ($tabs_center) : ?>
    <div class="<?php echo $tabs_center; ?>">
    <?php endif ?>

    <ul id="wk-<?php echo $settings['id']; ?>" class="<?php echo $filter; ?>"<?php if ($settings['filter'] == 'tabs') echo ' data-{wk}-tab'?>>

        <?php if ($settings['filter_all']) : ?>
        <li class="{wk}-active" data-{wk}-filter=""><a href="#"><?php echo $app['translator']->trans('All'); ?></a></li>
        <?php endif ?>

        <?php foreach ($tags as $i => $tag) : ?>
        <li data-{wk}-filter="<?php echo $tag; ?>"><a href="#"><?php echo ucwords($tag); ?></a></li>
        <?php endforeach; ?>

    </ul>

    <?php if ($tabs_center) : ?>
    </div>
    <?php endif ?>

<?php endif; ?>

<div id="wk-grid<?php echo $settings['id']; ?>" class="<?php echo $grid; ?> {wk}-text-<?php echo $settings['text_align']; ?> <?php echo $settings['class']; ?>" <?php echo $grid_js ?> <?php echo $animation; ?>>

<?php foreach ($items as $i => $item) :

        // Social Buttons
        $socials = '';
        if ($settings['social_buttons']) {
            $socials .= $item['twitter'] ? '<div><a class="{wk}-icon-button {wk}-icon-twitter" href="'. $item->escape('twitter') .'"></a></div>': '';
            $socials .= $item['facebook'] ? '<div><a class="{wk}-icon-button {wk}-icon-facebook" href="'. $item->escape('facebook') .'"></a></div>': '';
            $socials .= $item['google-plus'] ? '<div><a class="{wk}-icon-button {wk}-icon-google-plus" href="'. $item->escape('google-plus') .'"></a></div>': '';
            $socials .= $item['email'] ? '<div><a class="{wk}-icon-button {wk}-icon-envelope-o" href="mailto:'. $item->escape('email') .'"></a></div>': '';
        }

        // Second Image as Overlay
        $media2 = '';
        if ($settings['media_overlay'] == 'image') {
            foreach ($item as $field) {
                if ($field != 'media' && $item->type($field) == 'image') {
                    $media2 = $field;
                    break;
                }
            }
        }

        // Media Type
        $attrs  = array('class' => '');
        $width  = $item['media.width'];
        $height = $item['media.height'];

        if ($item->type('media') == 'image') {
            $attrs['alt'] = strip_tags($item['title']);

            $attrs['class'] .= ($border) ? $border : '';
            $attrs['class'] .= ($settings['media_animation'] != 'none' && !$media2) ? ' {wk}-overlay-' . $settings['media_animation'] : '';

            $width  = ($settings['image_width'] != 'auto') ? $settings['image_width'] : '';
            $height = ($settings['image_height'] != 'auto') ? $settings['image_height'] : '';
        }

        if ($item->type('media') == 'video') {
            $attrs['class'] = '{wk}-responsive-width';
            $attrs['controls'] = true;
        }

        if ($item->type('media') == 'iframe') {
            $attrs['class'] = '{wk}-responsive-width';
        }

        $attrs['width']  = ($width) ? $width : '';
        $attrs['height'] = ($height) ? $height : '';

        if (($item->type('media') == 'image') && ($settings['image_width'] != 'auto' || $settings['image_height'] != 'auto')) {
            $media = $item->thumbnail('media', $width, $height, $attrs);
        } else {
            if(($item->type('media') == 'image') && $settings['gutter_dynamic']){

                // adding the size of the original image to the attributes, so that on load the canvas can be created ( see script at the end of the file ).
                if ($img  = $app['image']->create($item->get('media'))) {
                    $size = getimagesize($img->getPathName());
                    $width  = $size[0];
                    $height = $size[1];
                    $attrs['width'] = $width;
                    $attrs['height'] = $height;
                }
            }
            $media = $item->media('media', $attrs);
        }

        // Second Image as Overlay
        if ($media2) {

            $attrs['class'] .= ' {wk}-overlay-card {wk}-overlay-image';
            $attrs['class'] .= ($settings['media_animation'] != 'none') ? ' {wk}-overlay-' . $settings['media_animation'] : '';

            $media2 = $item->thumbnail($media2, $width, $height, $attrs);
        }

        // Link and Overlay
        $overlay       = '';
        $overlay_hover = '';
        $card_hover   = '';

        if ($item['link']) {

            if ($settings['card_link']) {

                $card_hover .= ($settings['card'] == 'box') ? ' {wk}-card-box-hover' : '';
                $card_hover .= ($settings['card'] == 'primary') ? ' {wk}-card-box-primary-hover' : '';
                $card_hover .= ($settings['card'] == 'secondary') ? ' {wk}-card-box-secondary-hover' : '';

                if ($settings['card'] == 'sequence1') {
                    $card_hover .= !($i % 2)  ? ' {wk}-card-box-hover' : ' {wk}-card-box-primary-hover';
                }
                if ($settings['card'] == 'sequence2') {
                    $card_hover .= !($i % 2)  ? ' {wk}-card-box-hover' : ' {wk}-card-box-secondary-hover';
                }
                if ($settings['card'] == 'sequence3') {
                    $card_hover .= !($i % 2)  ? ' {wk}-card-box-primary-hover' : ' {wk}-card-box-secondary-hover';
                }

                if (($settings['media_overlay'] == 'icon') ||
                    ($media2) ||
                    ($socials && $settings['media_overlay'] == 'social-buttons') ||
                    ($item['media'] && $settings['media'] && $settings['media_animation'] != 'none')) {
                    $card_hover .= ' {wk}-overlay-hover';
                }

            } elseif ($settings['media_overlay'] == 'link' || $settings['media_overlay'] == 'icon' || $settings['media_overlay'] == 'image') {
                $overlay = '<a class="{wk}-position-cover" href="' . $item->escape('link') . '"' . $link_target . '></a>';
                $overlay_hover = ' {wk}-overlay-hover';
            }

            if ($settings['media_overlay'] == 'icon') {
                $overlay = '<div class="{wk}-overlay-card {wk}-overlay-background {wk}-overlay-icon {wk}-overlay-' . $settings['overlay_animation'] . '"></div>' . $overlay;
            }

            if ($media2) {
                $overlay = $media2 . $overlay;
            }

        }

        if ($socials && $settings['media_overlay'] == 'social-buttons') {

            $overlay  = '<div class="{wk}-overlay-card {wk}-overlay-background {wk}-overlay-' . $settings['overlay_animation'] . ' {wk}-flex {wk}-flex-center {wk}-flex-middle {wk}-text-center"><div>';
            $overlay .= '<div class="{wk}-grid {wk}-grid-small" data-{wk}-grid-margin>' . $socials . '</div>';
            $overlay .= '</div></div>';

            $overlay_hover = !$settings['card_link'] ? ' {wk}-overlay-hover' : '';
        }

        if ($overlay || ($settings['card_link'] && $settings['media_animation'] != 'none')) {
            $media  = '<div class="{wk}-overlay' . $overlay_hover . ' ' . $border . '">' . $media . $overlay . '</div>';
        }

        // Filter
        $filter = '';
        if ($item['tags'] && $settings['grid'] == 'dynamic' && $settings['filter'] != 'none') {
            $filter = ' data-{wk}-filter="' . implode(',', $item['tags']) . '"';
        }

        // Meta
        $meta = '';
        if ($item['date']) {
            $date = '<time datetime="'.$item['date'].'">'.$app['date']->format($item['date'], $settings['date_format']).'</time>';
            if ($item['author']) {
                $meta = $app['translator']->trans('Written by %author% on %date%',  array('%author%' => $item['author'], '%date%' => $date));
            } else {
                $meta = $app['translator']->trans('Written on %date%',  array('%date%' => $date));
            }
        } elseif ($item['author']) {
            $meta = $app['translator']->trans('Written by %author%',  array('%author%' => $item['author']));
        }

        if ($item['categories']) {

            $categories = array();
            foreach ($item['categories'] as $category => $url) {
                $categories[] = '<a href="'.$url.'">'.$category.'</a>';
            }
            $categories = implode(', ', array_filter($categories));

            $meta .= ($meta) ? '. ' : '';
            $meta .= $app['translator']->trans('Posted in %categories%',  array('%categories%' => $categories));

        }

        // Date
        $nxdate = '';
        if($item['startdate']){
            $nxdate = '<time datetime="'.$item['startdate'].'">'.$app['date']->format($item['startdate'], $settings['date_format']).'</time>';
            if($item['enddate']){
                $nxdate .= ' bis ';
                $nxdate .= '<time datetime="'.$item['enddate'].'">'.$app['date']->format($item['enddate'], $settings['date_format']).'</time>';
            }
        }

        // card Title last
        if ($settings['title_size'] == 'card' &&
            !($meta) &&
            !($item['media'] && $settings['media'] && $settings['media_align'] == 'bottom') &&
            !($item['content'] && $settings['content']) &&
            !($socials && ($settings['media_overlay'] != 'social-buttons')) &&
            !($item['link'] && $settings['link'])) {
                $title_size .= ' {wk}-margin-bottom-remove';
        }

        // Truncate content
        if($settings['content_truncate'] && (strlen($item['content']) > $settings['content_truncate_size'])){
            $content = preg_replace('/\s+?(\S+)?$/', '', substr($item['content'], 0, $settings['content_truncate_size']));
            ($settings['content_truncate_end']) ? $content .= $settings['content_truncate_end_str'] : '';
        }else{
            $content = $item['content'];
        }

    ?>

    <div<?php echo $filter; ?>>
        <div class="<?php echo $card[$i % 2]; ?><?php echo $card_size; ?><?php echo $card_hover; ?><?php if ($settings['animation'] != 'none') echo ' {wk}-invisible'; ?>">

            <?php if ($item['link'] && $settings['card_link']) : ?>
            <a class="{wk}-position-cover {wk}-position-z-index" href="<?php echo $item->escape('link'); ?>"<?php echo $link_target; ?>></a>
            <?php endif; ?>

            <?php if ($item['badge'] && $settings['badge'] && $settings['badge_position'] == 'card') : ?>
            <div class="{wk}-card-badge <?php echo $badge_style; ?>"><?php echo $item['badge']; ?></div>
            <?php endif; ?>

            <?php if ($item['media'] && $settings['media'] && in_array($settings['media_align'], array('teaser', 'top'))) : ?>
            <div class="{wk}-text-center <?php echo (($settings['media_align'] == 'teaser') ? '{wk}-card-teaser' : '{wk}-margin {wk}-margin-top-remove'); ?>"><?php echo $media; ?></div>
            <?php endif; ?>

            <?php if ($item['media'] && $settings['media'] && in_array($settings['media_align'], array('left', 'right'))) : ?>
            <div class="{wk}-grid <?php echo $content_align; ?>" data-{wk}-grid-margin>
                <div class="<?php echo $media_width ?><?php if ($settings['media_align'] == 'right') echo ' {wk}-float-right {wk}-flex-order-last-' . $settings['media_breakpoint'] ?>">
                    <?php echo $media; ?>
                </div>
                <div class="<?php echo $content_width ?>">
                    <div class="{wk}-card">
            <?php endif; ?>

                        <div class="uk-card-body">

                            <?php if ($item['title'] && $settings['title']) : ?>
                            <h3 class="<?php echo $title_size; ?>">

                                <?php if ($item['link']) : ?>
                                    <a class="{wk}-link-reset" href="<?php echo $item->escape('link'); ?>"<?php echo $link_target; ?>><?php echo $item['title']; ?></a>
                                <?php else : ?>
                                    <?php echo $item['title']; ?>
                                <?php endif; ?>

                                <?php if ($item['badge'] && $settings['badge'] && $settings['badge_position'] == 'title') : ?>
                                <span class="{wk}-margin-small-left <?php echo $badge_style; ?>"><?php echo $item['badge']; ?></span>
                                <?php endif; ?>

                            </h3>
                            <?php endif; ?>

                            <?php if ($meta) : ?>
                            <p class="{wk}-article-meta"><?php echo $meta; ?></p>
                            <?php endif; ?>

                            <?php if ($nxdate) : ?>
                            <p class="uk-text-small"><span class="calendarIcon" uk-icon="icon: calendar; ratio:0.8" class="uk-display-inline-block" style="margin-top:-40px;"></span><?php echo $nxdate; ?></p>
                            <?php endif; ?>

                            <?php if ($item['media'] && $settings['media'] && $settings['media_align'] == 'bottom') : ?>
                            <div class="{wk}-margin {wk}-text-center"><?php echo $media; ?></div>
                            <?php endif; ?>

                            <?php if ($item['content'] && $settings['content']) : ?>
                            <div class="uk-margin"><?php echo $content; ?></div>
                            <?php endif; ?>

                            <?php if ($socials && ($settings['media_overlay'] != 'social-buttons')) : ?>
                            <div class="{wk}-grid {wk}-grid-small {wk}-flex-<?php echo $settings['text_align']; ?>" data-{wk}-grid-margin><?php echo $socials; ?></div>
                            <?php endif; ?>

                            <?php if ($item['link'] && $settings['link']) : ?>
                            <p><a<?php if($link_style) echo ' class="' . $link_style . $button_size .'"'; ?> href="<?php echo $item->escape('link'); ?>"<?php echo $link_target; ?>><?php echo $app['translator']->trans($settings['link_text']); ?></a></p>
                            <?php endif; ?>
                        </div>
            <?php if ($item['media'] && $settings['media'] && in_array($settings['media_align'], array('left', 'right'))) : ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>

<?php endforeach; ?>

</div>

<script>
(function($){

    // get the images of the gallery and replace it by a canvas of the same size to fix the problem with overlapping images on load.
    $('img[width][height]:not(.{wk}-overlay-card)', $('#wk-grid<?php echo $settings['id']; ?>')).each(function() {

        var $img = $(this);

        if (this.width == 'auto' || this.height == 'auto' || !$img.is(':visible')) {
            return;
        }

        var $canvas = $('<canvas class="{wk}-responsive-width"></canvas>').attr({width:$img.attr('width'), height:$img.attr('height')}),
            img = new Image,
            release = function() {
                $canvas.remove();
                $img.css('display', '');
                release = function(){};
            };

        $img.css('display', 'none').after($canvas);

        $(img).on('load', function(){ release(); });
        setTimeout(function(){ release(); }, 1000);

        img.src = this.src;

    });

})(jQuery);
</script>
