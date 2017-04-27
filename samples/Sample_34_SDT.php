<?php
include_once 'Sample_Header.php';

// New Word document
echo date('H:i:s'), ' Create new PhpWord object', EOL;
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// New section
$section = $phpWord->addSection();

$textrun = $section->addTextRun();
$textrun->addText('Combobox: ');
$textrun->addSDT('comboBox')->setListItems(array('1' => 'Choice 1', '2' => 'Choice 2'));

$textrun = $section->addTextRun();
$textrun->addText('Date: ');
$textrun->addSDT('date');
$textrun->addTextBreak(1);
$textrun->addText('Date with pre set value: ');
$textrun->addSDT('date')->setValue('03/30/2017');
$textrun->addTextBreak(1);
$textrun->addText('Date with pre set value: ');
$textrun->addSDT('date')->setValue('30.03.2017');

$textrun = $section->addTextRun();
$textrun->addText('Drop down list: ');
$textrun->addSDT('dropDownList')->setListItems(array('1' => 'Choice 1', '2' => 'Choice 2'))->setValue('Choice 1');


$textrun = $section->addTextRun();
$textrun->addText('Input field: ');
$sdt = $textrun->addSDT('textInput');
$sdt->setValue('textinput value');


// SDTBlocks are called "Rich Text Content Controls" in Word and can contain top-level items like TextRuns, ListItems or Tables.
$sdtBlock = $section->addSDTBlock();
$sdtBlock->setTag('SDTBlock Tag');
$sdtBlock->addListItem('First List Item', 0);
$sdtBlock->addListItem('Second List Item', 0);

// also, SDTBlocks can be used for multi-line non-rich-text content controls:
$sdtBlock = $section->addSDTBlock();
$sdtBlock->setIsMultiLineText(true);
$textrun = $sdtBlock->addTextRun();
$textrun->addText('first line');
$textrun->addTextBreak();
$textrun->addText('second line');


// Save file
echo write($phpWord, basename(__FILE__, '.php'), $writers);
if (!CLI) {
    include_once 'Sample_Footer.php';
}
