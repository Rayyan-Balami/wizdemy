<?php

class BookmarkModel extends Model
{
    public function __construct(string $table = 'bookmarks')
    {
        parent::__construct($table);
        $this->fillable = ['user_id', 'project_id'];
    }

}