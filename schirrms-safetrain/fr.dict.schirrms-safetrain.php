<?php
/**
 * Localized data
 *
 * @copyright   Copyright (C) 2023 Schirrms
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

 Dict::Add('FR FR', 'French', 'French', array(
	// Dictionary entries go here
	'Class:FunctionalCI/Attribute:s_train' => 'Membre du/des Train(s) SAFe',
	'Class:FunctionalCI/Attribute:s_train_count' => 'Nombre de Train SAFE',
	'Class:FunctionalCI/Attribute:s_train_count+' => 'Nombre de Train SAFE dont ce CI est membre',
	'Class:SafeTrain' => 'Train SAFe',
  'Class:SafeTrain/Attribute:name' => 'Nom du train SAFe',
  'Class:SafeTrain/Attribute:name+' => 'Devrait être le même nom que le nom du train dans les étiquettes',
  'Class:SafeTrain/Attribute:s_train' => 'Code de l\'étiquette associé à ce train SAFe',
  'Class:SafeTrain/Attribute:s_train+' => 'DOIT être une étiquette valide !',
  'Class:SafeTrain/Attribute:org_id' => 'Code de l\'organisation',
  'Class:SafeTrain/Attribute:org_name' => 'Nom de l\'organisation',
	'Class:SafeTrain/Attribute:TrainCIs' => 'CIs de ce train',
	'Class:SafeTrain/Attribute:VMObsolescencedashboard' => 'Obsolescence des OS des Machines Virtuelles',
));
?>
