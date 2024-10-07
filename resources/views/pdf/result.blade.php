<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>List of Majors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;

            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        
        ol {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #f2f2f2;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            text-align:right;
        }
        .download-btn {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 20px 0;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>قائمة التخصصات المناسبة لطالب/ـة</h1>
    <div style="text-align: center;">
    <small >تم إختيار هذه التخصصات بناء على درجات الطالب في العام الأكاديمي بالاضافة إلى تحليل مهاراته و قدراته</small>
    </div>
    <ol>
    @foreach($majors as $index => $major)
                         <li>
                         <strong>{{ $major }}</strong>: {{ $reasons[$index] }}
                        </li>
        @endforeach
    </ol>
    <!-- <a href="#" class="download-btn" onclick="window.print();">Download PDF</a> -->
</body>
</html>
