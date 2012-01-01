#ExiteCMS

* [Website](http://www.exitecms.org/)
* [Documentation](http://docs.exitecms.org)
* [Forums](http://www.exitecms.org/forums) for comments, discussion and community support
* Version: 8.0

## Description

ExiteCMS8 is a fast, lightweight PHP 5.3 application framework, built on top of the excellent FuelPHP framework.

It will add all common application functionality to the FuelPHP framework, such as authentication, authorisation, and theming and templating. ExiteCMS is widget driven, to extend your
application you only have to design your widget module. ExiteCMS will take care of the rest. ExiteCMS provides a full administrative backend to quickly setup a new application using
the installed modules and themes.

##Development Team

* Harro Verton - Lead Developer ([http://wanwizard.eu/](http://wanwizard.eu/))

##Downloading ExiteCMS

Since ExiteCMS uses Submodules and since GitHub Downloads don't support submodules, do not download ExiteCMS using the Downloads link here.

There is a download section on the ExiteCMS website, where you can find ready-to-install zipfiles.

> Note that for the current development branch no submodules are used, because we develop on the current FuelPHP develop branch.
> If you want to use the ExiteCMS develop branch, do a git clone of all required FuelPHP components and switch them to the
> latest FuelPHP develop branch.

##Cloning ExiteCMS

ExiteCMS uses submodules for external depedencies like the FuelPHP core folder and packages.  After you clone the repository you will need to init and update the submodules.

Here is the basic usage:

    git clone --recursive git://github.com/ExiteCMS/ExiteCMS8.git

The above command is the same as running:

    git clone git://github.com/ExiteCMS/ExiteCMS8.git
    cd ExiteCMS8
    git submodule init
    git submodule update

You can also shorten the last two commands to one:

    git submodule update --init

##Donate

[Donate Here](http://www.exitecms.org/donate)

Any donations would help support the ongoing development of ExiteCMS and pay for software, development and hosting costs. We understand if you cannot, but greatly appreciate anything you can give.
