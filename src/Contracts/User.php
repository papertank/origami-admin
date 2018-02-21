<?php

namespace Origami\Admin\Contracts;

interface User {

	public function isAdmin();

	public function avatarUrl($size = null);

}
