<?php
//============================================================+
// File name   : example_018.php
// Begin       : 2008-03-06
// Last Update : 2013-05-14
//
// Description : Example 018 for TCPDF class
//               RTL document with Persian language
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: RTL document with Persian language
 * @author Nicola Asuni
 * @since 2008-03-06
 */

require_once ('../../mysql/MysqliDb.php');
$db = new MysqliDb ('localhost', 'root', '', 'db_cq');
$data = Array ("fname" => $_POST["fname"],
               "sname" => $_POST["sname"],
	       "phone" => $_POST["mobile"],
               "email" => $_POST["email"]
);
$id = $db->insert ('users', $data);
$regnum = str_pad($id, 5, "0", STR_PAD_LEFT);
$udata = Array ( 'reg_num' => $regnum);
$db->where ('id', $id);
$db->update ('users', $udata);


// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 018');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language dependent data:
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'fa';
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 12);

// add a page
$pdf->AddPage();


$pdf->setRTL(false);

// print newline
$pdf->Ln();

$pdf->SetFont('aealarabiya', '', 12);

if($_POST["sex"]=='F'){$sex='أنثى';} else {$sex='ذك';}
if($_POST["stype"]=='1'){$stype='مستقلة';} else {$stype='خاصة';}
if($_POST["communicate"]=='home_phone'){$communicate='هاتف المنزل';} else if($_POST["communicate"]=='com_mobile'){$communicate='الجوال';}else if($_POST["communicate"]=='office_phone'){$communicate='هاتف العمل';}else if($_POST["communicate"]=='com_email'){$communicate='البريد الالكتروني ';}
if($_POST["agree"]=='Y'){$agree='أوافق';} else {$agree='لا أوافق';}
if($_POST["needs"]=='Y'){$needs='نعم';} else {$needs='لا';}
if($_POST["diet"]=='Y'){$diet='نعم';} else {$diet='لا';}

// Arabic and English content
$htmlcontent2 = '<table style="text-align:right;"> 
             <p></p>             
             <p ><b>بيانات الطالب:</b></p>
             <p ><b>(ملاحظة: يرجى ملء استمارة تسجيل خاصة لكل طالب)</b></p>            
             <p ><span style="color:red" >'.$_POST["fname"].' </span> <b>الاسم الأول:</b></p>
             <p ><span style="color:red" >'.$_POST["sname"].' </span> <b>اسم العائلة:</b> </p>
             <p ><span style="color:red" >'.$sex.' </span>  <b>النوع:</b></p>
             <p ><span style="color:red" >'.$_POST["year"].'/'.$_POST["month"].'/'.$_POST["day"].' </span> <b>تاريخ الميلاد (اليوم/الشهر / السنة ) </b> </p> 
             <p ><span style="color:red" >'.$_POST["nation"].' </span> <b>الجنسية:</b></p>
             <p ><span style="color:red" >'.$_POST["school"].' </span>  <b>اسم المدرسة (التي يداوم فيها حالياً):</b></p>
             <p ><span style="color:red" >'.$stype.' </span> <b>نظام المدرسة: </b></p>
             <p ><span style="color:red" >'.$_POST["pgrade"].' </span>  <b>الصف الذي تمت الدراسة فيه في العام الأكاديمي 2014/2015:</b></p>
             <p ><span style="color:red" >'.$_POST["cgrade"].' </span>  <b>الصف الذي سيدخله الطالب في العام الأكاديمي 2015/2016:</b></p>
             <p></p>
             <p ><span style="color:red" >'.$_POST["address"].' </span><b>عنوان السكن:</b></p>
             <p ><span style="color:red" >'.$_POST["phone"].' </span><b>هاتف المنزل:</b></p>
             <p ><span style="color:red" >'.$_POST["mobile"].' </span><b>الجوال:</b></p><p><input type="text" class="txtin" name="mobile" size="20" value="" /></p>
             <p ><span style="color:red" >'.$_POST["email"].' </span><b>البريد الالكتروني (اختياري):</b></p>
             <p></p>
             <p></p>
             <p ><b>بيانات الوالدين / ولي الأمر:</b></p>
             <p ><span style="color:red" >'.$_POST["parent1"].' </span>اسم الوالد/ ولي الأمر (1):</p>
             <p ><span style="color:red" >'.$_POST["parent2"].' </span>اسم الوالدة/ ولي الأمر (2):</p>
             <p></p>
             <p ><span style="color:red" >'.$_POST["p1phone"].' </span>الوالد/ ولي الأمر (1) هاتف المنزل:</p>
             <p ><span style="color:red" >'.$_POST["p1mobile"].' </span>الوالد/ ولي الأمر (1) رقم الجوال: </p>
             <p style="text-align:right" ><span style="color:red" >'.$_POST["p1workphone"].' </span>الوالد/ ولي الأمر (1) هاتف العمل (اختياري):</p>
             <p ><span style="color:red" >'.$_POST["p1email"].' </span>الوالد/ ولي الأمر (1) البريد الالكتروني:</p>
             <p></p>

             <p ><span style="color:red" >'.$communicate.' </span> أفضل طريقة للتواصل معك (يرجى اختيار)؟ :</p>
            
             <p></p>
             
            <p ><b>استخدام المواد والبيانات لأغراض إعلامية:</b> </p>
            <p >خلال المخيم، سوف يقوم موظفينا بالتالي: </p>
            <p >1.	التقاط صور ثابتة (فوتوغرافية)</p>
            <p >2.	التقاط صور متحركة (أفلام/ فيديو)</p>
            <p >3.	تسجيل صوتي</p>
            <p></p>

            <p >وقد يتم استخدام تلك المواد لاحقاً في عدد من وسائل الإعلام، التي تتضمن ولا تقتصر على، المطبوعات، الاستخدام الرقمي والالكتروني من قبل مخيم قطر 2015 و/أو من قبل الوكلاء المخولين من قبل مخيم قطر 2015. سوف يقوم مخيم قطر 2015 باستخدام الصور والتسجيلات المتوفرة لديه وعرضها للجمهورعبر الانترنت.</p>
            <p ><span style="color:red" >'.$agree.' </span></p>
            <p></p><p></p>
            <p ><b>بيانات عن /الحالة الطبية/ حمية الطالب: </b></p>
            <p >هل لدى ابنك/ابنتك أي مشاكل طبية، حساسية، </p>
            <p >أو احتياجات خاصة؟ : </p>
	    <p > <span style="color:red" >'.$needs.' </span></p>
            <p></p>
            <p >إن كان نعم، يرجى إدراجها: </p>
            <p >1.</p><p><span style="color:red" >'.$_POST["needs1"].' </span></p>
            <p></p>
            <p >2.</p><p><span style="color:red" >'.$_POST["needs2"].' </span></p>
            <p></p>

            <p >هل لدى ابنك/ ابنتك أي حمية غذائية خاصة؟</p>
            <p ><span style="color:red" >'.$diet.' </span></p>
            <p></p>

            <p >إن كان نعم، يرجى إدراجها: </p>
            <p >1.</p><p><span style="color:red" >'.$_POST["diet1"].' </span></p>
            <p >2.</p><p><span style="color:red" >'.$_POST["diet2"].' </span></p>
            <p></p>
			<p></p>
            </table>';
