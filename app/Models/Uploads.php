<?php
/**
 * Uploads model.
 */
namespace App\Models;

class Uploads extends BaseModel
{
    /**
     * Name of table in DB.
     */
    protected $table = "uploads";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_uid',
        'name',
        'original_name',
        'tickets_id',
        'messages_id',
        'path',
        'type',
        'extention',
        'size'
    ];

    /**
     * Creates the new upload in DB.
     *
     * @return bool|object 
     */
    public function _create(array $context = []){
        return $this::create($context);
    }

    /**
     * Updates the upload in DB.
     *
     * @param array $conditions
     * @param array $context
     * @return object 
     */
    public function _update(array $conditions = [], array $context = []){
        return $this::where($conditions)->update($context);
    }

    /**
     * Deletes the upload from DB.
     *
     * @param array $conditions
     * @return object 
     */
    public function _delete(array $conditions){
        return $this::where($conditions)->delete();
    }

    /**
     * Deletes the upload from DB with files in strorage.
     *
     * @param array $conditions
     * @return object 
     */
    public function delete_with_files(array $conditions){
        $tickets = $this->select('path')->where($conditions)->get();
        
        $filesPaths = array_map(
            function($arr) {
                return storage_path() . '/app/public/' . str_replace('storage/', '', $arr['path']);
            }, 
            $tickets->toArray()
        );
        \Illuminate\Support\Facades\File::delete($filesPaths);
        return $this->_delete($conditions);
    }
}
