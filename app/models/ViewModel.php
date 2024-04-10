<?php

class ViewModel extends Model
{
    public function __construct()
    {
        parent::__construct('views');
        $this->fillable = ['user_id', 'material_id','ip_address','user_agent'];
    }

    public function getViewCount($material_id)
    {
        return $this->count('veiw_id')
        ->where('material_id = :material_id')
        ->bind(['material_id' => $material_id])
            ->get();
    }
    public function getViewCountByUser($material_id, $user_id)
    {
        return $this->select()
        ->where('material_id = :material_id AND user_id = :user_id ')
        ->bind(['material_id' => $material_id, 'user_id' => $user_id])
            ->get();
    }
    public function addView($material_id, $user_id, $ip_address, $user_agent)
    {
        return $this->insert([
                'material_id' => $material_id,
                'user_id' => $user_id,
                'ip_address' => $ip_address,
                'user_agent' => $user_agent
            ])->execute();
    }
}