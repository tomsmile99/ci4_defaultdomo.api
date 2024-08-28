<?php
function __checkExpTokentime($timeexptoken){
  return $timeexptoken > time() ? true : false;
}


function __checkPermissions($aguper,$wpper,$status){  // check permissions สำหรับ เจ้าหน้าที่
  $PermissionsAgUArr = ['AGAD'];
  $PermissionsWPArr = ['WP0013'];
  return in_array($aguper, $PermissionsAgUArr) || in_array($wpper, $PermissionsWPArr) && $status == 1 ? true : false;
}



function __checkPermissionsUser($rgU,$status){ // check permissions สำหรับผู้ใช้ สาขา/หน่วย
  $PermissionsRGArr = [1,2,3,4,5];
  return in_array($rgU, $PermissionsRGArr) && $status == 1 ? true : false;
}


function __checkPermissionsUserAndAdmin($aguper,$pstU,$status,$wpper){ // check permissions สำหรับ หน.หน้าบ้าน
  $PermissionsAgUArr = ['AGAD'];
  $PermissionsPSArr = ['PST019'];
  $PermissionsWPArr = ['WP0013'];
  return in_array($aguper, $PermissionsAgUArr) || in_array($pstU, $PermissionsPSArr) || in_array($wpper, $PermissionsWPArr) && $status == 1 ? true : false;
}