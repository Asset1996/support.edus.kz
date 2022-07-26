<?php

namespace App\Helpers;

use Exception;

class Headers
{
    /**
     * Returns headers in getHeaders returned array if exist.
     *
     * @return array|bool
     */
    public static function get($key){
        $array = static::getHeaders();
        
        foreach (explode('.', $key) as $segment) {
            
            if (is_array($array) && array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return $array;
            }
        }

        return $array;
    }

    /**
     * Returns headers.
     *
     * @return array
     */
    protected static function getHeaders(){
        return [
            'register' => [
                'email' => [
                    'label' => trans('email'),
                    'type' => 'email',
                    'required' => False,
                    'value' => null
                ],
                'phone' => [
                    'label' => trans('phone'),
                    'type' => 'text',
                    'required' => False,
                    'value' => null
                ],
                'iin' => [
                    'label' => trans('iin'),
                    'type' => 'text',
                    'required' => False,
                    'value' => null
                ],
                'password' => [
                    'label' => trans('password'),
                    'type' => 'password',
                    'required' => True,
                    'value' => null
                ]
            ],
            'password_recovery' => [
                'email' => [
                    'label' => trans('email'),
                    'type' => 'email',
                    'required' => False,
                    'class' => null,
                    'value' => null
                ],
                'phone' => [
                    'label' => trans('phone'),
                    'type' => 'numeric',
                    'required' => False,
                    'class' => null,
                    'value' => null
                ],
            ],
            'services' => [
                'auth_list' => [
                    'login' => [
                        'label' => trans('login'),
                        'type' => 'text',
                        'required' => True,
                        'class' => null,
                        'value' => null
                    ],
                    'password' => [
                        'label' => trans('password'),
                        'type' => 'password',
                        'required' => True,
                        'class' => null,
                        'value' => null
                    ],
                ],
            ],
            'main' => [
                'iin' => [
                    'label' => trans('iin'),
                    'type' => 'text'
                ],
                'email' => [
                    'label' => trans('email'),
                    'type' => 'email'
                ],
                'phone' => [
                    'label' => trans('phone'),
                    'type' => 'text'
                ],
                'name' => [
                    'label' => trans('name'),
                    'type' => 'text'
                ],
            ],
        ];
    }
}
