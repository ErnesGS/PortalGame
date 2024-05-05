<#

.SYNOPSIS
Script to enable the loopback mode of the AWS Virtual Speakers driver

.USAGE

A) Before installing DCV:
- Run this script as administrator
- Install DCV

B) After installing DCV:
- Run this script as administrator
- Restart dcvserver service
#>

$enable_loopback = 1
$device_channels = 8

if ($args[0] -eq '--disable-loopback') {
  $enable_loopback = 0
  $device_channels = 0
}

$dcv_driver_dir = 'C:\Program Files\NICE\DCV\Server\drivers\'

$reinstall_device = Test-Path -Path $dcv_driver_dir'\audio\AWSVirtualSpeakersExt.inf'
if ($reinstall_device) { 
  # Stop Windows audio service to make sure that no application is using audio
  # Windows requires to reboot the instance if you try to remove a device used by an application.
  try {
    Stop-Service -Name "audiosrv" -ErrorAction Stop
  } catch {
    Write-Error "Unable to stop Windows audio service (audiosrv)"
    return
  }

  Write-Host "- Removing Virtual Speakers"
  $res = & $dcv_driver_dir'\common\devcon.exe' remove $dcv_driver_dir'\audio\AWSVirtualSpeakersExt.inf' '*AWSVirtualSpkExt'
  Write-Host $res

  # Check if devcon requires reboot to complete the remove procedure
  if ($res -Match 'reboot the system') {
    Write-Error "Device manager requires to reboot the instance to completely remove the device reboot the instace. Run again this script after reboot"         
    return
  }
}

Write-Host "- Configuring Virtual Speakers: enable-loopback='$enable_loopback'"
Set-Itemproperty -path 'HKLM:\SYSTEM\CurrentControlSet\Services\AWS_VAD_SPK_SA\Parameters' -Name 'enable-loopback' -Type DWord -value $enable_loopback
Set-Itemproperty -path 'HKLM:\SYSTEM\CurrentControlSet\Services\AWS_VAD_SPK_SA\Parameters' -Name 'device-channels' -Type DWord -value $device_channels

if ($reinstall_device) {
  Start-Service -Name "audiosrv" -ErrorAction Stop

  Write-Host "- Reinstalling Virtual Speakers"
  & $dcv_driver_dir'\common\devcon.exe' install $dcv_driver_dir'\audio\AWSVirtualSpeakersExt.inf' '*AWSVirtualSpkExt'
  Write-Host "- Restart dcvserver service to use the new audio device"
}
