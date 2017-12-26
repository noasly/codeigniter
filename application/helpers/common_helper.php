<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('loadAssets')){
    /**
     * create css link
     * @param array $path
     * @param string $asset (css, js)
     * @return string
     */
    function loadAssets($path, $asset = 'css')
    {
        $html = '';
        $pathArr = $path;

        if(is_array($pathArr)) {
            foreach($pathArr as $path) {
                $path = $path . ASSET_VER;

	            if($asset == 'css') {
		            $html .= "<link rel='stylesheet' type='text/css' href='{$path}'>\n";
	            } else {
		            $html .= "<script type='text/javascript' src='{$path}'></script>\n";
	            }
            }
        }

        return $html;
    }
}

if(!function_exists('alertMessage')) {
    /**
     * create alert message
     * @param string $msg
     * @param bool $back
     * @return string
     */
    function alertMessage($msg, $back = false)
    {
        $script = '';
        $historyBack = (($back) ? 'history.back();' : '');

        if(!empty($msg)){
            $script = <<<SCRIPT
<script type="text/javascript">
    alert("{$msg}");
    {$historyBack}
</script>
SCRIPT;
        }

        return $script;
    }
}