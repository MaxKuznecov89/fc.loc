<?php


namespace vendor\libs;


class Cache
{
public function set($name,$data,$time= 3600){
    $content['data'] =  $data;
    $content['end_time'] =  time() + $time;
    $filename = CACHE . '/' . md5($name) . ".txt";
    if(file_put_contents($filename,  serialize($content))){
        return true;
    }
    return false;
}
public function get($name){
    $filename = CACHE . '/' . md5($name) . ".txt";
    if($fStr = file_get_contents($filename)){
        $data = unserialize($fStr);
        if($data["end_time"] >= time()){
            return $data['data'];
        }
            unlink($filename);
            echo " time storage in to cache is end";

    }
    return false;
}
public function delete($name){
    $filename = CACHE . '/' . md5($name) . ".txt";
    if(file_exists($filename)){
        unlink($filename);
    }
}


}