$pdf->WriteHTML($htmlcontent2, true, 0, true, 0);

// ---------------------------------------------------------

//Close and output PDF document
//$pdf->Output('example_018.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

$attachment = $pdf->Output('campqatar-registration.pdf', 'F');


//============================================================+
// END OF FILE
//============================================================+

require_once('../../phpmailer/class.phpmailer.php');

$email = new PHPMailer();
$email->CharSet = 'UTF-8';
$email->isHTML(true);
$email->From      = $_POST["email"];
$email->FromName  = $_POST["fname"];
$email->Subject   = 'Camp Qatar Registration ';
$email->Body      = $_POST["fname"].' '.$_POST["sname"]." has registered!<br/>" ;
$email->AddAddress( 'campqatar@teachforqatar.org' );


$email->AddAttachment( 'campqatar-registration.pdf' );

$email->Send();

$email->ClearAddresses();
$email->ClearAllRecipients();
$email->clearAttachments();

$body= '<table width="100%"  style="direction:rtl;font-size:20px;text-align:right;" ><p style="text-align:right;" >! شكراً لتعبئة استمارة التسجيل الإلكترونية</p>
<p style="margin:10px 0px; text-align:right;">لإكمال التسجيل نرجو منكم التوجه إلى مجمع اللاند مارك أو فيلاجيو في مكتب التسجيل. يرجى إبراز رقم التسجيل الخاص بك لمكتب التسجيل (فيلاجيو أو لاند مارك) وهو: <span style="color:red" >'.$regnum.' </span>  </p>

<p style="margin:50px 0px;text-align:right; ">.لإكمال التسجيل نرجو منكم التوجه إلى مجمع اللاند مارك او فيلاجيو في مكتب التسجيل</p>

<p style="text-align:right;" ><b>: يرجى إحضار المتطلبات الإضافية لإكمال التسجيل</b></p>
 
<p style="text-align:right;" >١. صورة من البطاقة الشخصية أو جواز سفر أحد الوالدين أو ولي الأمر </p>

<p style="text-align:right;" >٢. صورة شخصية للابن/الابنة (قياس صورة جواز سفر) </p>

<p style="text-align:right;" >٣. 300 ر.ق رسوم التسجيل </p>

<p style="margin:30px 0px 20px;text-align:right; ">نشكركم على التسجيل في مخيم قطر ٢٠١٥ </p>

</table>';

$email->From      = 'campqatar@teachforqatar.org';
$email->FromName  = 'Camp Qatar';
$email->Subject   = 'التسجيل في مخيم قطر‎';
$email->Body  = $body;
$email->AddAddress( $_POST["email"] );

//$email->Send();


