<?php if(!defined('PLX_ROOT')) exit; ?>
<?php
	/**
		* Plugin for Pluxml
		* @author	gc-nomade
		* Site : https://github.com/gcyrillus
		* Licence GNU_GPL
	**/
	
	# Control du token du formulaire
	plxToken::validateFormToken($_POST);
	
	if(!empty($_POST)) {
		
		$plxPlugin->setParam('com_OOD', $_POST['com_OOD'], 'numeric');
		
		$plxPlugin->saveParams();
		header('Location: parametres_plugin.php?p='. basename(__DIR__));
		exit;
	}
	
	#init var defaut 365 jours/days
	$com_OOD =  $plxPlugin->getParam('com_OOD')=='' ? 365 : $plxPlugin->getParam('com_OOD');
?>

<form  id="form_coms_validity" action="parametres_plugin.php?p=<?php echo basename(__DIR__) ;?>" method="post">
	<fieldset><legend><label for="com_OOD"><?php echo $plxPlugin->lang('L_ALLOW_COMS_PERIOD') ?>&nbsp;:</label></legend>
		<?php plxUtils::printSelect('com_OOD',array(
			'7'		=> '1 '.$plxPlugin->getLang('L_WEEK'),
			'14'	=> '2 '.$plxPlugin->getLang('L_WEEKS'),
			'21'	=> '3 '.$plxPlugin->getLang('L_WEEKS'),
			'31'	=> '1 '.$plxPlugin->getLang('L_MONTH'),
			'61'	=> '2 '.$plxPlugin->getLang('L_MONTHS'),
			'91'	=> '3 '.$plxPlugin->getLang('L_MONTHS'),
			'182'	=> '6 '.$plxPlugin->getLang('L_MONTHS'),
			'365'	=> '1 '.$plxPlugin->getLang('L_YEAR'),
			'730'	=> '2 '.$plxPlugin->getLang('L_YEARS'),
			'1095'	=> '3 '.$plxPlugin->getLang('L_YEARS')),
			$com_OOD); 
		echo plxToken::getTokenPostMethod() ?>
		<input type="submit" name="submit"  />
	</fieldset>
</form>