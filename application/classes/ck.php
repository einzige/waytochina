<?php defined('SYSPATH') or die('No direct script access.');

class CK
{
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
}
