<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use HasFactory, Notifiable;

    /**
     * Name of table in DB.
     */
    protected $table;

    /**
     * Array of errors.
     */
    protected $errors = [];

    /**
     * Cheks if the errors array is empty.
     *
     * @return bool 
     */
    public function hasErrors(){
        return !empty($this->errors);
    }

    /**
     * Returns the first element of the errors array.
     *
     * @return array 
     */
    public function getFirstError(){
        return $this->errors[0];
    }

    /**
     * Creates the new record in DB.
     *
     * @param array $context
     * @return bool|array|object
     */
    abstract public function _create(array $context);

    /**
     * Updates the record in DB.
     *
     * @param array $conditions
     * @param array $context
     * @return bool|array|object
     */
    abstract public function _update(array $conditions, array $context);

    /**
     * Deletes the record in DB.
     *
     * @param array $conditions
     * @return bool
     */
    abstract public function _delete(array $conditions);
}
