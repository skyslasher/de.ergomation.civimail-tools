# CiviMail tools

This plugin provides a single-click opt-out for CiviMail.
By default, users have to type their e-mail address into the opt-out form before they are opted out. This can be extremely
annoying for people that are already annoyed by a mass mailing.

Simply enable the plugin, no further settings needed. This plugin has an on OR off functionality, you cannot vary the opt-out
behavior case by case.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v7.0+
* CiviCRM 5.17

## Installation (Web UI)

This extension has not yet been published for installation via the web UI.

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl de.ergomation.civimail-tools@https://github.com/skyslasher/de.ergomation.civimail-tools/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/skyslasher/de.ergomation.civimail-tools.git
cv en civimail_tools
```

## Usage

Install and enable the plugin. Use the {action.optOutUrl} token for the opt-out link.
