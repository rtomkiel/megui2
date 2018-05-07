<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashController extends Controller
{
    public function getDatabaseUse() {
        $query = 'SELECT pg_database.datname as Database, pg_size_pretty(pg_database_size(pg_database.datname)) as db_size FROM pg_database WHERE datistemplate = false order by pg_database_size(pg_database.datname) desc;';
        $result = \Illuminate\Support\Facades\DB::select($query);
        
        $delete = 'DELETE FROM datadb';
        $resultdel = \Illuminate\Support\Facades\DB::select($delete);
        
        foreach ($result as $result) {
            $db = new \App\DataDB();
            $db->database = $result->database;
            $db->db_size = $result->db_size;
            $db->storage = $filestorage = shell_exec('du -sh /home/regis/.local/share/Odoo/filestore/'.$db->database . '| awk \'{print $1}\'');
            $db->save();
        } 
        
        
        $postgres = shell_exec('memory postgres');
        if ($postgres !== null) {
            list($psql['num'], $psql['ram'], $psql['total']) = explode("-", $postgres);
        }
        
        
        $python = shell_exec('memory python');
        if ($python !== null){
            list($pyt['num'], $pyt['ram'], $pyt['total']) = explode("-", $python);
        }
        else {
            list($pyt['num'], $pyt['ram'], $pyt['total']) = explode("-", "0-0-0");  
         }
        
        $apache = shell_exec('memory apache2');
        if ($apache !== null) {
           list($apa['num'], $apa['ram'], $apa['total']) = explode("-", $apache); 
        }
        
        
        $ram = shell_exec('free -m');
        
        return view('pages.teste', compact('ram', 'psql', 'pyt', 'apa', 'dbclients'), ['ram' => $ram],
                                                        ['dbclients' => $db], ['psql' => $psql], ['pyt' => $pyt], ['apa' => $apa] );        
    }
    
}
