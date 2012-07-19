<?php
if(!Member::Inst()->Action('is_admin'))
	Dialog::alert('You do not have permission!', Path::Group());
