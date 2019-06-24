<?php

// use PDO;
 
if(!defined('BASEPATH')) exit('No direct script access allowed');
 
class Anotherdb_model extends CI_Model
{
  private $another;
  private $dbServer;
  private $username;
  private $password;
  
  function __construct()
  {
    parent::__construct();
  }

   function getConnection($dbsrv, $dbUsr, $dbPswd){
    $this->load->library('sms/log.php');
    try {
      //$dbconn = new PDO("sqlsrv:Server=(localdb)\MSSQLLocalDB;Database=NG_Core_Authdb","sys","dev");
      //$dbconn = new PDO("sqlsrv:Server=10.0.0.118;Database=devhub","dev","sys");
      $dbconn = new PDO($dbsrv,$dbUsr,$dbPswd);
      $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $dbconn;
    } catch (Exception $th) {
      // return $dbconn;
      $errorMessage = $th->getMessage();
      //  die(print_r($th->getMessage()));
      logFile("[ db_error= $errorMessage]");
      return null;
    }
  }
 
  public function getAllUsers($another)
  {
    $tsql = "SELECT * FROM User";
    // $tsql = "SELECT * FROM Products";
    $getResults = $another->prepare($tsql);

    $getResults->execute();
    $results = $getResults->fetchAll(PDO::FETCH_OBJ);
    return $results;
  }

  //the last two months
  public function get2MonthsToDate($another)
  {

    // $now = date('Y-m-d H:i:s');
    // $startOfMonth = date('Y-m-01 H:i:s');
    // $endOfYesterDay = date('Y-m-d H:i:s');

    $last2m = (date('m')-2);
    $now = date('Y-m-d');
    $startOfMonth = date("Y-$last2m-01");
    $endOfYesterDay = date('Y-m-d');

    $tsql = "select Distinct Doc.AcquisitionDetails_SupplierId as FarmerId,
            F.PersonalDetails_NationalIdNumber as IdNumber,
          F.PersonalDetails_MobileNo as Phone,
          F.Code as FarmerCode,
          FC.Centre_Name as CenterName
          ,Sum(FBL.[NetWeight_Value])  as MonthToDate
          ,MAX(FBL.HarvestDate) as LatestSyncDate
          FROM Bat_FieldAcquisitionBatchLineItem FBL ,Doc_FieldAcquisitionDocument Doc, Doc_FieldAcquisitionDocumentLineItem DocL,[dbo].[MD_Farmer] F, [dbo].[MD_FarmerCentre] FC
          where DocL.BatchReference_Id =FBL.FieldAcquisitionBatch_Id
          and Doc.id=DocL.FieldAcquisitionDocument_Id
        and Doc.AcquisitionDetails_SupplierId= F.id
        and Doc.AcquisitionDetails_SupplierId= FC.Farmer_Id
          and FBL.HarvestDate between '$startOfMonth' and '$endOfYesterDay'
          Group by Doc.AcquisitionDetails_SupplierId,F.PersonalDetails_NationalIdNumber,F.PersonalDetails_MobileNo,FC.Centre_Name,F.Code";
    $getResults = $another->prepare($tsql);

    $getResults->execute();
    $results = $getResults->fetchAll(PDO::FETCH_OBJ);
    return $results;
  }

  //the last one month
  public function getMonthToDate($another)
  {

    // $now = date('Y-m-d H:i:s');
    // $startOfMonth = date('Y-m-01 H:i:s');
    // $endOfYesterDay = date('Y-m-d H:i:s');

    $now = date('Y-m-d');
    $startOfMonth = date('Y-m-01');
    $endOfYesterDay = date('Y-m-d');

    $tsql = "select Distinct Doc.AcquisitionDetails_SupplierId as FarmerId
    ,Sum(FBL.[NetWeight_Value])  as Weight
     ,MAX(FBL.HarvestDate) as LatestSyncDate
    FROM Bat_FieldAcquisitionBatchLineItem FBL ,Doc_FieldAcquisitionDocument Doc, Doc_FieldAcquisitionDocumentLineItem DocL
    where DocL.BatchReference_Id =FBL.FieldAcquisitionBatch_Id
    and Doc.id=DocL.FieldAcquisitionDocument_Id
    and FBL.HarvestDate between '$startOfMonth' and '$endOfYesterDay'
    Group by Doc.AcquisitionDetails_SupplierId ";
    $getResults = $another->prepare($tsql);

    $getResults->execute();
    $results = $getResults->fetchAll(PDO::FETCH_OBJ);
    return $results;
  }

