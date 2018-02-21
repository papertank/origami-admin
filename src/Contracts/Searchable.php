<?php

namespace Origami\Admin\Contracts;

interface Searchable {

	public function scopeSearch($query, $keywords);

	public function getSearchResultUrl();
	public function getSearchResultTitle();
	public function getSearchResultType();

}
