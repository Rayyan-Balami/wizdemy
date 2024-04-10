<?php

class ReportModel extends Model
{

    public function __construct(string $table = 'study_materials')
    {
        parent::__construct($table);
        $this->fillable = [
            'user_id',
            'target_id',
            'target_type',
            'title',
            'description',
        ];
    }
  }