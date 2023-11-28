<?php

/**
 * Some functions to work with the iTop-SafeTrain extensions
 * 
 * Schirrms 2023 schirrms@schirrms.net
 */

// A trigerred class instead of using Method AfterInsert, AfterUpdate and AfterDelete
// iApplicationObjectExtension implementation found in application/applicationextension.inc.php
class SafeTrainTriggers implements iApplicationObjectExtension
{
	public function OnIsModified($oObject)
	{
		return false;
	}
	public function OnCheckToWrite($oObject)
	{
		return array();
	}
	public function OnCheckToDelete($oObject)
	{
		return array();
	}
	public function OnDBUpdate($oObject, $oChange = null)
	{
		SafeTrainFunct::SafeTrainCount($oObject->Get('finalclass'), $oObject->GetKey());
	}
	public function OnDBInsert($oObject, $oChange = null)
	{
		SafeTrainFunct::SafeTrainCount($oObject->Get('finalclass'), $oObject->GetKey());
	}
	public function OnDBDelete($oObject, $oChange = null)
	{
	}
}

class SafeTrainFunct
{
	/**
	 * Here are the real deal funct for this extension
	 */

	public static function SafeTrainCount($device_finalclass, $device_id)
	{
		// get a link to the device
		$oDevice = MetaModel::GetObject($device_finalclass, $device_id);
		if (is_object($oDevice)) {
			$sSafeTrain = trim($oDevice->Get('s_train'));
			// count the number of trains this CI belongs to
			$iSafeTrainCount = 0;
			if (isset($sSafeTrain) && $sSafeTrain != '') {
				$iSafeTrainCount = substr_count($sSafeTrain, ' ') + 1;
			}
			$oDevice->Set('s_train_count', $iSafeTrainCount);
			// don't forget the DBUpdate...
			$oDevice->DBUpdate();
		}
	}
}
