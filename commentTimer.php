<?php
    if(!defined('PLX_ROOT')) {
        die('Oups!');
    }
    
    class commentTimer extends plxPlugin {
        
        const HOOKS = array(
        'plxMotorParseArticle',
        );
        const BEGIN_CODE = '<?php' . PHP_EOL;
        const END_CODE = PHP_EOL . '?>';
        
        public function __construct($default_lang) {
            # appel du constructeur de la classe plxPlugin (obligatoire)
            parent::__construct($default_lang);
            
            # Ajoute des hooks
            foreach(self::HOOKS as $hook) {
                $this->addHook($hook, $hook);
            }
            
            # droits pour accéder à la page config.php du plugin
            $this->setConfigProfil(PROFIL_ADMIN);
        }
        
        public function plxMotorParseArticle() {
            $validity= $this->getParam('com_OOD');
            echo self::BEGIN_CODE;
        ?>		
        if($art['allow_com'] && $this->aConf['allow_com']) {
        $publicationDay = floor((strtotime(date('YmdHi')) - strtotime($art['date'])) / (60*60*24));
        $updateDay      = floor((strtotime(date('YmdHi')) - strtotime($art['date_update'])) / (60*60*24));
        $delay = '<?php echo $validity; ?>'; 
        if (min($updateDay,$publicationDay) > $delay ) { $art['allow_com']= 0; }
        }
        
        <?php
            echo self::END_CODE;						
        }	     
    }
?>
