<#

.SYNOPSIS
Script to automate DCV Server cleanup after uninstall

.DESCRIPTION

The script cleans up things that are created by the installer or at run time by dcv. 
In particular it removes:
- Audio drivers
- Webcam driver
- Printer driver
- DCV's log files
- DCV's settings from the registry
- Other keys from the registry

.NOTES
The script MUST be called after uninstalling DCV.

.LINK

#>

function Is-Installed( $program ) {    
    $x86 = ((Get-ChildItem "HKLM:\Software\Microsoft\Windows\CurrentVersion\Uninstall") |
        Where-Object { $_.GetValue( "DisplayName" ) -like "*$program*" } ).Length -gt 0;

    $x64 = ((Get-ChildItem "HKLM:\Software\Wow6432Node\Microsoft\Windows\CurrentVersion\Uninstall") |
        Where-Object { $_.GetValue( "DisplayName" ) -like "*$program*" } ).Length -gt 0;

    return $x86 -or $x64;
}

$dcv_display_name = 'NICE Desktop Cloud Visualization Server'

if (Is-Installed($dcv_display_name)) {
    Write-Error "Unable to clean DCV Server: call the script after uninstalling '$dcv_display_name'" 
    return
}

# Clean Drivers
#
# Drivers must be removed from Winsows'a DriverStore by using pnputl.exe
#
# Path that will be removed:
#   "$Env:WINDIR\System32\DriverStore\FileRepository\amazonprinterfilter.inf*"; # Driver repository of Amazon Printer
#   "$Env:WINDIR\System32\DriverStore\FileRepository\awsvirtualspeakersext.inf*"; # Driver repository of AWS Virtual Speakers
#   "$Env:WINDIR\System32\DriverStore\FileRepository\awsvirtualmicrophone.inf*";  # Driver repository of AWS Virtual Microphone
#   "$Env:WINDIR\System32\DriverStore\FileRepository\avscamera.inf*";			# Driver repository of Virtual Webcam
#
# Registry keys that will be removed:
#   'HKLM:SYSTEM\CurrentControlSet\Services\DCV_Audio_Spk_redirection'
#   'HKLM:SYSTEM\CurrentControlSet\Services\DCV_Audio_Mic_redirection'
#
# Registry keys that will be removed, where the Device Parameters's FriendlyName contains the word "DCV":
#   'HKLM:SYSTEM\CurrentControlSet\Control\DeviceClasses\{0ecef634-6ef0-472a-8085-5ad023ecbccd}\##?#SWD#PRINTENUM#*'; # 'DCV Printer'
#   'HKLM:SYSTEM\CurrentControlSet\Control\DeviceClasses\{*-00A0C9223196}\##?#ROOT#MEDIA#*';                          # 'DCV Audio *'
#   'HKLM:SYSTEM\CurrentControlSet\Control\DeviceClasses\{e6327cad-dcec-4949-ae8a-991e976a79d2}\##?#SWD#MMDEVAPI#*';  # 'Speakers (DCV Speakers 7.1 Device)'
#   'HKLM:SYSTEM\CurrentControlSet\Control\DeviceClasses\{2eef81be-33fa-4800-9670-1cd474972c3f}\##?#SWD#MMDEVAPI#*'   # 'Line (DCV Microphone Device)'

$drivers_to_remove = Get-WindowsDriver -online  | Where-Object {
    $_.OriginalFileName.Contains("amazonprinterfilter") -Or
    $_.OriginalFileName.Contains("awsvirtualspeakersext") -Or
    $_.OriginalFileName.Contains("awsvirtualmicrophone") -Or
    $_.OriginalFileName.Contains("avscamera")
    }

foreach ($driver_itm in $drivers_to_remove) {
    $driver_file = $driver_itm.Driver
    Write-Host "Removing driver: $driver_file"
    pnputil -d $driver_file
}

# Clean Files

$path_to_remove = @(
    "$Env:ALLUSERSPROFILE\NICE\dcv"; # Log folder global
    "$Env:SYSTEMDRIVE\Users\*\AppData\Local\NICE\dcv"; # Log folder of each user (if any)
    )
    
foreach ($path_expr in $path_to_remove) {
    if (-Not(Test-Path -Path $path_expr)) {
        continue
    }

    # Remove-Item -Recurse has some bugs, as reported here:
    # https://docs.microsoft.com/it-it/powershell/module/Microsoft.PowerShell.Management/Remove-Item?view=powershell-6
    #
    # Therefore we firstly remove all files of the directory tree, then we try to remove the directories.
    # If Remove-Item -Recurse fails while removing all directories, we retry without recursion. 

    foreach ($path_item in (Get-Item -Path $path_expr).FullName) {
        Write-Host "Removing path  : $path_item"
    
        # Remove all files in the tree
        Get-ChildItem -Path $path_item -Recurse | Where-Object { -not ($_.psiscontainer) } | Remove-Item -Force

        # Remove all directories
        try {
            Remove-Item -Path $path_item -Recurse -Force -ErrorAction Stop
        } catch {
            Write-Host "The command 'Remove-Item -Recurse' failed to remove the directory tree: "$_.Exception.Message"Retry without recursion."

            if (Test-Path -Path $path_expr\log) {
                Write-Host "Removing folder: $path_item\log"
                Remove-Item -Path $path_item\log -Force
            }    

            if (Test-Path -Path $path_expr) {
                Write-Host "Removing folder: $path_item"
                Remove-Item -Path $path_item -Force
            }
        }
    }
}

# Clean Registry

if (-Not(Test-Path HKU:)) {
    # Register the HKU alias
    $null = New-PSDrive -Name HKU -PSProvider Registry -Root Registry::HKEY_USERS
}

$keys_to_remove = @(
    'HKU:*\Software\GSettings\com\nicesoftware\dcv'; # DCV settings for all identities (if any)
    'HKCU:Software\GSettings\com\nicesoftware\dcv'; # DCV settings for current user
    'HKU:*\NICE\dcv';
    'HKLM:SYSTEM\CurrentControlSet\Control\MediaCategories\{85dea47f-cd49-4826-ba20-4ab537ea7810}'; # Simple.NameGuid of Audio OUT driver's inf file
    )
    
foreach ($key_expr in $keys_to_remove) {
    if (-Not(Test-Path -Path $key_expr)) {
        continue
    }

    foreach ($key_item in (Get-Item -Path $key_expr).Name) {
        if (Test-Path -Path "Registry::$key_item") {
            Write-Host "Removing key   : $key_item"
            Remove-Item -Path "Registry::$key_item" -Recurse
        }
    }
}

$dcv_service_installed = Get-Service dcvserver -ErrorAction SilentlyContinue
if ($dcv_service_installed){
    Write-Host "DCV service is still installed, cleaning up"
    sc.exe delete dcvserver
}

