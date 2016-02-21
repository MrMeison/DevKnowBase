<?php
/*
������� 1
- �������� ���������� $age
- ��������� ���������� $age ������������ �������� ��������
*/
$age = 20;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<title>����������� if-elseif-else</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
</head>
<body>
	<h1>����������� if-elseif-else</h1>
	<?php
	/*
	������� 2
	- �������� ����������� if, ������� ������� �����: "��� ��� �������� � ��������" ��� �������, ��� �������� ���������� $age �������� � �������� ����� �� 18 �� 59(������������)
	- ��������� ����������� if, ������ �����: "��� ���� �� ������" ��� �������, ��� �������� ���������� $age ������ 59
	- ��������� ����������� if-else, ������ �����: "��� ��� ���� ��������" ��� �������, ��� �������� ���������� $age �������� � �������� ����� �� 1 �� 17(������������)
	- ��������� ����������� if-elseif, ������ �����: "����������� �������" ��� �������, ��� �������� ���������� $age �� �������� � ������������� ��������� �����
	*/
	// ������� � ������� ������
	if($age >= 18 && $age <= 59) {
	   echo "��� ��� �������� � ��������";
    } elseif($age > 59) {
	   echo "��� ���� �� ������";
	} elseif($age >= 1 && $age <= 17) {
       echo "��� ��� ���� ��������";	
	} else {
	   echo "����������� �������";
	}
	
	// ������� � ������� ���������� ��������� (!!! �� ����� ���� �� ���, ��� � ������ ������ !!! - ��� ���. ������ ����� �������� �� ��������� !!!)
	echo "<br>", (($age >= 18 && $age <= 59) ? "��� ��� �������� � ��������" : 
	(($age > 59) ? "��� ���� �� ������" :
	(($age >= 1 && $age <= 17) ? "��� ��� ���� ��������" : "����������� �������")));
	?>
</body>
</html>
