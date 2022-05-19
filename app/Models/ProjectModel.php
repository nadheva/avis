<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    public $date;
    public $event;
    protected $table = 'project';
    protected $allowedFields = ['id', 'cust_id', 'project_name', 'start', 'end_product' ,'status', 'pict', 'leader'];
    public function getProject($id = false)
    {
        if ($id === false) {
            // return $this->findAll();
            return $this->db->table($this->table)
            ->select('project.*, fullname, project.id')
            ->join('users', 'project.leader = users.id')
            ->get()->getResult();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }

    public function getEventCustomer($id) {
      $this->builder = $this->db->table('event_customer');
      $this->builder->orderBy('start','ASC');
      $this->builder->where('project_id', $id);
      return $this->builder->get()->getResult();
  }

  public function getEventInternal($id) {
      $this->builder = $this->db->table('event_internal');
      $this->builder->orderBy('start','ASC');
      $this->builder->where('project_id', $id);
      return $this->builder->get()->getResult();
  }

  public function getJsonEventCustomer($id){
      $this->builder = $this->db->table('event_customer');
      $this->builder->where('project_id', $id);
      $this->builder->orderBy('start','ASC');
      $ec = $this->builder->get()->getResult();
      $i = 0;
      $y = 1;
      foreach($ec as $ecust) {
        $eventCustomer[] = [
            "name" => $ecust->event_name,
            "id" => "eksternal".$y++,
            "dependency" => "eksternal".$i++,
            "parent" => "event_customer",
            "start" =>strtotime($ecust->start)*1000,
            "end" => strtotime($ecust->end)*1000,
        ];
    }
    if(isset($eventCustomer)){
        array_push($eventCustomer,['name' => 'Event Customer', 'id' => 'event_customer']);
        sort($eventCustomer);
        return $eventCustomer;
    }
}

public function getJsonEventInternal($id){
  $this->builder = $this->db->table('event_internal');
  $this->builder->where('project_id', $id);
  $this->builder->orderBy('start','ASC');
  $ei = $this->builder->get()->getResult();
  $i = 0;
  $y = 1;
  foreach($ei as $eint) {
    $eventInternal[] = [
        "name" => $eint->event_name,
        "id" => "internal".$y++,
        "dependency" => "internal".$i++,
        "parent" => "event_internal",
        "start" => strtotime($eint->start)*1000,
        "end" => strtotime($eint->end)*1000,
    ];
}
if(isset($eventInternal)){
    array_push($eventInternal,['name' => 'Event Internal', 'id' => 'event_internal']);
    sort($eventInternal);
    return $eventInternal;
}
}

public function getIssueDevelopment($id)
{
    $this->builder = $this->db->table('quality');
    $this->builder->select('quality.id, event, issue, description, date, closing_action, fullname, quality.status, event_name');
    $this->builder->join('users', 'users.id = quality.lead');
    $this->builder->join('event_customer', 'event_customer.id = quality.event');
    $this->builder->where('quality.project_id', $id);
    return $this->builder->get()->getResult();
}

public function getIssueSafelaunch($id)
{
    $this->builder = $this->db->table('quality_safelaunch');
    $this->builder->select('quality_safelaunch.id, event, issue, description, date, closing_action, fullname, quality_safelaunch.status, event_name');
    $this->builder->join('users', 'users.id = quality_safelaunch.lead');
    $this->builder->join('event_customer', 'event_customer.id = quality_safelaunch.event');
    $this->builder->where('quality_safelaunch.project_id', $id);
    return $this->builder->get()->getResult();
}

public function getIssueCustPPAP($id)
{
    $this->builder = $this->db->table('quality_custppap');
    $this->builder->select('quality_custppap.id, event_name, required_items, submission_date, flag, fullname, quality_custppap.status');
    $this->builder->join('users', 'users.id = quality_custppap.pic');
    $this->builder->join('event_customer', 'event_customer.id = quality_custppap.event');
    $this->builder->where('quality_custppap.project_id', $id);
    return $this->builder->get()->getResult();
}

public function getIssueSupPPAP($id)
{
    $this->builder = $this->db->table('quality_supppap');
    $this->builder->select('quality_supppap.id, supplier, component, target_date, flag, fullname, quality_supppap.status');
    $this->builder->join('users', 'users.id = quality_supppap.pic');
    $this->builder->where('quality_supppap.project_id', $id);
    return $this->builder->get()->getResult();  
}

public function getPvTest($id)
{
    $this->builder = $this->db->table('quality_pvtest');
    $this->builder->select('quality_pvtest.id, test_item, plan_start, plan_completed, actual_start, actual_completed, flag, result');
    $this->builder->where('quality_pvtest.project_id', $id);
    return $this->builder->get()->getResult();  
}

public function getPvTestSum($id)
{
    $this->builder = $this->db->table('quality_pvtestsum');
    $this->builder->select('quality_pvtestsum.id, total_test, test_done, past_first_test, flag');
    $this->builder->where('quality_pvtestsum.project_id', $id);
    return $this->builder->get()->getResult();  
}

public function getCas($id)
{
    $this->builder = $this->db->table('quality_cas');
    $this->builder->select('quality_cas.*, fullname');
    $this->builder->join('users', 'quality_cas.lead = users.id');
    $this->builder->where('quality_cas.project_id', $id);
    return $this->builder->get()->getResult();  
}

public function getNextEvent($arr){
    foreach($arr as $value)
    {
        $newDates[$value->event_name] = strtotime($value->start);
    }
    if(isset($newDates)){
        asort($newDates);
        foreach ($newDates as $key => $value)
        {
            if ($value > time()){
                $next = new ProjectModel();
                $next->date = date('d M Y', $value);
                $next->event = $key;
                return $next;
            }
        }
    }
}

public function getCurrentEvent($arr){
    foreach($arr as $value)
    {
        $newDates[$value->event_name] = strtotime($value->start);
    }
    if(isset($newDates)){
        arsort($newDates);
        foreach ($newDates as $key => $value)
        {
            if ($value <= time()){
                $current = new ProjectModel();
                $current->date = date('d M Y', $value);
                $current->event = $key;
                return $current;
            }
        }
    }
        // dd($newDates);
}

public function getLastEvent($arr){
    foreach($arr as $value)
    {
        $newDates[$value->event_name] = strtotime($value->start);
    }
    if(isset($newDates)){
        arsort($newDates);
        foreach ($newDates as $key => $value)
        {
            if ($value <= time()){
                $last[$key] = date('d M Y', $value);
            }
        }
        if(isset($last)){
            $slice = array_slice($last, 1);
            $last = new ProjectModel();
            $last->date = current($slice);
            $last->event = key($slice);
            return $last;
        }
    }
}

public function getPicTaskPerformance($idp)
{
    $this->builder = $this->db->table('task');
    $this->builder->select('fullname, task.status');
    $this->builder->join('project', 'task.project_id = project.id');
    $this->builder->join('users', 'task.pic = users.id');
    $this->builder->where('task.project_id', $idp);
    $total = $this->builder->get()->getResult();
    foreach ($total as $row){
        $tot[] = $row->fullname;
        if($row->status == 'Done'){
            $done[] = $row->fullname;
        }
        if($row->status == 'In Progress'){
            $open[] = $row->fullname;
        }
    }
    if(!isset($tot)){$tot=[0];}
    if(!isset($done)){$done=[0];}
    $un = array_unique($tot);
    $ctot = array_count_values($tot);
    $cdone = array_count_values($done);
    foreach($ctot as $row) { $newtot[] = $row; }
    foreach($cdone as $row) { $newdone[] = $row; }
    if(count($ctot) != count($cdone)){
        $dif = count($ctot)-count($cdone);
        for($x=0;$x<=$dif;$x++){
          $y= 0;
          array_push($newdone, $y);
      }
  }
  $i=0;
  $y=0;
        // if(count($total) != 0){
  foreach($un as $row){
    $out[] = [
        "fullname" => $row,
        "total" => $newtot[$i++],
        "done" => $newdone[$y++],
    ];
}
        // } else {
            // $out = [];
        // }
return $out; 
}

public function getRioPerform($idp)
{
    $this->builder = $this->db->table('rio');
    $this->builder->select('fullname, rio.status');
    $this->builder->join('project', 'rio.project_id = project.id');
    $this->builder->join('users', 'rio.pic = users.id');
    $this->builder->where('rio.project_id', $idp);
    $total = $this->builder->get()->getResult();
        // dd($total);
    foreach ($total as $row){
        $tot[] = $row->fullname;
        if($row->status == 'Done'){
            $done[] = $row->fullname;
        }
    }
        // dd($done,$tot);
        // error urutan array
    if(!isset($tot)){$tot=[0];}
    if(!isset($done)){$done=[0];}
    $un = array_unique($tot);
    $udone = array_unique($done);
    $unArr = array_unique(array_merge($udone, $un), SORT_REGULAR);
    $ctot = array_count_values($tot);
    $cdone = array_count_values($done);
        // dd($cdone);
    foreach($ctot as $row) { $newtot[] = $row; }
    foreach($cdone as $row) { $newdone[] = $row; }
    if(count($ctot) != count($cdone)){
        $dif = count($ctot)-count($cdone);
        for($x=0;$x<=$dif;$x++){
          $y= 0;
          array_push($newdone, $y);
      }
  }
  $i=0;
  $y=0;
        // dd($un, $udone, );
  foreach($un as $row){
    $out[] = [
        "fullname" => $row,
        "total" => $newtot[$i++],
        "done" => $newdone[$y++],
    ];
}
return $out; 
}

public function getPicChildTaskPerformance($idp)
{
    $this->builder = $this->db->table('child_task');
    $this->builder->select('fullname, child_task.status');
    $this->builder->join('task', 'child_task.task_id = task.id');
    $this->builder->join('project', 'task.project_id = project.id');
    $this->builder->join('users', 'child_task.pic = users.id');
    $this->builder->where('task.project_id', $idp);
    $total = $this->builder->get()->getResult();
        // dd($total);
    foreach ($total as $row){
        $tot[] = $row->fullname;
        if($row->status == 'Done'){
            $done[] = $row->fullname;
        }
        if($row->status == 'In Progress'){
            $open[] = $row->fullname;
        }
    }
    if(!isset($tot)){$tot=[0];}
    if(!isset($done)){$done=[0];}
    $un = array_unique($tot);
    $ctot = array_count_values($tot);
    $cdone = array_count_values($done);
    foreach($ctot as $row) { $newtot[] = $row; }
    foreach($cdone as $row) { $newdone[] = $row; }
    if(count($ctot) != count($cdone)){
        $dif = count($ctot)-count($cdone);
        for($x=0;$x<=$dif;$x++){
          $y= 0;
          array_push($newdone, $y);
      }
  }
  $i=0;
  $y=0;
  foreach($un as $row){
    $out[] = [
        "fullname" => $row,
        "total" => $newtot[$i++],
        "done" => $newdone[$y++],
    ];
}
        // dd($out);
return $out; 
}

public function getChildRioPerfom($idp)
{
    $this->builder = $this->db->table('child_rio');
    $this->builder->select('fullname, child_rio.status');
    $this->builder->join('rio', 'child_rio.rio_id = rio.id');
    $this->builder->join('project', 'rio.project_id = project.id');
    $this->builder->join('users', 'child_rio.pic = users.id');
    $this->builder->where('rio.project_id', $idp);
    $total = $this->builder->get()->getResult();
        // dd($total);
    foreach ($total as $row){
        $tot[] = $row->fullname;
        if($row->status == 'Done'){
            $done[] = $row->fullname;
        }
        if($row->status == 'In Progress'){
            $open[] = $row->fullname;
        }
    }
    if(!isset($tot)){$tot=[0];}
    if(!isset($done)){$done=[0];}
    $un = array_unique($tot);
    $ctot = array_count_values($tot);
    $cdone = array_count_values($done);
    foreach($ctot as $row) { $newtot[] = $row; }
    foreach($cdone as $row) { $newdone[] = $row; }
    if(count($ctot) != count($cdone)){
        $dif = count($ctot)-count($cdone);
        for($x=0;$x<=$dif;$x++){
          $y= 0;
          array_push($newdone, $y);
      }
  }
  $i=0;
  $y=0;
  foreach($un as $row){
    $out[] = [
        "fullname" => $row,
        "total" => $newtot[$i++],
        "done" => $newdone[$y++],
    ];
}
        // dd($out);
return $out; 
}

public function getPicPerform($task=null, $childtask=null)
{
    $armerge = array_merge($task,$childtask);
    $tempArr = array_unique(array_column($armerge, 'fullname'));
    $arrec = array_intersect_key($armerge,$tempArr);
    foreach($task as $t) {
        foreach($childtask as $ct) {
            if($t['fullname'] == $ct['fullname']){
                $nr[] = [
                    'fullname' => $t['fullname'],
                    'total' => $ct['total']+$t['total'],
                    'done' => $ct['done']+$t['done'],
                ];
            } else {
                $nr = [];
            }
        }
    }
    $rez = array_merge_recursive($arrec,$nr);
    $columns = array_column($rez, 'total');
    array_multisort($columns, SORT_DESC, $rez);
    $tempArr2 = array_unique(array_column($rez, 'fullname'));
    $result = array_intersect_key($rez,$tempArr2);
        // dd($result, $arrec);
    foreach ($result as $row) {
        $out[] = [
            "fullname" => $row['fullname'],
            "total" => $row['total'],
            "done" => $row['done'],
            "open" => $row['total'] - $row['done'],
            "percent" => round(($row['done']/$row['total'])*100, 2),
        ];
    }
    $columns = array_column($out, 'percent');
    array_multisort($columns, SORT_DESC, $out);

    return $out;
}

public function getRioPicPerform($rio=null, $childrio=null)
{
    $armerge = array_merge($rio,$childrio);
    $tempArr = array_unique(array_column($armerge, 'fullname'));
    $arrec = array_intersect_key($armerge,$tempArr);
        // dd($rio,$childrio);
    foreach($rio as $t) {
        foreach($childrio as $ct) {
            if($t['fullname'] == $ct['fullname']){
                $nr[] = [
                    'fullname' => $t['fullname'],
                    'total' => $ct['total']+$t['total'],
                    'done' => $ct['done']+$t['done'],
                ];
            } else {
                $nr[] = [
                    'fullname' => $t['fullname'],
                    'total' => $ct['total'],
                    'done' => $ct['done'],
                ];
            }
        }
    }
        // dd($nr, $arrec);
    $rez = array_merge_recursive($arrec,$nr);
    $columns = array_column($rez, 'total');
        // array_multisort($columns, SORT_DESC, $rez);
        // dd($columns, $rez);
    $tempArr2 = array_unique(array_column($rez, 'fullname'));
        // dd($columns, $rez, $tempArr2);
    $result = array_intersect_key($rez,$tempArr2);
    foreach ($result as $row) {
        $out[] = [
            "fullname" => $row['fullname'],
            "total" => $row['total'],
            "done" => $row['done'],
            "open" => $row['total'] - $row['done'],
            "percent" => round(($row['done']/$row['total'])*100, 2),
        ];
    }
    $columns = array_column($out, 'percent');
    array_multisort($columns, SORT_DESC, $out);
        // dd($out);

    return $out;
}

public function getAllPicPerform($task=null, $rio=null)
{
    foreach($task as $row) {
        $newTask[] = [
            'fullname' => $row['fullname'],
            'total' => $row['total'],
            'done' => $row['done'],
        ];
    }
    foreach($rio as $row) {
        $newRio[] = [
            'fullname' => $row['fullname'],
            'total' => $row['total'],
            'done' => $row['done'],
        ];
    }
    $armerge = array_merge($newTask,$newRio);
    $tempArr = array_unique(array_column($armerge, 'fullname'));
    $arrec = array_intersect_key($armerge,$tempArr);
        // dd($armerge, $tempArr, $arrec, $newTask, $newRio);
    foreach($newTask as $t) {
        foreach($newRio as $ct) {
            if($t['fullname'] == $ct['fullname']){
                $nr1[] = [
                    'fullname' => $t['fullname'],
                    'total' => $ct['total']+$t['total'],
                    'done' => $ct['done']+$t['done'],
                ];
            } else { 
                $nr[] = [
                    'fullname' => $t['fullname'],
                    'total' => $ct['total'],
                    'done' => $ct['done'],
                ];
            }
        }
    }
        // dd(array_map("unserialize", array_unique(array_map("serialize", $arrec))));
        // dd($nr1, $arrec);
    $rez = array_merge_recursive($arrec,$nr1);
        // dd($rez, $nr1, $newTask, $newRio);
    $columns = array_column($rez, 'total');
    array_multisort($columns, SORT_DESC, $rez);
    $tempArr2 = array_unique(array_column($rez, 'fullname'));
    $result = array_intersect_key($rez,$tempArr2);
        // dd(count($result),$rez);
    if(count($result) != 1 && count($rez) != 2){
        foreach ($result as $row) {
            $out[] = [
                "fullname" => $row['fullname'],
                "total" => $row['total'],
                "done" => $row['done'],
                "open" => $row['total'] - $row['done'],
                "percent" => round(($row['done']/$row['total'])*100, 2),
            ];
        }
        $columns = array_column($out, 'percent');
        array_multisort($columns, SORT_DESC, $out);
    } else {
        $out = [];
    }
        // dd($out);
    return $out;
}

public function getProductivity($id)
{
    return $this->db->table($this->table)
    ->select('productivity.*, event_name')
    ->join('productivity', 'productivity.project_id = project.id')
    ->join('event_internal', 'event_internal.id = productivity.event_id')
    ->where('productivity.project_id', $id)
    ->orderBy('event_id', 'ASC')
    ->get()->getResult();
}

public function getProductCluster()
{
    return $this->db->table($this->table)
    ->where('end_product', 'Cluster')
    ->get()->getResult();
}

public function getProductAHU()
{
    return $this->db->table($this->table)
    ->where('end_product', 'AHU')
    ->get()->getResult();
}

public function getProductPWBA()
{
    return $this->db->table($this->table)
    ->where('end_product', 'PWBA')
    ->get()->getResult();
}

public function getProjectJoinCust()
{
    $allProj = $this->db->table($this->table)
    ->select('project.*, customer_name, type, fullname')
    ->join('customer', 'project.cust_id = customer.id')
    ->join('users', 'project.leader = users.id')
    ->get()->getResult();
    foreach ($allProj as $row) {
    }
    return $allProj;
}

public function getFinancialStat($idp, $dum = NULL)
{
    $budget = $this->db->table('budget')->where('project_id', $idp)->get()->getResult();
    foreach($budget as $row){
        if($row->total < ($row->smt + $row->fa + $row->tooling)){ $tbdg[] = $row->id; } else { $tbdg = []; }
        if($row->smt < $row->used_smt){ $smt[] = $row->id; } else { $smt = []; }
        if($row->tooling < $row->used_tooling){ $tooling[] = $row->id; } else { $tooling = []; }
        if($row->fa < $row->used_fa){ $fa[] = $row->id; } else { $fa = []; }
    }
    $launch_cost = $this->db->table('launch_cost')->where('project_id', $idp)->get()->getResult();
    foreach($launch_cost as $row){
        if($row->total < ($row->pv + $row->launch + $row->other)){ $tlc[] = $row->id; } else { $tlc = []; }
        if($row->pv < $row->used_pv){ $pv[] = $row->id; } else { $pv = []; }
        if($row->launch < $row->used_launch){ $launch[] = $row->id; } else { $launch = []; }
        if($row->other < $row->used_other){ $other[] = $row->id; } else { $other = []; }
    }
    $material_cost = $this->db->table('material_cost')->where('project_id', $idp)->get()->getResult();
    foreach($material_cost as $row){
        if($row->total < ($row->mcomp + $row->ecomp)){ $tmc[] = $row->id; } else { $tmc = []; }
        if($row->mcomp < $row->used_mcomp){ $mcomp[] = $row->id; } else { $mcomp = []; }
        if($row->ecomp < $row->used_ecomp){ $ecomp[] = $row->id; } else { $ecomp = []; }
    }
    $arr = [count($tbdg),count($smt),count($tooling),count($tlc),count($fa),count($pv),count($launch),count($other),count($tmc),count($mcomp),count($ecomp)];
    $tbudget = [count($tbdg),count($smt),count($tooling),count($fa)];
    $tlauch = [count($tlc),count($pv),count($launch),count($other)];
    $tcomp = [count($tmc),count($mcomp),count($ecomp)];
    if(in_array(1,$tbudget)){$tbud="red";}else{$tbud="green";}
    if(in_array(1,$tlauch)){$tlaun="red";}else{$tlaun="green";}
    if(in_array(1,$tcomp)){$tcmp="red";}else{$tcmp="green";}
    $outsingle = [
        'budget' => $tbud,
        'launch_cost' => $tlaun,
        'material_cost' => $tcmp,
    ];
    if(in_array(1,$arr)){
        $out = 'red';
    }else{
        $out = 'green';
    }
        // dd($out);
    if($dum == NULL){ return $out; } else { return $outsingle; }
}

public function getQualityStat($idp)
{
        // quality_custppap quality_safelaunch quality_supppap quality_pvtest quality_pvtestsum quality_cas
    $quality = $this->db->table('quality')->where('project_id', $idp)->get()->getResult();
    foreach($quality as $row){ $qualdev[] = $row->status; }
    if(!isset($qualdev)){ $qualdev = []; }
    if(in_array('Open', $qualdev)){$statqualdev='red';}else{$statqualdev='green';}
    $quality_safelaunch = $this->db->table('quality_safelaunch')->where('project_id', $idp)->get()->getResult();
    foreach($quality_safelaunch as $row){ $sl[] = $row->status; }
    if(!isset($sl)){ $sl = []; }
    if(in_array('Open', $sl)){$statsl='red';}else{$statsl='green';}
    $quality_custppap = $this->db->table('quality_custppap')->where('project_id', $idp)->get()->getResult();
    foreach($quality_custppap as $row){ $custppap[] = $row->flag; }
    if(!isset($custppap)){ $custppap = [];}
    if(in_array('Red', $custppap)){$statcustppap='red';}elseif(in_array('Yellow', $custppap)){$statcustppap='yellow';}else{$statcustppap='green';}
    $quality_supppap = $this->db->table('quality_supppap')->where('project_id', $idp)->get()->getResult();
    foreach($quality_supppap as $row){ $supppap[] = $row->flag; }
    if(!isset($supppap)){ $supppap = [];}
    if(in_array('Red', $supppap)){$statsupppap='red';}elseif(in_array('Yellow', $supppap)){$statsupppap='yellow';}else{$statsupppap='green';}
    $quality_pvtest = $this->db->table('quality_pvtest')->where('project_id', $idp)->get()->getResult();
    foreach($quality_pvtest as $row){ $pvtest[] = $row->flag; }
    if(!isset($pvtest)){ $pvtest = [];}
    if(in_array('Red', $pvtest)){$statpvtest='red';}elseif(in_array('Yellow', $pvtest)){$statpvtest='yellow';}else{$statpvtest='green';}
    $quality_pvtestsum = $this->db->table('quality_pvtestsum')->where('project_id', $idp)->get()->getResult();
    foreach($quality_pvtestsum as $row){ $pvtestsum[] = $row->flag; }
    if(!isset($pvtestsum)){ $pvtestsum = [];}
    if(in_array('Red', $pvtestsum)){$statpvtestsum='red';}elseif(in_array('Yellow', $pvtestsum)){$statpvtestsum='yellow';}else{$statpvtestsum='green';}
    $quality_cas = $this->db->table('quality_cas')->where('project_id', $idp)->get()->getResult();
    foreach($quality_cas as $row){ $cas[] = $row->flag; }
    if(!isset($cas)){ $cas = [];}
    if(in_array('Red', $cas)){$statcas='red';}elseif(in_array('Yellow', $cas)){$statcas='yellow';}else{$statcas='green';}
    $arr = [$statqualdev,$statsl,$statcustppap,$statsupppap,$statpvtest,$statpvtestsum,$statcas];
    if(in_array('red',$arr)){
        $out = 'red';
    } elseif (in_array('yellow',$arr)){
        $out = 'yellow';
    } else {
        $out = 'green';
    }
        // dd($out);
    return $out;
}

public function getLastUpdatedQuality($idp)
{
    $quality = $this->db->table('quality')->where('project_id', $idp)->get()->getResult();
    foreach($quality as $row){ $qualdev[] = strtotime($row->updated_at); }
    if(!isset($qualdev)){ $qualdev = [0]; }
    $quality_safelaunch = $this->db->table('quality_safelaunch')->where('project_id', $idp)->get()->getResult();
    foreach($quality_safelaunch as $row){ $sl[] = strtotime($row->updated_at); }
    if(!isset($sl)){ $sl = [0]; }
    $quality_custppap = $this->db->table('quality_custppap')->where('project_id', $idp)->get()->getResult();
    foreach($quality_custppap as $row){ $custppap[] = strtotime($row->updated_at); }
    if(!isset($custppap)){ $custppap = [0];}
    $quality_supppap = $this->db->table('quality_supppap')->where('project_id', $idp)->get()->getResult();
    foreach($quality_supppap as $row){ $supppap[] = strtotime($row->updated_at); }
    if(!isset($supppap)){ $supppap = [0];}
    $quality_pvtest = $this->db->table('quality_pvtest')->where('project_id', $idp)->get()->getResult();
    foreach($quality_pvtest as $row){ $pvtest[] = strtotime($row->updated_at); }
    if(!isset($pvtest)){ $pvtest = [0];}
    $quality_pvtestsum = $this->db->table('quality_pvtestsum')->where('project_id', $idp)->get()->getResult();
    foreach($quality_pvtestsum as $row){ $pvtestsum[] = strtotime($row->updated_at); }
    if(!isset($pvtestsum)){ $pvtestsum = [0];}
    $quality_cas = $this->db->table('quality_cas')->where('project_id', $idp)->get()->getResult();
    foreach($quality_cas as $row){ $cas[] = strtotime($row->updated_at); }
    if(!isset($cas)){ $cas = [0];}
    rsort($qualdev); rsort($sl); rsort($custppap); rsort($supppap); rsort($pvtest); rsort($pvtestsum); rsort($cas);
    $arr = [$qualdev[0],$sl[0],$custppap[0],$supppap[0],$pvtest[0],$pvtestsum[0],$cas[0]];
    rsort($arr);
    if($arr[0] == 0) {
        return '-';
    } else {
        return date('d M Y | H:i:s', $arr[0]);
    }
}

public function getLastUpdatedFinance($idp)
{
    $budget = $this->db->table('budget')->where('project_id', $idp)->get()->getResult();
    foreach($budget as $row){ $budgetArr[] = strtotime($row->updated_at); }
    if(!isset($budgetArr)){ $budgetArr = [0]; }
    $launch_cost = $this->db->table('launch_cost')->where('project_id', $idp)->get()->getResult();
    foreach($launch_cost as $row){ $launch_costArr[] = strtotime($row->updated_at); }
    if(!isset($launch_costArr)){ $launch_costArr = [0]; }
    $material_cost = $this->db->table('material_cost')->where('project_id', $idp)->get()->getResult();
    foreach($material_cost as $row){ $material_costArr[] = strtotime($row->updated_at); }
    if(!isset($material_costArr)){ $material_costArr = [0]; }
    rsort($budgetArr);rsort($launch_costArr);rsort($material_costArr);
    $arr = [$budgetArr[0],$launch_costArr[0],$material_costArr[0]];
    rsort($arr);
    if($arr[0] == 0) {
        return '-';
    } else {
        return date('d M Y | H:i:s', $arr[0]);
    }
}

public function getLastUpdatedTask($idp)
{
    $task = $this->db->table('task')
    ->select('task.updated_at')
    ->where('project_id', $idp)->get()->getResult();
    foreach($task as $row){ $taskArr[] = strtotime($row->updated_at); }
    if(!isset($taskArr)){ $taskArr = [0]; }
    $child_task = $this->db->table('child_task')
    ->select('child_task.updated_at')
    ->join('task', 'task.id = child_task.task_id')
    ->where('task.project_id', $idp)->get()->getResult();
    foreach($child_task as $row){ $child_taskArr[] = strtotime($row->updated_at); }
    if(!isset($child_taskArr)){ $child_taskArr = [0]; }
    $approval = $this->db->table('approval')
    ->select('approval.updated_at')
    ->join('task', 'task.id = approval.task_id')
    ->where('task.project_id', $idp)->get()->getResult();
    foreach($approval as $row){ $approvalArr[] = strtotime($row->updated_at); }
    if(!isset($approvalArr)){ $approvalArr = [0]; }
    $child_task_approval = $this->db->table('child_task_approval')
    ->select('child_task_approval.updated_at')
    ->join('child_task', 'child_task.id = child_task_approval.child_task_id')
    ->join('task', 'task.id = child_task.task_id')
    ->where('task.project_id', $idp)->get()->getResult();
    foreach($child_task_approval as $row){ $child_task_approvalArr[] = strtotime($row->updated_at); }
    if(!isset($child_task_approvalArr)){ $child_task_approvalArr = [0]; }
    rsort($taskArr);rsort($child_taskArr);rsort($approvalArr);rsort($child_task_approvalArr);
        // dd($child_task);
    $arr = [$taskArr[0],$child_taskArr[0],$approvalArr[0],$child_task_approvalArr[0]];
    rsort($arr);
    if($arr[0] == 0) {
        return '-';
    } else {
        return date('d M Y | H:i:s', $arr[0]);
    }
}

public function getLastUpdateProductivity($idp)
{
    $productivity = $this->db->table('productivity')->where('project_id', $idp)->get()->getResult();
    foreach($productivity as $row){ $productivityArr[] = strtotime($row->updated_at); }
    if(!isset($productivityArr)){ $productivityArr = [0]; }
    rsort($productivityArr);
    if($productivityArr[0] == 0) {
        return '-';
    } else {
        return date('d M Y | H:i:s', $productivityArr[0]);
    }
}

public function getLastUpdateProject($task, $quality, $productivity, $finance)
{
    $arr = [$task,$quality,$productivity,$finance];
    rsort($arr);
    return $arr[0];
}

public function getFlagDelivery($string, $date)
{
    $event_internal = $this->db->table('event_internal')
        // ->select('event_internal.updated_at')
    ->where('start', $date)
    ->where('event_name', $string)
    ->get()->getRow();
        // dd($event_internal);
    $out = $event_internal->flag;
    return $out;
}

public function getProjectWebView()
{
    $allProj = $this->db->table($this->table)
    ->select('project.*, customer_name, type, fullname')
    ->join('customer', 'project.cust_id = customer.id')
    ->join('users', 'project.leader = users.id')
    ->limit(5)
     ->orderBy('project.created_at', 'DESC')
    ->get()->getResult();
    foreach ($allProj as $row) {
    }
    return $allProj;
}
}