  //the last one week
  public function getWeekToDate($another)
  {
    $now = date('Y-m-d');
    $lastwk = (date('d')-7);
    $startOfMonth = date("Y-m-$lastwk");
    $endOfYesterDay = date('Y-m-d');

    $tsql = "select Distinct Doc.AcquisitionDetails_SupplierId as FarmerId
    ,Sum(FBL.[NetWeight_Value])  as Weight
     ,MAX(FBL.HarvestDate) as LatestSyncDate
    FROM Bat_FieldAcquisitionBatchLineItem FBL ,Doc_FieldAcquisitionDocument Doc, Doc_FieldAcquisitionDocumentLineItem DocL
    where DocL.BatchReference_Id =FBL.FieldAcquisitionBatch_Id
    and Doc.id=DocL.FieldAcquisitionDocument_Id
    and FBL.HarvestDate between '$startOfMonth' and '$endOfYesterDay'
    Group by Doc.AcquisitionDetails_SupplierId ";
    $getResults = $another->prepare($tsql);

    $getResults->execute();
    $results = $getResults->fetchAll(PDO::FETCH_OBJ);
    return $results;
  }

  //the last three days
  public function getLastThreeDaysToDate($another)
  {


    $now = date('Y-m-d');
    $lasThreeDays = (date('d')-3);
    $startOfMonth = date("Y-m-$lasThreeDays");
    $endOfYesterDay = date('Y-m-d');

    $tsql = "select Distinct Doc.AcquisitionDetails_SupplierId as FarmerId
    ,Sum(FBL.[NetWeight_Value])  as Weight
     ,MAX(FBL.HarvestDate) as LatestSyncDate
    FROM Bat_FieldAcquisitionBatchLineItem FBL ,Doc_FieldAcquisitionDocument Doc, Doc_FieldAcquisitionDocumentLineItem DocL
    where DocL.BatchReference_Id =FBL.FieldAcquisitionBatch_Id
    and Doc.id=DocL.FieldAcquisitionDocument_Id
    and FBL.HarvestDate between '$startOfMonth' and '$endOfYesterDay'
    Group by Doc.AcquisitionDetails_SupplierId ";
    $getResults = $another->prepare($tsql);

    $getResults->execute();
    $results = $getResults->fetchAll(PDO::FETCH_OBJ);
    return $results;
  }

  //the last one day
  public function getLastOneDayToDate($another)
  {

    // $now = date('d');
    // $lastwk = (date('d')-7);
    // $startOfMonth = date("Y-m-$lastwk H:i:s");
    // $endOfYesterDay = date('Y-m-d H:i:s');

    $now = date('Y-m-d');
    $lasOneDay = (date('d')-1);
    $startOfMonth = date("Y-m-$lasOneDay");
    $endOfYesterDay = date('Y-m-d');

    $tsql = "select Distinct Doc.AcquisitionDetails_SupplierId as FarmerId
    ,Sum(FBL.[NetWeight_Value])  as Weight
     ,MAX(FBL.HarvestDate) as LatestSyncDate
    FROM Bat_FieldAcquisitionBatchLineItem FBL ,Doc_FieldAcquisitionDocument Doc, Doc_FieldAcquisitionDocumentLineItem DocL
    where DocL.BatchReference_Id =FBL.FieldAcquisitionBatch_Id
    and Doc.id=DocL.FieldAcquisitionDocument_Id
    and FBL.HarvestDate between '$startOfMonth' and '$endOfYesterDay'
    Group by Doc.AcquisitionDetails_SupplierId ";
    $getResults = $another->prepare($tsql);

    $getResults->execute();
    $results = $getResults->fetchAll(PDO::FETCH_OBJ);
    return $results;
  }
}