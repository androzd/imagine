<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 3/30/16
 * Time: 9:37 AM
 */

namespace Androzd\Imagine;


use Intervention\Image\Image;

class ImagineProcess
{
    protected $_image;
    public function __construct(Image $image)
    {
        $this->_image = $image;
    }

    public function resize($width, $height = 100) {
        $this->_image = $this->_image->resize($width, $height);
    }
    public function widen($width) {
        $this->_image = $this->_image->widen($width);
    }
    public function heighten($height) {
        $this->_image = $this->_image->heighten($height);
    }
    public function blur($blur) {
        $this->_image = $this->_image->blur($blur);
    }
    public function brightness($level) {
        $this->_image = $this->_image->brightness($level);
    }                                                                                                           
    public function cache($lifetime = null, $returnObj = false) {
        $this->_image = $this->_image->cache($lifetime, $returnObj);
    }                                                      
    public function canvas($width, $height, $bgcolor = null) {
        $this->_image = $this->_image->canvas($width, $height, $bgcolor);
    }                                                                       
    public function circle($radius, $x, $y) {
        $this->_image = $this->_image->circle($radius, $x, $y);
    }                                                           
    public function colorize($red, $green, $blue) {
        $this->_image = $this->_image->colorize($red, $green, $blue);
    }                                                                                
    public function contrast($level) {
        $this->_image = $this->_image->contrast($level);
    }                                                                                                             
    public function crop($width, $height, $x = null, $y = null) {
        $this->_image = $this->_image->crop($width, $height, $x, $y);
    }                                                          
    public function ellipse($width, $height, $x, $y) {
        $this->_image = $this->_image->ellipse($width, $height, $x, $y);
    }                                          
    public function fill($filling, $x = null, $y = null) {
        $this->_image = $this->_image->fill($filling, $x, $y);
    }                                                                           
    public function flip($mode = 'h') {
        $this->_image = $this->_image->flip($mode);
    }                                                                                                              
    public function fit($width, $height = null, $position = 'center') {
        $this->_image = $this->_image->fit($width, $height, $position);
    }                                  
    public function gamma($correction) {
        $this->_image = $this->_image->gamma($correction);
    }                                                                                                             
    public function greyscale() {
        $this->_image = $this->_image->greyscale();
    }                                                                                   
    public function insert($source, $position = 'top-left', $x = 0, $y = 0) {
        $this->_image = $this->_image->insert($source, $position, $x, $y);
    }                                                 
    public function interlace($interlace = true) {
        $this->_image = $this->_image->interlace($interlace);
    }                                                                                                 
    public function invert() {
        $this->_image = $this->_image->invert();
    }                                                                                                                             
    public function limitColors($count, $matte = null) {
        $this->_image = $this->_image->limitColors($count, $matte);
    }                                                                                     
    public function line($x1, $y1, $x2, $y2) {
        $this->_image = $this->_image->line($x1, $y1, $x2, $y2);
    }                                                  
    public function make($source) {
        $this->_image = $this->_image->make($source);
    }                                                                                                                  
    public function mask($source, $mask_with_alpha) {
        $this->_image = $this->_image->mask($source, $mask_with_alpha);
    }                                                                                        
    public function opacity($transparency) {
        $this->_image = $this->_image->opacity($transparency);
    }                                                                                                       
    public function orientate() {
        $this->_image = $this->_image->orientate();
    }                                                                                                                          
    public function pixel($color, $x, $y) {
        $this->_image = $this->_image->pixel($color, $x, $y);
    }                                                                                          
    public function pixelate($size) {
        $this->_image = $this->_image->pixelate($size);
    }                                                                                                              
    public function polygon($points) {
        $this->_image = $this->_image->polygon($points);
    }                                                                                    
    public function rectangle($x1, $y1, $x2, $y2) {
        $this->_image = $this->_image->rectangle($x1, $y1, $x2, $y2);
    }                                             
    public function reset($name = 'default') {
        $this->_image = $this->_image->reset($name);
    }                                                                    
    public function resizeCanvas($width, $height, $anchor = 'center', $relative = false, $bgcolor = '#000000') {
        $this->_image = $this->_image->resizeCanvas($width, $height, $anchor, $relative, $bgcolor);
    }      
    public function rotate($angle, $bgcolor = '#000000') {
        $this->_image = $this->_image->rotate($angle, $bgcolor);
    }                                                                                    
    public function sharpen($amount = 10) {
        $this->_image = $this->_image->sharpen($amount);
    }                                                                                                        
    public function text($text, $x = 0, $y = 0) {
        $this->_image = $this->_image->text($text, $x, $y);
    }                                                        
    public function trim($base = 'top-left', array $away = array('top', 'bottom', 'left', 'right'), $tolerance = 0, $feather = 0) {
        $this->_image = $this->_image->trim($base, $away, $tolerance, $feather);
    }     

    protected function process($type, $params) {
        if ($type == 'chain') {
            foreach ($params as $config) {
                $this->call($config);
            }
        } else {
            $reflecion = new \ReflectionClass($this);
            if (!$reflecion->hasMethod($type)) {
                return;
            }
            $parameters = $reflecion->getMethod($type)->getParameters();
            $preparedParams = [];
            foreach ($parameters as $param) {
                $preparedParams[] = array_get($params, $param->name, $param->isDefaultValueAvailable() ? $param->getDefaultValue() : 0);
            }
            call_user_func_array([$this, $type], $preparedParams);
        }
    }
    public function call($config) {
        $type = array_get($config, 'type');
        $params = array_get($config, 'params');
        $this->process($type, $params);

        return $this->_image;
    }
}