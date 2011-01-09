<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
    'path' => $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'thumbs',

    'path_url' => '/public/thumbs',

    'path_watermarks' => 'watermarks',

    'default_quality' => 85,

    'models' => array
    (
        'univercity' => array
        (
            'objects_per_folder' => 50,
            'limit_folders' => FALSE,
            'max_width'  => 2048,        
            'max_height' => 2048,        
            'max_square' => 1024*1024,    

            'chmod' => FALSE,        
            'thumbs' => array
            (
                'thumb' => array
                (
                    'default_size' => 'original',
                    'sizes' => array
                    (
                        'original' => array
                        (
                            'width' => FALSE,            
                            'height' => FALSE,            

                            'master' => Image::AUTO,    
                            'strict_size' => FALSE,        
                            'align_x' => '50%',            
                            'align_y' => '50%',            
                            'enlarge_small' => FALSE,    
                            'back_color' => 0,            
                            'watermark' => 'waytochina.org',         
                            'watermark_x' => '-100%',    
                            'watermark_y' => '-100%',    
                            'quality' => NULL,             
                            'format' => 'jpg',            
                        ),
                        'small' => array
                        (
                            'width' => 140,                
                            'height' => 92,            
                            'master' => Image::NONE,    
                            'strict_size' => TRUE,        
                            'align_x' => '50%',            
                            'align_y' => '50%',            
                            'enlarge_small' => TRUE,    
                            'back_color' => 0xCCCCCC,            
                            'watermark' => FALSE,         
                            'watermark_x' => '100%',    
                            'watermark_y' => '100%',    
                            'quality' => NULL,             
                            'format' => 'jpg',            
                        ),
                    ),
                ),
            ),
        ),
    )
);
