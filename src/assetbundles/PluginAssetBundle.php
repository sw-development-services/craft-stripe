<?php 

namespace swdevelopment\craftstripe\assetbundles;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;


class PluginAssetBundle extends AssetBundle{
    public function init(){
        $this->sourcePath = '@craftstripe' . '/web/assets/dist';

        $this->depends = [
            CpAsset::class
        ];

        $this->js = [
            'PluginBundle.js'
        ];

        $this->css = [
            'PluginBundle.css'
        ];

        parent::init();
    }
}