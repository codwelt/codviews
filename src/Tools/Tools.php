<?php
namespace Codwelt\codviews\Tools;

/**
 * Clases Tools
 * @package App\Repository\Tools
 * @author FuriosoJack <iam@furiosojack.com>
 */
class Tools
{

    /**
     * Convierte un array un modelo  o un la collecion en caso de no exitir devuleve null
     *
     * @param $data
     * @return null
     */
    public static function forceToArray($data)
    {
        if (count($data) > 0 || isset($data)){
            $data = $data->toArray();
        }else{
            $data = null;
        }
        return $data;

    }

}