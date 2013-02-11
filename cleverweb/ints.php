<?php

interface versions{
	// version related
	const VER_name = "Project CleverWeb";
	const VER_major = "0";
	const VER_minor = "01";
	const VER_codename = "Pre-Alpha";
	const VER_patch = "";
	const VER_fullname =
		self:VER_name.' '.
		self:VER_major.'.'.
		self:VER_minor.' '.
		self:VER_codename
	;
}