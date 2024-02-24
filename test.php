<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 50%; /* เพื่อแสดงตารางให้อยู่กึ่งกลาง */
        }
        th, td {
            border: 1px solid black; /* กำหนดขอบเขตของแต่ละเซลล์ในตาราง */
            padding: 8px;
            text-align: center; /* จัดข้อความให้อยู่ตรงกลาง */
        }
        th.special-border, td.special-border {
            border-color: red; /* กำหนดสีขอบของขอบเขตพิเศษ */
        }
    </style>
</head>
<body>

<table>
    <tr>
        <th class="special-border">หัวข้อ 1</th>
        <th>หัวข้อ 2</th>
    </tr>
    <tr>
        <td class="special-border">เนื้อหา 1</td>
        <td>เนื้อหา 2</td>
    </tr>
    <tr>
        <td>เนื้อหา 3</td>
        <td class="special-border">เนื้อหา 4</td>
    </tr>
</table>

</body>
</html>