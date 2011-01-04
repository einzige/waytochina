<?php defined('SYSPATH') or die('No direct access allowed.');

class HTML extends Kohana_HTML {


    public static function anchor($uri, $title = NULL, array $attributes = NULL, $protocol = NULL)
    {
        if ($title === NULL)
        {
            // Use the URI as the title
            $title = $uri;
        }

        if ($uri === '')
        {
            // Only use the base URL
            $uri = URL::base(FALSE, $protocol);
        }
        else
        {
            if (strpos($uri, '://') !== FALSE)
            {
                if (HTML::$windowed_urls === TRUE AND empty($attributes['target']))
                {
                    // Make the link open in a new window
                    $attributes['target'] = '_blank';
                }
            }
            elseif ($uri[0] !== '#')
            {
                $lang = Request::instance()->param('lang');
                // Make the URI absolute for non-id anchors
                $uri = URL::site($lang . $uri, $protocol);
            }
        }

        // Add the sanitized link to the attributes
        $attributes['href'] = $uri;

        return '<a'.HTML::attributes($attributes).'>'.$title.'</a>';
    }

    public static function toggler($element_selector, $title)
    {
        return 
            "
            <div class='toggler'>
                <a href='#' onClick=\"$('$element_selector').toggle(); return false;\">
                    &rarr;&nbsp;$title
                </a>
            </div>
            <div class='clear'></div>
            ";
    }

    public static function editor($id = 'body', $value = '', $path = '')
    {        
            $path = "&currentFolder=$path";
            $ckeditor = new Editor();
            $ckeditor->basePath = '/public/js/ckeditor/';
            $ckeditor->config['filebrowserBrowseUrl']      = '/ckfinder/ckfinder.html';
            $ckeditor->config['filebrowserImageBrowseUrl'] = '/ckfinder/ckfinder.html?type=Images';
            $ckeditor->config['filebrowserFlashBrowseUrl'] = '/ckfinder/ckfinder.html?type=Flash';
            $ckeditor->config['filebrowserUploadUrl']      = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files' . $path;
            $ckeditor->config['filebrowserImageUploadUrl'] = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images' . $path;
            $ckeditor->config['filebrowserFlashUploadUrl'] = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash' . $path;

            return $ckeditor->editor($id, $value);
    }
} // End html
