<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 30/07/2019
 * Time: 14:41
 */

namespace App\Helper\Datatables;


class DataTablesHelper
{

    public function getDataTables($objectArray,$nullSearch,$start,$length,$totalRegisters):DataTables{

        $filteredList = null;
        if($length==-1){
            $filteredList = $objectArray;
        }else{
            $end = ($start + $length > count($objectArray)? count($objectArray):$start+$length);
            $start = $end < $start ? 0 : $start; //se end > start, há filtragem junto a paginação. Reload paginação.
            $filteredList =  array_slice($objectArray,$start,($end-$start));
            //rawObjectArray.subList(start, end);
        }

        $dataTables = new DataTables();
        $dataTables->setRecordsTotal($totalRegisters);
        $dataTables->setRecordsFiltered($nullSearch ? $totalRegisters : count($objectArray));
        $items = $dataTables->getData();
        foreach ($filteredList as $item) {
            $items[] = $item;
        }
        $dataTables->setData($items);

        return $dataTables;
    }

}