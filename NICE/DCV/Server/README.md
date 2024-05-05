# DCV - Desktop Cloud Visualization

DCV is a desktop remotization tool that allows access to desktop sessions
running on remote machines.

## Getting started

The DCV server runs as a service.
* on Linux it is a service started by systemd and that runs as the "dcv"
  system user
* on Windows it is a service called dcvserver which runs as SYSTEM

The service is normally automatically started after the installation is
complete.
However before the desktop remotization is available, you need to create
a `session`. A session is characterized by an ID (a string identifying the
session) and an Owner.

To create a session automatically at startup, set the following configuration
options (replace dcvuser with the user you want to use as owner)

On Linux, edit the /etc/dcv/dcv.conf file and include the following lines

```
[session-management]
create-session=true

[session-management/automatic-console-session]
owner="dcvuser"
```

On Windows set the following registry keys

```
$registyRoot = "Microsoft.PowerShell.Core\Registry::HKEY_USERS\S-1-5-18\Software\GSettings\com\nicesoftware\dcv"
New-Item -Path "$registyRoot\session-management" -Force
New-Item -Path "$registyRoot\session-management\automatic-console-session" -Force
New-ItemProperty -Path "$registyRoot\session-management" -Name create-session -PropertyType DWord -Value 1
New-ItemProperty -Path "$registyRoot\session-management\automatic-console-session" -Name owner -Value dcvuser
```

Alternatively sessions can be created dynamically using the 'dcv' tool.

## Network ports

By default the DCV server listens on port 8443. Make sure such port is reachable
in your firewall configuration.

## Certificates

By default the DCV server automatically generates self-signed TLS certificates.
It is possible to replace these certificates with certificates signed by a CA
and DCV will use them automatically.

## Authentication

By default DCV will use the `system` authentication, which delegates to the
underlying Operating System the verification of the credentials provided
by the user.

## Permissions

By default the DCV server grants full access to the owner of the session, while
other users are not allowed to access the remote desktop. It is possible to
configure fine grained permission policies using a dedicated configuration file.

## Logs

DCV server log files can be found in /var/log/dcv on Linux and in C:\ProgramData\NICE\dcv\log
on Windows.

To enable verbose logging, you can increase the log level:

On Linux, edit the /etc/dcv/dcv.conf file and include the following lines

```
[log]
level="debug"
```

On Windows set the following registry keys

```
$registyRoot = "Microsoft.PowerShell.Core\Registry::HKEY_USERS\S-1-5-18\Software\GSettings\com\nicesoftware\dcv"
New-Item -Path "$registyRoot\log" -Force
New-ItemProperty -Path "$registyRoot\log" -Name level -Value debug
```

Note however that increasing the log level may generate very large log files and
negatively affect the overall performance
