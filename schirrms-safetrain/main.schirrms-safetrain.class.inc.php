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
    if (($oObject instanceof FunctionalCI) === true) {
      SafeTrainFunct::SafeTrainCount($oObject->GetKey());
    }
  }
  public function OnDBInsert($oObject, $oChange = null)
  {
    if (($oObject instanceof FunctionalCI) === true) {
      SafeTrainFunct::SafeTrainCount($oObject->GetKey());
    }
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

  public static function SafeTrainCount($device_id)
  {
    // get a link to the device
    $oDevice = MetaModel::GetObject('FunctionalCI', $device_id);
    if (is_object($oDevice)) {
      $sSafeTrain = trim($oDevice->Get('s_train'));
      // count the number of trains this CI belongs to
      $iSafeTrainCount = 0;
      if (isset($sSafeTrain) && $sSafeTrain != '') {
        $iSafeTrainCount = substr_count($sSafeTrain, ' ') + 1;
      }
      $oDevice->Set('s_train_count', $iSafeTrainCount);
      // remove any train_team outside of train list
      $sNewSafeTrainTeam = '';
      if (isset($sSafeTrain) && $sSafeTrain != '') {
        $sSafeTrainTeam = trim($oDevice->Get('s_train_team'));
        // iterate the train team list, if not empty
        if ($sSafeTrainTeam != '') {
          $aSafeTrainTeam = explode(' ', $sSafeTrainTeam);
          foreach ($aSafeTrainTeam as $sTeam) {
            // check if the train is still in the train list
            // ie, is the value Uppercase until a letter 'o' in the train list
            $iLetterOPos = strpos($sTeam, 'o');
            if ($iLetterOPos !== false and $iLetterOPos > 2) {
              // Extract the train code
              $sTeamSubstr = substr($sTeam, 0, $iLetterOPos);
              // check if the train code is in the train list
              if (strpos($sSafeTrain, $sTeamSubstr) !== false) {
                $sNewSafeTrainTeam .= $sTeam . ' ';
              }
            }
          }
        }
        // remove the last space
        $sNewSafeTrainTeam = rtrim($sNewSafeTrainTeam);
        // remove any ',' in the string
        $sNewSafeTrainTeam = str_replace(',', '', $sNewSafeTrainTeam);
      }
      $oDevice->Set('s_train_team', $sNewSafeTrainTeam);
      
      // don't forget the DBUpdate...
      $oDevice->DBUpdate();
    }
  }
}
