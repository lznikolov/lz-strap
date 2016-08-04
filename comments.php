<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Mini-Strap
 */

$commenter = wp_get_current_commenter();
$req = get_option('require_name_email');
$aria_req = ($req ? " aria-required='true'" : '');

$fields = array(
    'author' =>
        '<div class="form-group"><label for="author">' . __('Name', 'mini-strap') . '</label> ' .
        '<input id="author" name="author" type="text" class="form-control" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . ' />' .
        '</div>',

    'email' =>
        '<div class="form-group"><label for="email">' . __('Email', 'mini-strap') . '</label> ' .
        '<input id="email" name="email" type="email" class="form-control" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req . ' />' .
        '</div>',

    'url' =>
        '<div class="form-group"><label for="url">' . __('Website', 'mini-strap') . '</label>' .
        '<input id="url" name="url" type="text" class="form-control" value="' . esc_attr($commenter['comment_author_url']) . '" />' .
        '</div>'
);
$comments_args = array(
    'fields' => $fields,
    'format' => 'html5',
    'logged_in_as' => '<span id="logged_in_as" class="help-block">' .
        sprintf(
            __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'mini-strap'),
            admin_url('profile.php'),
            $user_identity,
            wp_logout_url(apply_filters('the_permalink', get_permalink()))) . '</span>',
    'class_form' => '',
    'class_submit' => 'btn btn-default',
    'comment_field' => '<div class="form-group"><label for="comment">' . _x('Comment', 'noun', 'mini-strap') . '</label>' .
        '<textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
        '</div>',
    'comment_notes_before' => '<span id="comment_notes_before" class="help-block">' .
        __('Your email address will not be published.', 'mini-strap') .
        '</span>',
    'comment_notes_after' => '<span id="comment_notes_after" class="help-block sr-only">' .
        sprintf(
            __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'mini-strap'),
            ' <code>' . allowed_tags() . '</code>'
        ) . '</span>',
    'submit_field' => '<div class="form-group">%1$s %2$s</div>'

);
if (comments_open(get_the_ID())) { ?>
    <!-- Comments form -->
    <div class="row" id="commentsContent">
        <div class="col-md-11 col-md-offset-1 col-sm-12">
            <?php comment_form($comments_args); ?>
        </div>
    </div>
<?php } else { ?>
    <!-- No Comments allowed -->
    <div class="row hidden">
        <div class="col-xs-12">
            <div class="panel panel-info">
                <div class="panel-body">
                    <h2 class="text-uppercase text-center"><?php _e('Comments are disabled', 'mini-strap'); ?></h2>
                </div>
            </div>
        </div>
    </div>
<?php }
if (get_comments_number() > 0) { ?>
    <!-- Comments -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="text-uppercase">
                <?php printf(
                    _n(
                        'One Comment',
                        '%1$d Comments',
                        get_comments_number(),
                        'mini-strap'
                    ),
                    number_format_i18n(get_comments_number())
                ); ?>
            </h2>

        </div>
    </div>
<?php }

$args = array(
    'walker' => null,
    'max_depth' => '5',
    'style' => 'ul',
    'callback' => 'format_comment',
    'end-callback' => null,
    'type' => 'all',
    'reply_text' => 'Reply',
    'page' => '',
    'per_page' => '',
    'avatar_size' => 32,
    'reverse_top_level' => null,
    'reverse_children' => '',
    'format' => 'html5', // or 'xhtml' if no 'HTML5' theme support
    'short_ping' => false,   // @since 3.6
    'echo' => true     // boolean, default is true
);
wp_list_comments($args);
function format_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment; ?>
    <div <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
        <div class="row">
            <div class="col-xs-12">
                <blockquote>
                    <?php if ($comment->comment_approved == '0') { ?>
                        <em><?php _e('Your comment is awaiting moderation.', 'mini-strap') ?></em>
                    <?php } else { ?>
                        <?php comment_text(); ?>
                        <footer>
                            <?php _e('commented on', 'mini-strap'); ?>
                            <a class="comment-permalink"
                               href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>">
                                <?php printf(_x('%1$s %2$s', 'date-time', 'mini-strap'), get_comment_date(), get_comment_time()) ?>
                            </a>
                            <?php _e('by', 'mini-strap') ?>
                            <cite
                                title="<?= get_comment_author(); ?>"><?php printf(__('%s', 'mini-strap'), get_comment_author_link()) ?></cite>
                        </footer>
                        <p>
                            <?php comment_reply_link(
                                array_merge($args, array(
                                        'reply_text' => __('Reply', 'mini-strap'),
                                        'depth' => $depth,
                                        'max_depth' => $args['max_depth'],
                                        'after' => ' <i class="fa fa-reply" aria-hidden="true"></i>'
                                    )
                                )
                            ); ?>
                        </p>
                    <?php } ?>
                </blockquote>
            </div>
        </div>
    </div>
<?php } ?>